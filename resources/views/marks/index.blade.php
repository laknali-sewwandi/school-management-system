<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Marks - School MS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 font-sans antialiased">
    <div class="min-h-screen flex">
        @include('layouts.sidebar')

        <div class="flex-1 p-10 overflow-y-auto bg-slate-50">
            
            <div class="flex justify-between items-center mb-10">
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-800">Exam Marks</h2>
                    <p class="text-slate-500 mt-1 text-sm font-medium">Manage student examination results</p>
                </div>
                <a href="{{ route('marks.create') }}" class="bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white font-bold py-3 px-6 rounded-xl shadow-lg transition-all flex items-center">
                    <i class="fa-solid fa-plus mr-2"></i> Add Marks
                </a>
            </div>

            <form action="{{ route('marks.index') }}" method="GET" class="mb-8 bg-white p-3 pr-4 rounded-2xl shadow-md border border-slate-100 flex gap-3 items-center">
                <div class="relative flex-1 group">
                    <i class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search by student name or exam..." class="w-full pl-12 pr-4 py-3.5 rounded-xl bg-transparent outline-none text-sm font-medium text-slate-800 focus:bg-slate-50 transition-all">
                </div>
                <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white px-8 py-3 rounded-xl text-sm font-bold transition">Search</button>
                @if(isset($search) && $search != '')
                    <a href="{{ route('marks.index') }}" class="bg-red-50 text-red-600 px-6 py-3 rounded-xl font-bold text-sm flex items-center hover:bg-red-100"><i class="fa-solid fa-xmark mr-2"></i> Clear</a>
                @endif
            </form>

            <div class="bg-white rounded-3xl shadow-lg border border-slate-100 overflow-hidden">
                <table class="min-w-full text-left border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-5 text-slate-500 uppercase text-xs font-extrabold">Exam Name</th>
                            <th class="px-6 py-5 text-slate-500 uppercase text-xs font-extrabold">Student Info</th>
                            <th class="px-6 py-5 text-slate-500 uppercase text-xs font-extrabold">Subject</th>
                            <th class="px-6 py-5 text-slate-500 uppercase text-xs font-extrabold text-center">Marks</th>
                            <th class="px-6 py-5 text-slate-500 uppercase text-xs font-extrabold text-center">Grade</th>
                            <th class="px-6 py-5 text-slate-500 uppercase text-xs font-extrabold text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-slate-700 text-sm divide-y divide-slate-50">
                        @forelse($marks as $mark)
                        <tr class="hover:bg-orange-50/40 transition">
                            <td class="px-6 py-5 font-bold text-slate-700">
                                <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-lg text-xs">{{ $mark->exam_name }}</span>
                            </td>
                            <td class="px-6 py-5">
                                <div class="font-extrabold text-slate-800">{{ $mark->student ? $mark->student->name : 'Unknown' }}</div>
                                <div class="text-xs text-slate-400 font-bold mt-1">ID: {{ $mark->student_id }}</div>
                            </td>
                            <td class="px-6 py-5 font-bold text-slate-600">
                                <i class="fa-solid fa-book text-slate-300 mr-2"></i> {{ $mark->subject ? $mark->subject->subject_name : 'Unknown' }}
                            </td>
                            <td class="px-6 py-5 text-center font-black text-lg text-slate-800">{{ $mark->marks }}</td>
                            <td class="px-6 py-5 text-center">
                                @if($mark->grade == 'A') <span class="bg-emerald-100 text-emerald-700 px-3 py-1.5 rounded-xl font-black">A</span>
                                @elseif($mark->grade == 'B') <span class="bg-blue-100 text-blue-700 px-3 py-1.5 rounded-xl font-black">B</span>
                                @elseif($mark->grade == 'C') <span class="bg-amber-100 text-amber-700 px-3 py-1.5 rounded-xl font-black">C</span>
                                @elseif($mark->grade == 'S') <span class="bg-orange-100 text-orange-700 px-3 py-1.5 rounded-xl font-black">S</span>
                                @else <span class="bg-rose-100 text-rose-700 px-3 py-1.5 rounded-xl font-black">W</span>
                                @endif
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex justify-center gap-3">
                                    <a href="{{ route('marks.edit', $mark->mark_id) }}" class="text-blue-600 hover:text-white bg-blue-50 hover:bg-blue-600 p-2.5 rounded-xl transition-all"><i class="fa-solid fa-pen-to-square w-4"></i></a>
                                    <form action="{{ route('marks.destroy', $mark->mark_id) }}" method="POST" onsubmit="return confirm('Delete this record?');" class="inline-block">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-white bg-red-50 hover:bg-red-500 p-2.5 rounded-xl transition-all"><i class="fa-solid fa-trash w-4"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="p-10 text-center text-slate-500 font-medium">No exam marks found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>
</html>