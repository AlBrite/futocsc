
<x-user-layout title="Advisor - Results" nav="results">        

    <div class="flex justify-center gap-5 flex-col h-full">
        <div class="horizontal-nav flex items-center text-sm font-semibold gap-4 text-body-200">
            <a href="/advisor/results">View Results</a>
            <a href="/advisor/upload-result" class="active">Upload Results</a>
            <a href="/advisor/cgpa-summary-result">CGPA Summary Result</a>
        </div>
        <div class="flex-1">
            <div class="flex items-center justify-center -transition-y-[50%] mt-8">
                <div class="w-[400px] h-[400px] shadow-md bg-white">
                    <form action="{{ route('import.results') }}" class="flex flex-col" method="post" enctype="multipart/form-data">
                    <input type="file" class="input" name="file" accept=".xlsx, xls"/>

                    <div class="grid grid-cols-3 gap-3 mt-8">
                        <div>
                            <select class="input w-full px-3 py-2" x-on:change="level=$e.value" name="session">
                                <option value="100">100 Level</option>
                                <option value="200">200 Level</option>
                                <option value="300">300 Level</option>
                                <option value="400">400 Level</option>
                                <option value="500">500 Level</option>
                            </select>
                        </div>
                        <div>
                            <select class="input w-full px-3 py-2" x-on:change="fetchCourse" name="semester" placeholder="Semeter">
                                <option value="harmattan">Harmattan</option>
                                <option value="rain">Rain</option>
                            </select>
                        </div>
                        
                    </div>
                    
                    <div class="grid grid-cols-3 gap-3 mt-8">
                        <div>
                            <select class="input w-full px-3 py-2" name="session">
                                <option value="2023/2024">2023/2024</option>
                                <option value="2024/2024">2024/2024</option>
                            </select>
                        </div>
                        <div>
                            <select class="input w-full px-3 py-2" name="semester" placeholder="Semeter">
                                <option value="harmattan">CSC 401</option>
                                <option value="rain">Rain</option>
                            </select>
                        </div>
                        <div>
                            <select class="input w-full px-3 py-2" name="semester" placeholder="Semeter">
                                <option value="harmattan">5 Grading</option>
                                <option value="rain">4 Grading</option>
                            </select>
                        </div>
                        
                    </div>

                    

                        @csrf 
                        <button type="submit" class="btn-primary" name="Import">Import Results</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    
    <script>

    </script>
</x-user-layout>