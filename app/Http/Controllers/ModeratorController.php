<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcademicRecord;
use App\Models\Advisor;
use App\Models\Student;
use App\Models\Result;

class ModeratorController extends Controller
{
    public function view_transcripts() {
        
        $advisor = Advisor::active();
        $set = $advisor->academicSet;
        $students = $set->students()->paginate(10);
        
        return view('moderator.transcripts', compact('students', 'advisor'));
    }

    public function setExamCommencementDate(Request $request) {
        $date = $request->data;

        Advisor::update(['exam_starts_on'=>$data]);
    }

    public function secondsBeforeExam(string $date) {
        $time_diff = time() - date('Y-m-d H:i:s', $date);

        return $time_diff;
    }


    public function loadTranscript(Request $request) {
       // dd($request->all());
        $type = $request->input('transcriptType'); // full, single, range
        $reg_no = $request->input('reg_no');

        $student = Student::where('reg_no', $reg_no)->first();
        
        $records = [];

        switch($type) {
            case 'single':
                $year = $request->input('year');
                $records = $student->RegisteredCourses->where('level', $year)->groupBy(['session', 'semester']);
                break;
            case 'full':
            case 'range':
                $startyear = $request->input('startyear');
                $endyear = $request->input('endyear');
                if ($type === 'full') {
                    $startyear = 100;
                    $endyear = 500;
                }
                $startyear = min($startyear, $endyear);
                $endyear = max($startyear, $endyear);
                $enrolments = $student->enrollments()
                    ->where('level', '>=', $startyear)
                    ->where('level', '<=', $endyear)
                    ->groupBy('grouping_id')
                    ->get();
                dd($enrolments);
                $records = $student->enrollments->where('level','>', $startyear-1)->where('level','<', $endyear+1)->groupBy(['session', 'semester']);
            
                break;
        }

        
     
       return view('moderator.generated_transcript', compact('student', 'records'));
    }

    public function addStudent(Request $request) {

        dd($request);

    }


    public function generateTranscript(Request $request) {

    }
}
