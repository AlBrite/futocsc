<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ResultsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Result;
use App\Http\Controllers\Controller;

class ResultsController extends Controller
{

public function uploadExcel(Request $request)
{
    $file = $request->file('excel_file');
    
    
    $data = Excel::toArray([], $file);

    
    // Store the data in the database
    // For example:
    $n = 0;
    $matcher = ['REG NO.', 'NAME', 'PROGRAM','LAB','TEST','EXAM','TOTAL','GRADE','REMAINS'];

    $results = [];

    foreach ($data[0] as $row) {
        // if ($n == 7) {
        //     foreach($row as $col) {
        //         dd($col);
        //     }
        //     dd($row[0], $row[1]);
        // }'

        if (!$row[1] || ($row[6] === 'TOTAL'||$row[3] === 'LAB' || $row[4] ==='TEST')) {
            continue;
        }
        $tableData = [
            'reg_no' => $row[1],
            'practical' => $row[3],
            'test' => $row[4],
            'exam' => $row[5],
            'score' => $row[6]
        ];
        $results[] = $tableData;
        // dd($tableData);

       
        Result::create($tableData);
        $n++;
    }
    dd($results);
    return redirect()->back()->with('success', 'Excel file uploaded and processed successfully');
}

    public function import(Request $request) 
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new ResultsImport, $request->file('file'));

        return redirect()->back()->with('success','Results imported successfully.');
    }
}
