<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Records - School MS</title>
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
                    <h2 class="text-3xl font-extrabold text-slate-800">Attendance Records</h2>
                    <p class="text-slate-500 mt-1 text-sm font-medium">View and manage daily student attendance</p>
                </div>
                <a href="{{ route('attendances.create') }}" class="bg-gradient-to-r from-orange-500 to-amber-600 hover:from-orange-600 hover:to-amber-700 text-white font-bold py-3.5 px-6 rounded-xl shadow-lg transition-all duration-300 flex items-center transform hover:-translate-y-1">
                    <i class="fa-solid fa-clipboard-check mr-2"></i> Mark Attendance
                </a>
            </div>

            <form action="{{ route('attendances.index') }}" method="GET" class="mb-8 bg-white p-3 pr-4 rounded-2xl shadow-md border border-slate-100 flex gap-3 items-center">
                <div class="relative flex-1 group">
                    <i class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search by student name, date or status..." 
                           class="w-full pl-12 pr-4 py-3.5 rounded-xl bg-transparent outline-none text-sm font-medium text-slate-800 focus:bg-slate-50 transition-all">
                </div>
                <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white px-8 py-3 rounded-xl text-sm font-bold transition">
                    <i class="fa-solid fa-filter mr-2"></i> Search
                </button>
                @if(isset($search) && $search != '')
                    <a href="{{ route('attendances.index') }}" class="bg-red-50 text-red-600 px-6 py-3 rounded-xl font-bold text-sm flex items-center hover:bg-red-100 transition-colors">
                        <i class="fa-solid fa-xmark mr-2"></i> Clear
                    </a>
                @endif
            </form>

            <div class="bg-white rounded-3xl shadow-lg border border-slate-100 overflow-hidden">
                <table class="min-w-full text-left border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-8 py-5 text-slate-500 uppercase text-xs font-extrabold">Date</th>
                            <th class="px-8 py-5 text-slate-500 uppercase text-xs font-extrabold">Student Info</th>
                            <th class="px-8 py-5 text-slate-500 uppercase text-xs font-extrabold">Status</th>
                            <th class="px-8 py-5 text-slate-500 uppercase text-xs font-extrabold">Marked By</th>
                            <th class="px-8 py-5 text-slate-500 uppercase text-xs font-extrabold text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-slate-700 text-sm divide-y divide-slate-50">
                        @forelse($attendances as $attendance)
                        <tr class="hover:bg-orange-50/40 transition">
                            <td class="px-8 py-5 font-bold text-slate-600">
                                <i class="fa-regular fa-calendar text-slate-400 mr-2"></i> {{ $attendance->date }}
                            </td>
                            
                            <td class="px-8 py-5">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-extrabold mr-4">
                                        {{ $attendance->student ? strtoupper(substr($attendance->student->name, 0, 1)) : '?' }}
                                    </div>
                                    <div>
                                        <p class="font-extrabold text-slate-800">{{ $attendance->student ? $attendance->student->name : 'Unknown Student' }}</p>
                                        <p class="text-xs font-bold text-slate-400">ID: {{ $attendance->student_id }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-8 py-5">
                                @if($attendance->status == 'present')
                                    <span class="bg-emerald-100 text-emerald-700 border border-emerald-200 px-4 py-1.5 rounded-lg text-xs font-extrabold flex items-center w-max">
                                        <div class="h-2 w-2 rounded-full bg-emerald-500 mr-2"></div> Present
                                    </span>
                                @elseif($attendance->status == 'late')
                                    <span class="bg-amber-100 text-amber-700 border border-amber-200 px-4 py-1.5 rounded-lg text-xs font-extrabold flex items-center w-max">
                                        <div class="h-2 w-2 rounded-full bg-amber-500 mr-2"></div> Late
                                    </span>
                                @else
                                    <span class="bg-rose-100 text-rose-700 border border-rose-200 px-4 py-1.5 rounded-lg text-xs font-extrabold flex items-center w-max">
                                        <div class="h-2 w-2 rounded-full bg-rose-500 mr-2"></div> Absent
                                    </span>
                                @endif
                            </td>

                            <td class="px-8 py-5">
                                <span class="font-bold text-slate-500 border border-slate-200 bg-slate-50 px-3 py-1 rounded-lg text-xs">
                                    <i class="fa-solid fa-chalkboard-user mr-1 text-slate-400"></i>
                                    {{ $attendance->teacher ? $attendance->teacher->name : 'Teacher ID: ' . $attendance->teacher_id }}
                                </span>
                            </td>

                            <td class="px-8 py-5">
                                <div class="flex justify-center gap-3">
                                    
                                         <a href="{{ route('attendances.edit', $attendance->attendance_id) }}" class="text-blue-600 hover:text-white bg-blue-50 hover:bg-blue-600 p-2.5 rounded-xl transition-all" title="Edit Record">
                                         <i class="fa-solid fa-pen-to-square w-4"></i>
                                         </a>

                                     <form action="{{ route('attendances.destroy', $attendance->attendance_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');" class="m-0 p-0 inline-block">
                              @csrf
                              @method('DELETE')
                             <button type="submit" class="text-red-500 hover:text-white bg-red-50 hover:bg-red-500 p-2.5 rounded-xl transition-all" title="Delete Record">
                            <i class="fa-solid fa-trash w-4"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-10 text-center text-slate-500 font-medium">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="bg-slate-100 p-4 rounded-full mb-3 text-slate-400 text-2xl">
                                        <i class="fa-solid fa-folder-open"></i>
                                    </div>
                                    <p>No attendance records found.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>
</html>