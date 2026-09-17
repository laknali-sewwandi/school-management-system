<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Attendance - School MS</title>
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
                        <i class="fa-solid fa-clipboard-user text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-extrabold text-slate-800">Mark Attendance</h2>
                        <p class="text-slate-500 mt-1 text-sm font-medium">Record daily student attendance</p>
                    </div>
                </div>
                <a href="{{ route('attendances.index') }}" class="bg-white border border-slate-200 text-slate-700 hover:bg-slate-100 font-bold py-2.5 px-5 rounded-xl shadow-sm transition-all flex items-center text-sm">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Back to List
                </a>
            </div>

            <form action="{{ route('attendances.store') }}" method="POST">
                @csrf
                
                <div class="bg-white p-8 rounded-3xl shadow-md border border-slate-100 mb-8 flex flex-col md:flex-row gap-6 relative overflow-hidden">
                    <div class="h-full w-2 bg-gradient-to-b from-orange-500 to-amber-500 absolute top-0 left-0"></div>
                    
                    <div class="flex-1">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Marked By (Teacher) <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <i class="fa-solid fa-chalkboard-user absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                            <select name="teacher_id" required class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-orange-500 bg-slate-50 focus:bg-white text-sm font-medium text-slate-700">
                                <option value="" disabled selected>-- Select Teacher --</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->teacher_id }}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="flex-1">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Date <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <i class="fa-solid fa-calendar-days absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                            <input type="date" name="date" required value="{{ date('Y-m-d') }}" class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-orange-500 bg-slate-50 focus:bg-white text-sm font-medium text-slate-700">
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-lg border border-slate-100 overflow-hidden mb-8">
                    <div class="bg-slate-800 px-8 py-5 text-white flex justify-between items-center">
                        <h3 class="font-bold"><i class="fa-solid fa-users mr-2"></i> Students List</h3>
                        <span class="bg-slate-700 px-3 py-1 rounded-lg text-xs font-bold">{{ count($students) }} Students</span>
                    </div>
                    
                    <table class="min-w-full text-left border-collapse">
                        <thead class="bg-slate-50 border-b border-slate-100">
                            <tr>
                                <th class="px-8 py-5 text-slate-500 uppercase text-xs font-extrabold w-20">ID</th>
                                <th class="px-8 py-5 text-slate-500 uppercase text-xs font-extrabold">Student Name</th>
                                <th class="px-8 py-5 text-slate-500 uppercase text-xs font-extrabold text-center">Attendance Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-slate-700 text-sm divide-y divide-slate-50">
                            @foreach($students as $student)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-8 py-4 font-bold text-slate-400">{{ $student->student_id }}</td>
                                <td class="px-8 py-4 font-extrabold text-slate-800">{{ $student->name }}</td>
                                <td class="px-8 py-4">
                                    <div class="flex justify-center gap-4">
                                        <label class="cursor-pointer flex items-center gap-2 bg-emerald-50 text-emerald-700 px-4 py-2 rounded-xl border border-emerald-200 hover:bg-emerald-100 transition">
                                            <input type="radio" name="statuses[{{ $student->student_id }}]" value="Present" checked class="w-4 h-4 text-emerald-600 focus:ring-emerald-500 border-gray-300">
                                            <span class="font-bold text-sm">Present</span>
                                        </label>
                                        
                                        <label class="cursor-pointer flex items-center gap-2 bg-rose-50 text-rose-700 px-4 py-2 rounded-xl border border-rose-200 hover:bg-rose-100 transition">
                                            <input type="radio" name="statuses[{{ $student->student_id }}]" value="Absent" class="w-4 h-4 text-rose-600 focus:ring-rose-500 border-gray-300">
                                            <span class="font-bold text-sm">Absent</span>
                                        </label>

                                        <label class="cursor-pointer flex items-center gap-2 bg-amber-50 text-amber-700 px-4 py-2 rounded-xl border border-amber-200 hover:bg-amber-100 transition">
                                            <input type="radio" name="statuses[{{ $student->student_id }}]" value="Late" class="w-4 h-4 text-amber-600 focus:ring-amber-500 border-gray-300">
                                            <span class="font-bold text-sm">Late</span>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="sticky bottom-0 bg-white/90 backdrop-blur-sm p-6 rounded-3xl shadow-[0_-10px_40px_-15px_rgba(0,0,0,0.1)] border border-slate-100 flex justify-end gap-4">
                    <button type="submit" class="bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white font-bold py-3.5 px-10 rounded-xl shadow-lg transition-all flex items-center text-lg">
                        <i class="fa-solid fa-cloud-arrow-up mr-2"></i> Save All Attendance
                    </button>
                </div>
            </form>

        </div>
    </div>
</body>
</html>