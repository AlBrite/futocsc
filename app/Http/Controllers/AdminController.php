<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Advisor;
use App\Models\AcademicSet;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\LoginController;
use App\Models\Admin;
use App\Models\Course;
use App\Models\Department;
use App\Models\Student;
use Illuminate\Support\Arr;

class AdminController extends Controller
{
    public function dashboard()
    {
        

        return view('admin.dashboard');
    }

    public function addStudent(Request $request) {
        
        return $this->add($request, 'student');
    }

    public function addAdvisor(Request $request)
    {
        return $this->addAccount($request, 'advisor');
    }

    public function updateStudent(Request $request) {
        $request->validate([
            'firstname' => 'sometimes',
            'lastname' => 'sometimes',
            'middlename' => 'sometimes',
            'email' => 'sometimes|email',
            'phone' => 'sometimes',
            'birthdate' => 'sometimes',
            'entryMode' => 'sometimes',
            'set_id' => 'sometimes',
            'session' => 'sometimes',
            'level' => 'sometimes',
            'gender' => 'sometimes',
            'image' => 'sometimes',
            'reg_no' => 'required'
        ]);

        $user = new User();
        $student = new Student();

        

        $user_fillables = $user->getFillables();
        
        $student_fillables = $student->getFillables();

        $userData = $request->only($user_fillables);
        $studentData = $request->only($student_fillables);

        if ($name = User::getFullnameFromRequest()){
            $userData['name'] = $name;
        }

        $currentAccount = Student::where('reg_no', $request->reg_no)->with('user')->get()->first();

        if (!$currentAccount) {
            return redirect()->back()->with('error', 'Student Account does not exist');
        }

        
        $profile = $currentAccount->profile;
        
        // If email is among the fields to be updated but it's the same as the current email
        // Unset the field
        if (array_key_exists('email', $userData) && $userData['email'] == $currentAccount->user->email) {
            unset($userData['email']);
        }
        if ($image = UploaderController::uploadFile('image')) {
            $studentData['image'] = $image;
        }
        

        $currentAccount->user->update($userData);
        $currentAccount->update($studentData);

        return redirect()->back()->with('success', 'Student account updated successfully');

    }

    public function addAccount(Request $request, string $role = 'student', $validator = [
        'email' => ['required', 'email'],
        'phone' => 'required',
        'password' => 'sometimes|confirmed',
        'set_id' => 'required',
        'session' => 'sometimes'
    ])
    {
    //     "set_id" => "custom"
    //   "session" => "2015/2016"
        $set_id = $request->get('set_id');
        $session = $request->get('session');

      

        if (!in_array($role, ['student', 'advisor', 'admin'])) {
            throw new \Exception('Invalid Role');
        }

        $firstname = $request->get('firstname', '');
        $lastname = $request->get('lastname', '');
        $middlename = $request->get('middlename', '');

   
    // Validate user inputs against list of rules
        $formFields = $request->validate($validator);

        
        // instantiate User object
        $user = new User();
        
        // get the fields can be submitted to User constructor
        $userData = $request->only($user->getFillables());
        
        // concatenate the firstname, lastname and middlename to for fullname
        $userData['name'] = Arr::join([$firstname, $lastname, $middlename], ' ');
    
        // Assigned the id of the account that created the user
        if (auth()->check() && auth()->user()->role !== 'student') {
            $userData['created_by'] = auth()->id();
        }

        // Make phone number the password if no password is provided
        if (!$request->has('password')) {
            $formFields['password'] = $request->input('phone');
        }
        $userData['role'] = $role;

        $userData['password'] = bcrypt($formFields['password']);

        // generate unique username for the account to be created
        $userData['username'] = $user->generateUsername($firstname, $lastname);

        // Add the new account to User model for authe
        $user = User::create(array_map(fn ($value) => trim($value), $userData));

        // Get Profile instance of the new account with respect to the roles assigned
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

            if ($uploadedFile = UploaderController::uploadFile('image', 'pic')) {
                $instance->image = $uploadedFile;
            }


            $instance->id = $user->id;
            $instance->save();

            
        if (
            $role == 'advisor' &&
            $set_id &&
            preg_match('/(\d+)\/(\d+)/',$session, $match) &&
            $set_id == 'custom'
        ) {
            // Create new class 
            list(, $start, $end) = $match;
            $end += 5;
            
            $set = new AcademicSet();
            $set->name = "$start/$end";
            $set->start_year = $start;
            $set->end_year = $end;
            $set->created_by = auth()->id();
            $set->advisor_id = $user->id;
            $set->save();

        }

            return redirect()->back()->with('message', strtoupper($role) . ' account added');
        }
    }

    public function addAdvisorForm()
    {
        return view('admin.addadvisor');
    }


    public function addAcademicSet(Request $request)
    {
        $formFields = $request->validate([
            'start_year' => 'required|regex:/^[0-9]+$/',
            'end_year' => 'required|regex:/^[0-9]+$/',
            'department' => 'required',
            'advisor_id' => 'sometimes|regex:/^[0-9]+$/'
        ], [
            'start_year.regex' => 'Invalid start year',
            'end_year.regex' => 'Invalid end year',
            'advisor_id.regex' => 'Invalid Advisor Id'
        ]);

        $formFields['name'] = "{$formFields['department']} {$formFields['end_year']}";

        $set = AcademicSet::create($formFields);

        return redirect()->route('view.academic_set', compact('set'));
    }
}
