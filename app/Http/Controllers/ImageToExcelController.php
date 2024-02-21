<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;

class ImageToExcelController extends Controller
{
    public function convert(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image',
        ]);

        $image = $request->file('image');

        // Perform OCR to extract text from the image
        $text = (new TesseractOCR($image->path()))->run();

        // Extract data from the OCR result (eg "REG. NO" and "Total")
        $data = $this->processText($text);

        // Save data to the "Results" table
        Result::create([
            'reg_no' => $data['reg_no'],
            'score' => $data['total']
        ]);

        return redirect()->back()->with('success', 'Excel file generated.');
    }

    private function processText($text)
    {

        // Split the OCR result into lines
        $lines = preg_split('/\n/', $text);

        $regNo = null;
        $total = null;

        foreach ($lines as $line) {
            // Check if the line contains "REG. NO." and extract the value
            if (stripos($line, 'REG. NO.') !== false) {
                $regNo = trim(str_ireplace('REG. NO.', '', $line));
            }

            if (stripos($line, 'total') !== false) {
                $total = trim(str_ireplace('total', '', $line));
            }

            // If both values are found, exit the loop
            if ($regNo !== null && $total !== null) {
                break;
            }
        }


        return [
            'reg_no' => $regNo,
            'total' => $total
        ];








        // $lines = explode("\n", $text);

        // // Generate Excel
        // Excel::create('image_to_excel', function ($excel) use ($lines) {
        //     $excel->sheet('Sheet 1', function ($sheet) use ($lines) {
        //         $sheet->fromArray($lines);
        //     });
        // })->export('xlsx');

    }
}
