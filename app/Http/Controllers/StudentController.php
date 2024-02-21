<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Result;
use App\Models\Student;
use App\Models\Department;
use App\Models\AcademicSet;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function dashboard()
    {




        return view('student.dashboard', self::data());
    }


    public function search_students(Request $request) {
        $query = $request->query;

        $students = User::where('users.role', '=', 'student')
            ->join('students', 'students.id', '=', 'users.id')
            ->where('users.name', 'LIKE', $query);
        //     ->leftJoin('students', function($join) {
        //         $join->on('students.id',)
        //     }
        
        
        // join('students', 'students.id', '=', 'users.id')

        //                 ->
        //                 ->where('users.name', '%LIKE%', $query)
        //                 //->orWhere('students.reg_no', '=', $query)
        //                 ;
        return [$students->toSql()];

        return ['heloo'=>'world'];

    }

    public function show_results(Request $request) {

    
        $user = $request->user();
        $student = $user->student;
        $sessions = Enrollment::where('reg_no', $student->reg_no)->groupBy('session')->get();
        $enrollments = $student->enrollments()->groupBy('session');
        
        
        $records = [];
        $session = request()->session;
        $semester = request()->semester;
        
        if ($session && $semester) {
           $records = Enrollment::where('semester', $semester)->where('session', $session)->where('reg_no', $student->reg_no)->with('course')->get();
        }
        
        $GPA = Result::calculateGPA($records, $semester, $session);

        return view('pages.student.results', compact('records', 'sessions', 'semester', 'GPA','student','session'));
    }


    public function profile(string $username)
    {
        return response($username);
    }

    public function settings()
    {
        $auth = Student::auth();
        $user = $auth->user;
        $courses = $auth->courses;
        $student = $user->student;
        $levels = Department::select($student->level);
        $department = Department::myDepartment();

        return view('student.settings', compact('courses', 'student', 'user', 'department', 'levels'));
    }


    public function update(Request $request)
    {

        $formFields = $request->validate([
            'address' => 'sometimes',
            'birthdate' => 'sometimes',
            'gender' => 'sometimes|in:male,female',
            'phone' => 'sometimes',
            'level' => 'sometimes',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2046'
        ]);

        $student = new Student();
        $user = new User();

        $userFillables = $user->getFillables();
        $studentFillables = $student->getFillables();

        $userProfile = User::find(auth()->id());
        $studentProfile = Student::find(auth()->id());

        $studentData = $request->only($studentFillables);

        if ($request->hasFile('image')) {
            $studentData['image'] = $request->file('image')->store('pic', 'public');
        }


        $userProfile->update($request->only($userFillables));
        $studentProfile->update($studentData);

        return back()->with('message', 'success:Profile Updated');
    }


    public function addStudent()
    {
        User::store('student');
    }

    public function doRegister(Request $request)
    {

        $formFields = $request->validate([
            'name' => 'required',
            'reg' => 'required',
            'phone' => 'required',
            'email' => ['required', 'email', Rule::unique('users')],
            'password' => 'required',
            'gender' => 'sometimes',
            'birthdate' => 'sometimes',
            'address' => 'sometimes'
        ]);

        $name = $request->input('name');
        $reg = $request->input('reg');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $password = $request->input('password');
        $gender = $request->input('gender');

        $role = 'student';
        $password = bcrypt($password);


        // Add to user table
        $user = User::create(compact('name', 'email', 'password', 'role'));


        // Add to student table
        $student = new Student();

        // Assign user id to student
        $student->id = $user->id;

        $optionalData = ['gender', 'birthdate', 'address', 'set_id'];

        foreach ($optionalData as $field) {
            if ($request->has($field)) {
                $student->{$field} = $request->input($field);
            }
        }
        if ($request->hasFile('image')) {
            $student->image = $request->file('image')->save('pic', 'public');
        }



        if ($request->has('jtoken')) {
            $set = AcademicSet::where('token', $request->input('jtoken'));
            if ($set) {
                $student->set_id = $set->first()->id;
            }
        }

        $save = $student->save();

        // Automatically log student in

        Auth()->login($user);
        return User::redirectToDashboard()->with('message', 'Account has been created');
    }

    private function data()
    {
        $user = auth()?->user();
        $student = $user?->student;
        $set = $student?->set;
        $advisor = $set?->advisor->user;
        $courses = $student?->courses;

        return compact('user', 'set', 'student', 'courses', 'advisor');
    }

    public function register(Request $request)
    {

        $title = 'Registeration Form';

        $invitation = AcademicSet::getSetFromURL();
        $jointoken = null;

        if ($invitation) {
            $title =  "Joining {$invitation->name}";
            $jointoken = $request->input('jointkn');
        }


        return view('auth.student-registration', compact('invitation', 'title', 'jointoken'));
    }



    public function getStudent(Request $request) {
        $student_id = $request->student_id;

        if (!$student_id) {
            return response()->json(['error' => 'Student Id is required'])->status(403);
        }

        $student = Student::where('id', '=', $student_id)->with(['user', 'class'])->get();

        if (!$student) {
            return response()->json(['error' => 'Student not found'])->status(404);
        }
        $student = $student->first();
        $student->cgpa = $student->calculateCGPA();
        $student->image = $student->picture();

        return $student;
    }
}
