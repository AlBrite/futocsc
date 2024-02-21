<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Advisor;
use App\Models\Student;
use App\Models\AcademicSet;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function login()
    {
        return view('student.login');
    }

    public function register(Request $request)
    {
        $invitation = AcademicSet::getSetFromURL();
        if ($request->has('invite') && !$invitation) {
            abort(403, 'Registeration link has expired or revoked');
        }

        $jointoken = null;
        $title = 'Registration Form';

        if ($invitation) {
            $title =  "Joining {$invitation->name}";
            $jointoken = $request->input('invite');
        }
        return view('auth.register', compact('jointoken', 'invitation', 'title'));
    }

    protected function attemptLogin(Request $request)
    {
        return Auth()->guard()->attempt(
            $this->credentials($request),
            $request->filled('remember')
        );
    }



    


    public function doRegister(Request $request)
    {

        $formFields = $request->validate([
            'name' => 'required|regex:/^\s*([a-zA-Z]+)\s+([a-zA-Z]+)\s*([a-zA-Z]+)?\s*$/',
            'gender' => 'in:female,male',
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed'],
            'phone' => 'sometimes|regex:/^\s*\d+\s*$/',
            'checkpolicy' => 'required',
            'role' => 'sometimes|in:admin,advisor,admin',
            'regno' => 'sometimes|regex:/^\s*\d+\s*$/'
        ], [
            'name.regex' => 'Requires only alphabet characters',
            'checkpolicy.required' => 'You must accept terms and conditions to proceed',
            'phone.regex' => 'Enter a valid phone number',
            'role.in' => 'You selected an invalid role',
            'regno.regex' => 'Reg Number of be a number'
        ]);

        // if invitation token exists add student to the set
        if ($request->has('jtoken')) {
            $set = AcademicSet::where('token', $request->input('jtoken'));
            if ($set) {
                $formFields['set_id'] = $set->first()->id;
            }
        }

        list($firstname, $lastname) = preg_split('/\s+/', $formFields['name']);

        $formFields['username'] = $this->generateUsername($firstname, $lastname);

        // Remove white spaces 
        $formFields = array_map(fn ($value) => trim($value), $formFields);

        $formFields['password'] = bcrypt($formFields['password']);
        request()->merge($formFields);

        $user = User::saveUser($formFields);

        auth()->login($user);

        return redirect('/')->with('message', 'Account Created');
    }

    public static function store(string $role = 'student')
    {
        if (!in_array($role, ['student', 'advisor', 'admin'])) {
            throw new \Exception('Invalid Role');
        }

        $request = request();

        $formFields = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email'], // Rule::unique('users')],
            'phone' => 'required',
            'password' => 'sometimes|confirmed',
            'set_id' => 'sometimes'
        ]);

        $user = new User();
        $userData = $request->only($user->getFillables());

        $class = LoginController::class;
        $loginController = new $class();



        if (auth()->check() && auth()->user()->role !== 'student') {
            $userData['created_by'] = auth()->id();
        }

        if (!$request->has('password')) {
            $formFields['password'] = $request->input('phone');
        }
        $userData['role'] = $role;

        $userData['password'] = bcrypt($formFields['password']);
        list($firstname, $lastname) = preg_split('/\s+/', $formFields['name']);

        $username = $loginController->generateUsername($firstname, $lastname);

        $userData['username'] = $username;


        $user = User::create(array_map(fn ($value) => trim($value), $userData));

        $instance = match ($role) {
            'admin' => new Admin(),
            'advisor' => new Advisor(),
            'student' => new Student(),
            default => null,
        };





        if ($instance && $user) {

            if ($fillables = $instance?->getFillables()) {
                foreach ($fillables as $field) {
                    if ($request->has($field)) {
                        $instance->{$field} = $request->input($field);
                    }
                }
            }

            if ($request->hasFile('image')) {
                $instance->image = $request->file('image')->store('pic', 'public');
            }




            $instance->id = $user->id;
            $instance->save();
            $back = 'profile.' . $role;

            return redirect()->route($back, compact('username'))->with('message', strtoupper($role) . ' account added');
        }
    }

    public function doLogin(Request $request)
    {
        $username = $this->username();

        $request->validate([
            'usermail' => 'required',
            $username => 'required',
            'password' => 'required',
        ]);

        $user = User::where($username, $request->input($username))?->first();
        $logAttempts = 0;

        $exists = $user?->exists();


        if ($exists) {
            $logAttempts = $user->logAttempts;
            $logAttempts++;
        }

        $credentials = $request->only($username, 'password');
        $limit = 5;

        if (($logAttempts + 1) === $limit) {
            //session()->set()
        }

        if ($logAttempts >= 5) {
            return back()->withErrors(['login_info' => 'Account has been locked']);
        } elseif (auth()->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();


            $user->update(['logAttempts' => 0]);

            return User::redirectToDashboard()->with('message', 'Logged in');
        } else if ($exists) {
            $user->update(compact('logAttempts'));
        }


        return back()->withErrors(['login_info' => 'Invalid credentials']);
    }

    public function username()
    {
        $login = request()->input('usermail');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : (ctype_digit($login) ? 'phone' : 'username');
        request()->merge([$field => $login]);
        return $field;
    }

    // Socialite
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialiteUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('message', 'error:Unable to authenticate with ' . ucfirst($provider));
        }
        // Check if the user with this email already exists in database
        $existingUser = User::where('email', $socialiteUser->email)->first();

        if ($existingUser) {
            // User already exists, log them in
            Auth::login($existingUser);
            return redirect('/home');
        } else {
            // User doesnt exist, create a new account
            $newUser = new User();
            $newUser->name = $socialiteUser->name;
            $newUser->email = $socialiteUser->email;
            $newUser->password = bcrypt(Str::random(16));

            // Check if the user has an avatar provided by Socialite
            if (isset($socialiteUser->avatar_original)) {
                // Copy the profile image to local storage
                $imageContents = file_get_contents($socialiteUser->avatar_original);
                $imageName = 'profile_image_' . $newUser->id . '.jpg';
                Storage::disk('public')->put($imageName, $imageContents);
            }

            $newUser->save();

            Auth::login($newUser);
            return redirect('/home');
        }
    }
}
