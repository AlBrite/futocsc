<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Student;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'reg_no',
        'course_id',
        'score'
    ];

    private $standard_grading = ["A"=>70,"B"=>60,"C"=>50,"E"=>45, "D"=>40, "F"=>0];


    public function course() {
        return $this->hasOne(Course::class, 'id','course_id');
    }

    public function student() {
        return $this->hasOne(Student::class, 'reg_no', 'reg_no');
    }

    public function grading() {
        return $this->hasOne(Grading::class, 'id','grading_id');
    }

    public function getGrading() {
        $score = $this->score;
        
        $grading = $this->standard_grading;
        
        try {
            
            if ($grading_system = $this->grading?->grading_system) {
                $grading = json_decode($grading_system, true);
            }
        } catch(\Exception $e) {}

        $n = count($grading) - 1;

        foreach($grading as $grade => $range) {
            if ($score >= $range) {
                return [
                    'alphaGrade' => $grade,
                    'grade' => $n,
                    'score' => $score,
                    'exam' => $this->exam,
                    'test' => $this->test,
                    'lab' => $this->lab,
                    'remark' => $grade == 'F' ? 'Failed' : 'Passed'
                ];
            }
            $n--;
        }

        return $grading;

    }

    public static function calculateGPA($records, $semester, $session) {

        $totalCredits = 0;
        $totalQualityPoints = 0;
        foreach ($records as $course) {
            $result = Result::where('semester', '=', $semester)
                ->with('grading', 'course')
                ->where('session', '=', $session)
                ->where('course_id', '=', $course->course_id)
                ->where('reg_no', '=', $course->reg_no)
                ->get()->last();

            $credits = $result->course->units;

            $gradingSystem = $result->getGrading();
          
            $grade = $gradingSystem['grade'];
            
            $qualityPoints = $grade * $credits;
            $totalCredits += $credits;
            $totalQualityPoints += $qualityPoints;
        }
        $gpa = 0;
        if ($totalCredits > 0) {
            $gpa = $totalQualityPoints / $totalCredits;
        } 
        return [
            'TGP' => $totalQualityPoints,
            'TNU' => $totalCredits,
            'GPA' => round($gpa, 2)   
        ];
    }


    public static function studentGPA($student_id, $semester, $session) {
        $enrollments = Enrollment::where('reg_no', $student_id)
            ->where('semester', $semester)
            ->where('session', $session)->get();
        
        return self::calculateGPA($enrollments, $semester, $session);
    }

    public static function studentCGPA($student_id) {
        $student = Student::where('reg_no', $student_id)->first();

        return $student->calculateCGPA(null);
    }
    public static function studentPreviousSemesterGPA($student_id, $semester, $session) {
        $splitSession = explode('/', $session);
        $mapToInt = array_map(fn($year) => (int) $year, $splitSession);
        list($start, $end) = $mapToInt;

        if ($semester === 'harmattan') {
            $start--;
            $end--;
            $semester = 'rain';
        }
        else {
            $semester = 'harmattan';
        }

        $enrollments = Enrollment::where('reg_no', $student_id)
            ->where('semester', $semester)
            ->where('session', $session)->get();
            
        return self::calculateGPA($enrollments, $semester, $session);
    }

    public static function studentPreviousSessionGPA($student_id, $semester, $session) {
        $splitSession = explode('/', $session);
        $mapToInt = array_map(fn($year) => (int) $year, $splitSession);
        list($start, $end) = $mapToInt;


        if ($semester === 'harmattan') {
            $start--;
            $end--;
        }
        else {
            $semester = 'harmattan';
        }

        $enrollments = Enrollment::where('reg_no', $student_id)
            ->where('semester', $semester)
            ->where('session', $session)->get();
            
        return self::calculateGPA($enrollments, $semester, $session);
    }


    

    
}
