<x-single-layout nav="courses" title="Borrow Courses">
    <h1 class="text-lg text-body-300 font-semibold">Course Registration >
        <span class="text-base">Borrow Courses</span>
    </h1>
    <div id="course-registration-container" class="flex flex-col gap-5 overflow-y-scroll">
        <div class="text-sm text-body-300 flex items-center justify-between w-[100%] lg:w-[80%]">
            <p>Total units selected:
                <span class="font-semibold">XX</span>
                out of
                <span class="font-semibold">YY</span>
                max units
            </p>

            <a href="./course-registration-borrow-courses.html" class="opacity-0 -z-10">
                <button type="button"
                    class="btn bg-[var(--primary)] rounded text-white hover:bg-[var(--primary-700)] transition text-xs">
                    Add/Borrow Courses
                </button>
            </a>
        </div>

        <div id="student-table-container" class="overflow-scroll">
            <table class="table w-[100%] lg:w-[80%] whitespace-nowrap">
                <thead>
                    <th class="w-10">Select</th>
                    <th class="w-20">Course Code</th>
                    <th>Course Title</th>
                    <th class="w-20">Units</th>
                    <th class="w-20">Type</th>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="checkbox" class="checkbox"></td>
                        <td class="uppercase">Course_Code</td>
                        <td>Course_Title</td>
                        <td>Units</td>
                        <td class="uppercase">compulsory</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="flex justify-end w-[100%] lg:w-[80%]">
            <button type="button"
                class="btn bg-[var(--primary)] text-white hover:bg-[var(--primary-700)] rounded text-sm">Borrow
                courses</button>
        </div>
    </div>
</x-single-layout>