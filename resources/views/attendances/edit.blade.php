<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Attendance - School MS</title>
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
                        <h2 class="text-3xl font-extrabold text-slate-800">Edit Attendance</h2>
                        <p class="text-slate-500 mt-1 text-sm font-medium">Update student attendance record</p>
                    </div>
                </div>
                <a href="{{ route('attendances.index') }}" class="bg-white border border-slate-200 text-slate-700 hover:bg-slate-100 font-bold py-2.5 px-5 rounded-xl shadow-sm transition-all duration-300 flex items-center text-sm">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Back to List
                </a>
            </div>

            <div class="bg-white rounded-3xl shadow-lg border border-slate-100 overflow-hidden relative max-w-4xl">
                <div class="h-2 w-full bg-gradient-to-r from-orange-400 to-amber-500 absolute top-0 left-0"></div>
                
                <form action="{{ route('attendances.update', $attendance->attendance_id) }}" method="POST" class="p-10">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-slate-700 mb-2">Student <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i class="fa-solid fa-user-graduate absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                                <select name="student_id" required class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 bg-slate-50 focus:bg-white text-sm font-medium transition-all text-slate-700 appearance-none">
                                    @foreach($students as $student)
                                        <option value="{{ $student->student_id }}" {{ $attendance->student_id == $student->student_id ? 'selected' : '' }}>
                                            ID: {{ $student->student_id }} - {{ $student->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Marked By (Teacher) <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i class="fa-solid fa-chalkboard-user absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                                <select name="teacher_id" required class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 bg-slate-50 focus:bg-white text-sm font-medium transition-all text-slate-700 appearance-none">
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->teacher_id }}" {{ $attendance->teacher_id == $teacher->teacher_id ? 'selected' : '' }}>
                                            ID: {{ $teacher->teacher_id }} - {{ $teacher->name ?? 'Teacher Name' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Date <span class="text-red-500">*</span></label>
                            <input type="date" name="date" required value="{{ $attendance->date }}" class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 bg-slate-50 focus:bg-white text-sm font-medium transition-all text-slate-700">
                        </div>

                        <div class="md:col-span-2 mt-4">
                            <label class="block text-sm font-bold text-slate-700 mb-4">Attendance Status <span class="text-red-500">*</span></label>
                            
                            <div class="flex gap-6">
                                <label class="cursor-pointer flex-1">
                                    <input type="radio" name="status" value="present" required {{ $attendance->status == 'present' ? 'checked' : '' }} class="peer sr-only">
                                    <div class="rounded-xl border-2 border-slate-200 p-4 hover:bg-slate-50 transition-all peer-checked:border-emerald-500 peer-checked:bg-emerald-50 flex items-center gap-3">
                                        <div class="h-6 w-6 rounded-full border-2 border-slate-300 peer-checked:border-emerald-500 flex items-center justify-center">
                                            <div class="h-3 w-3 rounded-full bg-emerald-500 opacity-0 peer-checked:opacity-100 transition-all"></div>
                                        </div>
                                        <span class="font-bold text-slate-700">Present</span>
                                    </div>
                                </label>

                                <label class="cursor-pointer flex-1">
                                    <input type="radio" name="status" value="late" {{ $attendance->status == 'late' ? 'checked' : '' }} class="peer sr-only">
                                    <div class="rounded-xl border-2 border-slate-200 p-4 hover:bg-slate-50 transition-all peer-checked:border-amber-500 peer-checked:bg-amber-50 flex items-center gap-3">
                                        <div class="h-6 w-6 rounded-full border-2 border-slate-300 peer-checked:border-amber-500 flex items-center justify-center">
                                            <div class="h-3 w-3 rounded-full bg-amber-500 opacity-0 peer-checked:opacity-100 transition-all"></div>
                                        </div>
                                        <span class="font-bold text-slate-700">Late</span>
                                    </div>
                                </label>

                                <label class="cursor-pointer flex-1">
                                    <input type="radio" name="status" value="absent" {{ $attendance->status == 'absent' ? 'checked' : '' }} class="peer sr-only">
                                    <div class="rounded-xl border-2 border-slate-200 p-4 hover:bg-slate-50 transition-all peer-checked:border-rose-500 peer-checked:bg-rose-50 flex items-center gap-3">
                                        <div class="h-6 w-6 rounded-full border-2 border-slate-300 peer-checked:border-rose-500 flex items-center justify-center">
                                            <div class="h-3 w-3 rounded-full bg-rose-500 opacity-0 peer-checked:opacity-100 transition-all"></div>
                                        </div>
                                        <span class="font-bold text-slate-700">Absent</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                    </div>

                    <div class="flex items-center justify-end gap-4 mt-8 pt-8 border-t border-slate-50">
                        <button type="submit" class="bg-gradient-to-r from-orange-500 to-amber-600 hover:from-orange-600 hover:to-amber-700 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg shadow-orange-500/30 transition-all duration-300 flex items-center">
                            <i class="fa-solid fa-check mr-2"></i> Update Attendance
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</body>
</html>