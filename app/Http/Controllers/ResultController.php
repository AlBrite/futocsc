<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ResultController extends Controller
{
    public function import(Request $request)
    {
        $file = $request->file('file');
        $excel = IOFactory::load($file);
        $worksheet = $excel->getActiveSheet();
        $rows = $worksheet->toArray();

        $patterns = [
            'reg_no' => '/reg\s+number/i',
            'score' => '/score/i'
        ];



        foreach ($rows as $index => $row) {

            $header = null;
            foreach ($patterns as $field => $pattern) {
                $count = count($row);
                for ($i = 0; $i < $count; $i++) {
                    if (preg_match($pattern, $row[$i])) {
                        $header = $index;
                        break 3;
                    }
                }
            }
        }
        if (!empty($header)) {
            foreach ($patterns as $field => $pattern) {
                foreach ($rows[$header] as $index => $column) {
                    if (preg_match($pattern, $column)) {
                        $$field = $index;
                    }
                }
            }
        }

        $results = array_slice($rows, $header + 1);


        foreach ($results as $result) {
            $record = new Result();
            foreach ($patterns as $field => $pattern) {
                $record->$field = $result[$$field];
            }

            $record->save();
        }

        dd('Done');

        return redirect()->back()->with('success', 'Results imported successfully');
    }

    public function importForm()
    {
        $courses = Department::myDepartment()->courses;
        return view('advisor.add-result', compact('courses'));
    }

    public function calculateCGPA($results)
    {
        $totalGradePoints = 0;
        $totalCreditUnits = 0;

        foreach ($results as $result) {
            $gradePoints = $results->grade * $result->course->credit_units;
            $totalGradePoints += $gradePoints;
            $totalCreditUnits += $result->course->credit_units;
        }

        $cgpa = $totalGradePoints / $totalCreditUnits;
        return $cgpa;
    }


    public function index() {

        return view('results.index');
    }



    public function getResult() {

    }
}
