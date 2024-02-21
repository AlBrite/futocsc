@php
    use \App\Models\AcademicRecord;

@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="{{asset('svg/logo.svg')}}" />
    <link rel="stylesheet" href="{{asset('styles/styles.css')}}">
    <link rel="stylesheet" href="{{asset('styles/advisor.css')}}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20,400,0,0" />
    <title>{{$student->user->name}} Transcript</title>
    <style>
        .courses {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
        }

     
        table {
            font-size: 12px;
            min-width:100%;
        }

        table,
        td,
        th {
            border: 1px solid;
        }

        
        th,
        td {
            padding: 2px;
        }

        @media print {
            body {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

            title {
                display: none;
            }

            body {
                visibility: hidden;
            }

            #div-to-print {
                visibility: visible;
            }

            header,
            footer {
                display: none;
            }

            
        }
        
    </style>
</head>

<body class="md:flex md:place-content-center">
    <header class="absolute left-2 top-2 bg-black-50 px-3 rounded border border-black hover:bg-[var(--black-100)]">
        <button type="button" onclick="printrecord()">Print</button>
    </header>
    <div class="h-[29.7cm] w-[21cm]" id="div-to-print">
        <div class="font-semibold text-center">
            <h1 class="">FEDERAL UNIVERSITY OF TECHNOLOGY, OWERRI</h1>
            <p class="text-sm">SCHOOL OF INFORMATION AND COMMUNICATION TECHNOLOGY</p>
            <p class="text-sm">DEPARTMENT OF COMPUTER SCIENCE</p>
            <br>
            <p class="text-sm">STUDENT TEMPORARY recordS</p>
        </div>

        <div>Name: <b>{{$student->user->name}}</b></div>
        <div>Reg No: <b>{{$student->reg_no}}</b></div>

        
        
        @foreach(AcademicRecord::arangeGPA($records, $student) as $session => $session_results) 
        @php
            
            
            dd($session_results);
            
        @endphp
            @foreach($session_results as $semester => $semester_results)
                @php
            
                dd($semester_results);
                    
                @endphp
            @endforeach
        
        @endforeach
        @foreach($data as $session => $results)
         <div class="p-2 grid center mt-4">
             <div style="font-weight:bolder;text-align:center;margin-top:15px; margin-bottom:15px">
                    {{$session}}
                </div>
            <table class="table font-bold text-center">
                <thead class="h-20">
                    <th class="bg-black-500 text-white uppercase">
                        
                    </th>
                    @php 
            dd($results);
                    @endphp
                    @foreach($results as $result) 
                        <th class="courses">{{$result['result']['code']}}</th>
                    @endforeach
                    <th colspan="3">CURRENT</th>
                    <th colspan="3">PREVIOUS</th>
                    <th colspan="3">CUMMULATIVE</th>
                    <th class="courses">REMARK</th>
                </thead>

                <tbody>
                    <tr>
                        <td>Unit</td>
                        <span>
                            @foreach($results as $result) 
                                <td>{{$result['unit']}}</td>
                            @endforeach
                           
                        </span>

                        <td class="opacity-0">x</td>

                        <!-- CURRENT -->
                        <td>TGP</td>
                        <td>TNU</td>
                        <td>GPA</td>
                        <!-- PREVIOUS -->
                        <td>TGP</td>
                        <td>TNU</td>
                        <td>GPA</td>
                        <!-- CUMMULATIVE -->
                        <td>TGP</td>
                        <td>TNU</td>
                        <td>GPA</td>

                        <td></td>

                    </tr>
                    <tr>
                        <td>GRADE</td>

                        @foreach($results as $result) 
                            <td>{{$result['result']['grade']}}</td>
                        @endforeach

                        <!-- CURRENT -->
                        <td>101</td>
                        <td>21</td>
                        <td>4.91</td>
                        <!-- PREVIOUS -->
                        <td>101</td>
                        <td>21</td>
                        <td>4.91</td>
                        <!-- CUMMULATIVE -->

                        
                        <td>{{$result['currentGPA']['point']}}</td>
                        <td>{{$result['currentGPA']['unit']}}</td>
                        <td>{{$result['currentGPA']['gpa']}}</td>

                        <!-- REMARK -->
                        <td>PASS</td>
                    </tr>
                </tbody>

            </table>
        </div>
        @endforeach

        @php

        dd($records);
            $data = [];
            $gradings = [];
            $gpa = 0;
            foreach($records as $session => $record):
               
                $gradings[$session] = [];
                foreach($record as $semester => $semesterRecord):
                    $data[$session] = [];
                    $prevGPA = $gpa;
                    $gpa = AcademicRecord::calculateGPA($student,$semester, $semesterRecord[0]->level);
                    
                    $data[$session]['grading'] = [
                        'preview' => $prevGPA,
                        'current' => $gpa
                    ];

                    foreach($semesterRecord as $each):
                        $gradings[$session]['result'] = [];

                        $course = $each->course;
                        $result = AcademicRecord::result($each->reg_no, $each->course_id);

                        $code = $course->code;
                        $unit = $course->unit;
                        $grade = $result->grade;
                        $gradings[$session]['result'][] = compact('code', 'grade', 'unit');
                        //$data[$session]['result'][] = 

                    endforeach;
                endforeach;
            endforeach;
dd($data);
        @endphp

        @foreach($data as $session => $results)
         <div class="p-2 grid center mt-4">
             <div style="font-weight:bolder;text-align:center;margin-top:15px; margin-bottom:15px">
                    {{$session}}
                </div>
            <table class="table font-bold text-center">
                <thead class="h-20">
                    <th class="bg-black-500 text-white uppercase">
                        
                    </th>
                    @php 
            dd($results);
                    @endphp
                    @foreach($results as $result) 
                        <th class="courses">{{$result['result']['code']}}</th>
                    @endforeach
                    <th colspan="3">CURRENT</th>
                    <th colspan="3">PREVIOUS</th>
                    <th colspan="3">CUMMULATIVE</th>
                    <th class="courses">REMARK</th>
                </thead>

                <tbody>
                    <tr>
                        <td>Unit</td>
                        <span>
                            @foreach($results as $result) 
                                <td>{{$result['unit']}}</td>
                            @endforeach
                           
                        </span>

                        <td class="opacity-0">x</td>

                        <!-- CURRENT -->
                        <td>TGP</td>
                        <td>TNU</td>
                        <td>GPA</td>
                        <!-- PREVIOUS -->
                        <td>TGP</td>
                        <td>TNU</td>
                        <td>GPA</td>
                        <!-- CUMMULATIVE -->
                        <td>TGP</td>
                        <td>TNU</td>
                        <td>GPA</td>

                        <td></td>

                    </tr>
                    <tr>
                        <td>GRADE</td>

                        @foreach($results as $result) 
                            <td>{{$result['result']['grade']}}</td>
                        @endforeach

                        <!-- CURRENT -->
                        <td>101</td>
                        <td>21</td>
                        <td>4.91</td>
                        <!-- PREVIOUS -->
                        <td>101</td>
                        <td>21</td>
                        <td>4.91</td>
                        <!-- CUMMULATIVE -->

                        
                        <td>{{$result['currentGPA']['point']}}</td>
                        <td>{{$result['currentGPA']['unit']}}</td>
                        <td>{{$result['currentGPA']['gpa']}}</td>

                        <!-- REMARK -->
                        <td>PASS</td>
                    </tr>
                </tbody>

            </table>
        </div>
        @endforeach




    </div>

</body>
<script>
    function printrecord() {
        window.print(document.body)
    }
</script>

</html>