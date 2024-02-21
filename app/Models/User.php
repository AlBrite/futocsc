<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\{
    Advisor, 
    Student,
    Admin
};


use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Arr;


class User extends Authenticatable
{
    use HasFactory, SoftDeletes, CanResetPassword, HasApiTokens, HasFactory, Notifiable;

  
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'phone',
        'department_id',
        'role',
        'unlockDuration',
        'logAttempts'
    ];

    private $namesLoaded = false;

    public static $accounts = [
        'advisor' => Advisor::class,
        'student' => Student::class,
        'admin'  => Admin::class,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        //'password' => 'hashed',
    ];





    public static function getFullnameFromRequest()
    {
        $request = request();
        $firstname = $request->get('firstname', '');
        $lastname = $request->get('lastname', '');
        $middlename = $request->get('middlename', '');

        if (!$firstname && !$lastname) {
            return null;
        }


        $fullname = [$firstname, $lastname, $middlename];

        return implode(' ', $fullname);
    }

    public static function getFillables(array $data = [])
    {
        $class = __CLASS__;
        $obj = new $class;

        $fillables = $obj->fillable;
        if (count($data) === 0) {
            return $fillables;
        }
        return Arr::only($data, $fillables);
    }






    public function generateUsername($firstName, $lastName)
    {
        $firstName = trim($firstName);
        $lastName = trim($lastName);
        $usernames = [
            $firstName . $lastName,
            substr($firstName, 0, 1) . $lastName,
            $firstName . substr($lastName, 0, 3),
            $firstName . '_' . $lastName,
            substr($firstName, 0, 1) . '_' . $lastName,
            $firstName . '_' . substr($lastName, 0, 1),
            $lastName . $firstName,
            substr($lastName, 0, 1) . $firstName,
            $lastName . substr($firstName, 0, 3),
            $lastName . '_' . $firstName,
            substr($lastName, 0, 1) . '_' . $firstName,
            $lastName . '_' . substr($firstName, 0, 1),
            substr($firstName, 0, 3) . substr($lastName, 0, -3)
        ];
        shuffle($usernames);
        $username = end($usernames);

        $count = User::where('username', $username)->count();

        if ($count > 0) {
            $username .= $count;
        }
        if (User::where('username', $username)->exists()) {
            return $this->generateUsername($firstName, $lastName);
        }
        return $username;
    }

    public function generateId($role, $prefix = null)
    {
        $prefix ??= strtoupper(substr($role, 0, 3));
        do {
            $randomNumber = mt_rand(10000, 99999);
            $uniqueId = "$prefix-$randomNumber";
        } while (User::where('unique_id', $uniqueId)->exists());

        return $uniqueId;
    }






    public static function store_user(array $data)
    {
        

        $accounts = [
            'advisor' => \App\Models\Advisor::class,
            'admin' => \App\Models\Admin::class,
            'student' => \App\Models\Student::class,
        ];
        
        $data['role'] ??= 'student';
        if (!array_key_exists($data['role'], $accounts)) {
            $data['role'] = 'student';
        }
        $role = $data['role'];
        
        
        $userData = User::getFillables($data);
        
        // Create user account for authentification
        $authUser = User::create($userData);
        
        $account = $accounts[$role];
        
        $fillables = $account::getFillables($data);
        $fillables['id'] = $authUser->id;
        
        // Add User to role table
        $account::create($fillables);
        
        return $authUser;
    }


    public static function active() {
        return auth()->user();
    }





    public static function saveUser(array $userData = [])
    {
        $user = new User();

        if (count($userData) === 0) {
            $data = request()->only($user->fillable);
        } else {
            $data = Arr::only($userData, $user->fillable);
        }


        $user = self::create($data);

        self::register($user, $data);

        return $user;
    }


    private static function register(User $user, array $data = [])
    {

        $instance = match ($user->role) {
            'admin' => new Admin(),
            'advisor' => new Advisor(),
            default => new Student(),
        };

        if ($instance) {
            if ($fillables = $instance->getFillables()) {
                foreach ($fillables as $field) {
                    if (request()->has($field)) {
                        $instance->{$field} = request()->input($field);
                    }
                }
            }

            $instance->id = $user->id;
            $instance->save();
        }
    }

    public static function redirectToDashboardx()
    {
        $dashboard = 'login';
        if (auth()->check()) {
            $role = auth()->user()->role;

            $dashboard = $role . '.dashboard';
        }


        return redirect()->route($dashboard);
    }

    public static function findUser(string $username, string $column = 'username') {
        $allowedColumns = [
            'username',
            'id',
            'name',
            'email'
        ];

        if (!in_array($column, $allowedColumns)) {
            return null;
        }
        $user = User::where($column, $username)->first();
        if (!$user) {
            return null;
        }
        $account = User::$accounts[$user->role];
        $profile = $account::where('id', $user->id)->first();

        if ($profile) {
            $user->attributes = array_merge($user->attributes, $profile->attributes);
        }

        return $user;
    }


    public function profile() {
            
        return match($this->role){
            'student' => $this->hasOne(Student::class, 'id'),
            'admin' => $this->hasOne(Admin::class, 'id'),
            'advisor' => $this->hasOne(Advisor::class, 'id', 'id'),
            default => null,
        };
    }

    public function getStaticClass() {
        
         return match ($this->role) {
             'admin' => Admin::class,
             'advisor' => Advisor::class,
             'student' => Student::class,
             default => null,
         };

    }



    public function advisor()
    {
        return $this->hasOne(Advisor::class, 'id');
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'id', 'id');
    }
    

    public function admin()
    {
        return $this->hasOne(Admin::class, 'id');
    }


    public static function isStudent()
    {
        return auth()->user()->role === 'student';
    }
    public static function isAdmin()
    {
        return auth()->user()->role === 'admin';
    }
    public static function isAdvisor()
    {
        return auth()->user()->role === 'advisor';
    }


    public function loadNames() {
        if (!$this->namesLoaded) {
            $split = preg_split('/\s+/',$this->name);
            $names = ['_firstname', '_lastname','_middlename'];
            foreach($names as $n => $name) {
                if (isset($split[$n])) {
                    $this->$name = $split[$n];
                }
            }
            $this->namesLoaded = true;
        }
        return $this;
    }


    public function firstname() {
        $this->loadNames();

        return $this->_firstname;
    }

    public function lastname() {
        $this->loadNames();

        return $this->_lastname;
    }

    public function middlename() {
        $this->loadNames();

        return $this->_middlename;
    }


    

    public function courses() {
        return $this->hasMany(AcademicSet::class)->with('_course');
    }

    public function todos() {
        return $this->hasMany(Todo::class);
    }


    public function picture() {
        $image = $this->profile->image;
        if ($image) {
            return asset($image);
        }
        
        return asset(match($this->profile->gender) {
            'female' => 'images/avatar-f.png',
            'male' => 'images/avatar-m.png',
            default => 'images/avatar-u.png',
        });
    }

    
}
