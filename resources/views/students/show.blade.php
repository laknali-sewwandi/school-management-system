<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile - School MS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 font-sans antialiased">
    <div class="min-h-screen flex">
        
        @include('layouts.sidebar')

        <div class="flex-1 p-10 overflow-y-auto bg-slate-50">
            
            <div class="flex justify-between items-center mb-10">
                <div class="flex items-center gap-4">
                    <div class="bg-emerald-100 p-3 rounded-2xl text-emerald-600 shadow-sm">
                        <i class="fa-solid fa-user-graduate text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-extrabold text-slate-800">Student Profile</h2>
                        <p class="text-slate-500 mt-1 text-sm font-medium">Detailed view of student information</p>
                    </div>
                </div>
                <a href="{{ route('students.index') }}" class="bg-white border border-slate-200 text-slate-700 hover:bg-slate-100 font-bold py-2.5 px-5 rounded-xl shadow-sm transition-all flex items-center text-sm">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Back to List
                </a>
            </div>

            <div class="max-w-6xl mx-auto">
                <div class="bg-white rounded-3xl shadow-lg border border-slate-100 overflow-hidden relative">
                    <div class="h-3 w-full bg-gradient-to-r from-emerald-500 to-teal-500 absolute top-0 left-0"></div>
                    
                    <div class="p-10">
                        <div class="flex items-center gap-8 mb-10 pb-10 border-b border-slate-100">
                            <div class="h-24 w-24 rounded-full bg-emerald-50 border-4 border-emerald-100 text-emerald-600 flex items-center justify-center font-black text-4xl shadow-sm">
                                {{ strtoupper(substr($student->name, 0, 1)) }}
                            </div>
                            <div>
                                <h1 class="text-3xl font-black text-slate-800 mb-2">{{ $student->name }}</h1>
                                <span class="bg-slate-100 text-slate-600 px-4 py-1.5 rounded-lg text-sm font-bold tracking-wide">Student ID: {{ $student->student_id }}</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            
                            <div class="space-y-5 border-r border-slate-100 pr-4">
                                <h3 class="text-lg font-extrabold text-slate-800 flex items-center mb-4">
                                    <i class="fa-solid fa-address-card text-emerald-500 mr-2"></i> Personal Details
                                </h3>
                                <div>
                                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Contact Number</p>
                                    <p class="text-sm font-black text-slate-700">{{ $student->contact ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Date of Birth</p>
                                    <p class="text-sm font-black text-slate-700">{{ $student->dob ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Address</p>
                                    <p class="text-sm font-black text-slate-700">{{ $student->address ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <div class="space-y-5 border-r border-slate-100 pr-4">
                                <h3 class="text-lg font-extrabold text-slate-800 flex items-center mb-4">
                                    <i class="fa-solid fa-user-shield text-indigo-500 mr-2"></i> Parent Details
                                </h3>
                                <div>
                                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Parent Name</p>
                                    <p class="text-sm font-black text-slate-700">
                                        {{ $student->parent ? $student->parent->name : 'No Parent Assigned' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Emergency Contact</p>
                                    <p class="text-sm font-black text-slate-700">
                                        <i class="fa-solid fa-phone text-xs text-slate-400 mr-1"></i>
                                        {{ $student->parent ? $student->parent->contact : 'N/A' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Parent ID</p>
                                    <p class="text-sm font-medium text-slate-500">
                                        {{ $student->parent_id ?? 'N/A' }}
                                    </p>
                                </div>
                            </div>

                            <div class="space-y-5 bg-slate-50 p-6 rounded-2xl border border-slate-100 h-fit">
                                <h3 class="text-lg font-extrabold text-slate-800 flex items-center mb-2">
                                    <i class="fa-solid fa-chart-pie text-emerald-500 mr-2"></i> Performance
                                </h3>
                                
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <p class="text-xs font-bold text-slate-500">Attendance</p>
                                        <span class="text-sm font-black text-slate-800">{{ number_format($student->attendance_percentage, 0) }}%</span>
                                    </div>
                                    <div class="w-full bg-slate-200 rounded-full h-2.5 shadow-inner mb-2">
                                        <div class="h-2.5 rounded-full transition-all duration-500 {{ $student->attendance_percentage >= 75 ? 'bg-emerald-500' : ($student->attendance_percentage >= 50 ? 'bg-amber-500' : 'bg-rose-500') }}" 
                                             style="width: {{ $student->attendance_percentage }}%">
                                        </div>
                                    </div>
                                    <p class="text-[11px] font-bold text-slate-400 text-right">
                                        @if($student->attendance_percentage >= 75) Good Standing
                                        @elseif($student->attendance_percentage >= 50) Needs Improvement
                                        @else Critical Warning
                                        @endif
                                    </p>
                                </div>
                            </div>

                        </div>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>