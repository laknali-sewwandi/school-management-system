<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Marks - School MS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 font-sans antialiased">
    <div class="min-h-screen flex">
        @include('layouts.sidebar')

        <div class="flex-1 p-10 overflow-y-auto bg-slate-50">
            
            <div class="flex justify-between items-center mb-10">
                <div class="flex items-center gap-4">
                    <div class="bg-orange-100 p-3 rounded-2xl text-orange-600 shadow-sm">
                        <i class="fa-solid fa-pen-to-square text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-extrabold text-slate-800">Edit Exam Marks</h2>
                        <p class="text-slate-500 mt-1 text-sm font-medium">Update student performance</p>
                    </div>
                </div>
                <a href="{{ route('marks.index') }}" class="bg-white border border-slate-200 text-slate-700 hover:bg-slate-100 font-bold py-2.5 px-5 rounded-xl shadow-sm transition-all flex items-center text-sm">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Back to List
                </a>
            </div>

            <div class="bg-white rounded-3xl shadow-lg border border-slate-100 overflow-hidden relative max-w-4xl">
                <div class="h-2 w-full bg-gradient-to-r from-orange-500 to-amber-500 absolute top-0 left-0"></div>
                
                <form action="{{ route('marks.update', $mark->mark_id) }}" method="POST" class="p-10">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        
                        <!-- Select Student -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Student <span class="text-red-500">*</span></label>
                            <select name="student_id" required class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-orange-500 bg-slate-50 focus:bg-white text-sm font-medium text-slate-700">
                                @foreach($students as $student)
                                    <option value="{{ $student->student_id }}" {{ $mark->student_id == $student->student_id ? 'selected' : '' }}>
                                        ID: {{ $student->student_id }} - {{ $student->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Select Subject -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Subject <span class="text-red-500">*</span></label>
                            <select name="subject_id" required class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-orange-500 bg-slate-50 focus:bg-white text-sm font-medium text-slate-700">
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->subject_id }}" {{ $mark->subject_id == $subject->subject_id ? 'selected' : '' }}>
                                        {{ $subject->subject_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Exam Name -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-slate-700 mb-2">Exam Name <span class="text-red-500">*</span></label>
                            <input type="text" name="exam_name" value="{{ $mark->exam_name }}" required class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-orange-500 bg-slate-50 focus:bg-white text-sm font-medium text-slate-700">
                        </div>

                        <!-- Marks -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Marks (0-100) <span class="text-red-500">*</span></label>
                            <input type="number" name="marks" id="marksInput" value="{{ $mark->marks }}" min="0" max="100" required class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-orange-500 bg-slate-50 focus:bg-white text-sm font-black text-slate-800 text-lg">
                        </div>

                        <!-- Grade (Auto Calculated) -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Grade <span class="text-slate-400 font-normal text-xs">(Auto Calculated)</span></label>
                            <input type="text" name="grade" id="gradeInput" value="{{ $mark->grade }}" readonly required class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-slate-100 text-sm font-black text-slate-800 text-lg cursor-not-allowed outline-none">
                        </div>

                    </div>

                    <div class="flex justify-end pt-5 border-t border-slate-50">
                        <button type="submit" class="bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg transition-all flex items-center">
                            <i class="fa-solid fa-check mr-2"></i> Update Marks
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const marksInput = document.getElementById('marksInput');
        
        function calculateGrade() {
            let marks = parseInt(marksInput.value);
            let gradeInput = document.getElementById('gradeInput');
            
            if(isNaN(marks) || marks < 0 || marks > 100) {
                gradeInput.value = '';
                gradeInput.className = "w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-slate-100 text-sm font-black text-slate-800 text-lg cursor-not-allowed outline-none";
            } else if (marks >= 75) {
                gradeInput.value = 'A';
                gradeInput.className = "w-full px-4 py-3.5 rounded-xl border-2 border-emerald-500 bg-emerald-50 text-emerald-700 text-sm font-black text-lg outline-none";
            } else if (marks >= 65) {
                gradeInput.value = 'B';
                gradeInput.className = "w-full px-4 py-3.5 rounded-xl border-2 border-blue-500 bg-blue-50 text-blue-700 text-sm font-black text-lg outline-none";
            } else if (marks >= 55) {
                gradeInput.value = 'C';
                gradeInput.className = "w-full px-4 py-3.5 rounded-xl border-2 border-amber-500 bg-amber-50 text-amber-700 text-sm font-black text-lg outline-none";
            } else if (marks >= 35) {
                gradeInput.value = 'S';
                gradeInput.className = "w-full px-4 py-3.5 rounded-xl border-2 border-orange-500 bg-orange-50 text-orange-700 text-sm font-black text-lg outline-none";
            } else {
                gradeInput.value = 'W';
                gradeInput.className = "w-full px-4 py-3.5 rounded-xl border-2 border-rose-500 bg-rose-50 text-rose-700 text-sm font-black text-lg outline-none";
            }
        }

        marksInput.addEventListener('input', calculateGrade);
        
        // පේජ් එක ලෝඩ් වෙද්දිම Grade එකට පාට වැටෙන්න මේක දානවා
        window.onload = calculateGrade;
    </script>
</body>
</html>