<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Management - School MS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 font-sans antialiased">
    <div class="min-h-screen flex">
        
        @include('layouts.sidebar')

        <div class="flex-1 p-10 overflow-y-auto bg-slate-50">
            
            @if(session('success'))
                <div class="mb-8 bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-xl flex items-center justify-between shadow-sm transition-all">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-circle-check text-emerald-500 text-xl"></i>
                        <span class="font-bold">{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.style.display='none'" class="text-emerald-500 hover:text-emerald-700 transition-colors">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                </div>
            @endif

            <div class="flex justify-between items-center mb-10">
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-800">Students Management</h2>
                    <p class="text-slate-500 mt-1 text-sm font-medium">Manage and organize student records</p>
                </div>
                <a href="{{ route('students.create') }}" class="bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold py-3.5 px-6 rounded-xl shadow-lg transition-all duration-300 flex items-center transform hover:-translate-y-1">
                    <i class="fa-solid fa-user-plus mr-2"></i> Add New Student
                </a>
            </div>

            <form action="{{ route('students.index') }}" method="GET" class="mb-8 bg-white p-3 pr-4 rounded-2xl shadow-md border border-slate-100 flex gap-3 items-center">
                <div class="relative flex-1 group">
                    <i class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search students by name or contact number..." 
                           class="w-full pl-12 pr-4 py-3.5 rounded-xl bg-transparent outline-none text-sm font-medium text-slate-800">
                </div>
                <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white px-8 py-3 rounded-xl text-sm font-bold transition">
                    <i class="fa-solid fa-filter mr-2"></i> Search
                </button>
                
                @if(isset($search) && $search != '')
                    <a href="{{ route('students.index') }}" class="bg-red-50 text-red-600 px-6 py-3 rounded-xl font-bold text-sm flex items-center">
                        <i class="fa-solid fa-xmark mr-2"></i> Clear
                    </a>
                @endif
            </form>

            <div class="bg-white rounded-3xl shadow-lg border border-slate-100 overflow-hidden">
                <table class="min-w-full text-left border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-8 py-5 text-slate-500 uppercase text-xs font-extrabold">ID</th>
                            <th class="px-8 py-5 text-slate-500 uppercase text-xs font-extrabold">Student Info</th>
                            <th class="px-8 py-5 text-slate-500 uppercase text-xs font-extrabold">Contact</th>
                            <th class="px-8 py-5 text-slate-500 uppercase text-xs font-extrabold">Attendance</th>
                            <th class="px-8 py-5 text-slate-500 uppercase text-xs font-extrabold text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-slate-700 text-sm divide-y divide-slate-50">
                        @forelse($students as $student)
                        <tr class="hover:bg-emerald-50/40 transition">
                            <td class="px-8 py-5 font-bold text-slate-500">{{ $student->student_id }}</td>
                            <td class="px-8 py-5">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-extrabold mr-4">
                                        {{ strtoupper(substr($student->name, 0, 1)) }}
                                    </div>
                                    <span class="font-extrabold text-slate-800">{{ $student->name }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-5">{{ $student->contact }}</td>
                            
                            <td class="px-8 py-5 w-48">
                                <div class="flex items-center justify-between mb-1.5">
                                    <span class="text-xs font-black text-slate-700">{{ number_format($student->attendance_percentage, 0) }}%</span>
                                </div>
                                <div class="w-full bg-slate-200 rounded-full h-2 shadow-inner">
                                    <div class="h-2 rounded-full transition-all duration-500 {{ $student->attendance_percentage >= 75 ? 'bg-emerald-500' : ($student->attendance_percentage >= 50 ? 'bg-amber-500' : 'bg-rose-500') }}" 
                                         style="width: {{ $student->attendance_percentage }}%">
                                    </div>
                                </div>
                            </td>

                            <td class="px-8 py-5">
                                <div class="flex justify-center gap-3">
                                    
                                    <a href="{{ route('students.show', $student->student_id) }}" class="text-emerald-600 hover:text-white bg-emerald-50 hover:bg-emerald-600 p-2.5 rounded-xl transition-all" title="View Profile">
                                        <i class="fa-solid fa-eye w-4"></i>
                                    </a>

                                    <a href="{{ route('students.edit', $student->student_id) }}" class="text-blue-600 hover:text-white bg-blue-50 hover:bg-blue-600 p-2.5 rounded-xl transition-all" title="Edit Student">
                                        <i class="fa-solid fa-pen-to-square w-4"></i>
                                    </a>

                                    <form action="{{ route('students.destroy', $student->student_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?');" class="m-0 p-0 inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-white bg-red-50 hover:bg-red-500 p-2.5 rounded-xl transition-all" title="Delete Student">
                                            <i class="fa-solid fa-trash w-4"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="p-10 text-center text-slate-500 font-medium">No students found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>
</html>