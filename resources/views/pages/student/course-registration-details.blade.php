<x-template title='Course Registration Details' nav="courses">
    <div class="scrollerx">
        <div class="hide-on-print px-4">
            <x-page-header>
                    <span>
                        Course Registration Details
                    </span>
                    
                    <button @click="handlePrint" type="button"
                        class="btn-sm bg-[var(--primary)] rounded text-white hover:bg-[var(--primary-700)] transition text-sm">
                        Print
                    </button>
                </div>

            </x-page-header>
        </div>
        <div class="scroller grid place-items-center">
            <div id="registered-courses-details-container" class="mt-2 border slate-400 rounded p-7 pb-10 md:flex md:flex-col md:gap-2 visible-on-print w-[800px] ">
                <div class="flex flex-col center">
                    <img src="{{asset('images/futo-log.png')}}" alt="futo-logo" width="35">
                    <h1 class="text-sm font-semibold text-body-400 md:text-base xl:text-lg print:text-black">
                        FEDERAL UNIVERSITY OF TECHNOLOGY, OWERRI
                    </h1>
                    <p class="text-xs text-body-400 font-semibold md:text-sm xl:text-base print:text-black">DEPARTMENT OF COMPUTER SCIENCE (SICT)</p>
                </div>
    
                <div class="flex flex-col md:flex-row gap-3 center mt-4 w-full
                 lg:p-5" id="student-info">
                    <x-profile-pic :user="$student" alt="user" class="rounded-full w-16 lg:w-24 xl:w-28"/>
    
                    <div
                    class="flex-1 text-[.78rem] text-body-800 w-full items-center whitespace-nowrap md:text-sm responsive-tablex print:text-black">
                        <table>
                            <tbody>
                                <tr>
                                    <td>Full Name:</td>
                                    <td class="uppercase font-semibold">{{$user->name}}</td>
                                    <td>Registration Number:</td>
                                    <td class="uppercase font-semibold">{{$student->reg_no}}</td>
                                </tr>
    
                                <tr>
                                    <td>School:</td>
                                    <td class="uppercase font-semibold">SICT</td>
                                    <td>Department:</td>
                                    <td class="uppercase font-semibold">Computer Science</td>
                                </tr>
    
                                <tr>
                                    <td>Entry Mode:</td>
                                    <td class="uppercase font-semibold">UTME</td>
                                    <td>Level:</td>
                                    <td class="uppercase font-semibold">{{$level}}</td>
                                </tr>
    
                                <tr>
                                    <td>Session:</td>
                                    <td class="uppercase font-semibold">{{$session}}</td>
                                    <td>Semester:</td>
                                    <td class="uppercase font-semibold">{{$semester}}</td>
                                </tr>
                            </tbody>
                        </table>
                     
                    </div>
                </div>
                
                <div class="mt-4 responsive-tabkex">
                    <table class="responsive-table print:text-black">
                        <thead class="print:text-white">
                            <th>Course_Code</th>
                            <th>Course_Title</th>
                            <th>Units</th>
                            <th>Type</th>
                        </thead>
                        <tbody>
                            @php $totalUnits = 0; @endphp
                            @foreach($courses as $course)
                                @php $totalUnits += $course->units; @endphp
                                <tr>
                                    <td>{{$course->code}}</td>
                                    <td>{{$course->name}}</td>
                                    <td>{{$course->units}}</td>
                                    <td class="uppercase">{{$course->mandatory === 1 ? 'Compulsory':'Elective'}}</td>
                                </tr>
                            @endforeach
                            
                            <tr>
                                <td></td>
                                <td class="uppercase">Total</td>
                                <td>{{$totalUnits}}</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
    
                <div class="mt-20 grid grid-cols-2 gap-x-4 gap-y-16 text-[.8rem]
                md:w-[80%] md:self-center md:gap-x-12 md:text-sm
                lg:w-[60%]">
                    <div class="text-body-400 print:text-black font-semibold p-1 border-t-2 border-t-[var(--body-400)] border-dashed text-center">
                        Student's Signature
                    </div>
                    <div class="text-body-400 print:text-black font-semibold p-1 border-t-2  border-t-[var(--body-400)]  border-dashed text-center">
                        Date
                    </div>
                    <div class="text-body-400 print:text-black font-semibold p-1 border-t-2  border-t-[var(--body-400)]  border-dashed text-center">
                        Advisor's Signature
                    </div>
                    <div class="text-body-400  print:text-black  font-semibold p-1 border-t-2  border-t-[var(--body-400)]  border-dashed text-center">
                        HOD's Signature
                    </div>
                </div>
            </div>
        </div>

    </div>
    
    <style>
        @media print {
            #registered-courses-details-container {
                border: none;
                padding: 0px;
            }
            #user-info {
                flex-direction: row;
            }
        }
       

    </style>
</x-template>
    