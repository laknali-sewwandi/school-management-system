<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes Management - School MS</title>
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
                    <button onclick="this.parentElement.style.display='none'" class="text-emerald-500 hover:text-emerald-700">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                </div>
            @endif

            <div class="flex justify-between items-center mb-10">
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-800">Classes Management</h2>
                    <p class="text-slate-500 mt-1 text-sm font-medium">Manage classes and assign class teachers</p>
                </div>
                <a href="{{ route('classes.create') }}" class="bg-gradient-to-r from-violet-600 to-fuchsia-600 hover:from-violet-700 hover:to-fuchsia-700 text-white font-bold py-3.5 px-6 rounded-xl shadow-lg transition-all flex items-center">
                    <i class="fa-solid fa-chalkboard mr-2"></i> Add New Class
                </a>
            </div>

            <form action="{{ route('classes.index') }}" method="GET" class="mb-8 bg-white p-3 pr-4 rounded-2xl shadow-md border border-slate-100 flex gap-3 items-center">
    <div class="relative flex-1 group">
        <i class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search by class name or section..." class="w-full pl-12 pr-4 py-3.5 rounded-xl bg-transparent outline-none text-sm font-medium text-slate-800 focus:bg-slate-50 transition-all">
    </div>
    <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white px-8 py-3 rounded-xl text-sm font-bold transition">
        <i class="fa-solid fa-filter mr-2"></i> Search
    </button>
    
    @if(isset($search) && $search != '')
        <a href="{{ route('classes.index') }}" class="bg-red-50 text-red-600 px-6 py-3 rounded-xl font-bold text-sm flex items-center hover:bg-red-100 transition-colors">
            <i class="fa-solid fa-xmark mr-2"></i> Clear
        </a>
    @endif
</form>

            <div class="bg-white rounded-3xl shadow-lg border border-slate-100 overflow-hidden">
                <table class="min-w-full text-left border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-8 py-5 text-slate-500 uppercase text-xs font-extrabold">ID</th>
                            <th class="px-8 py-5 text-slate-500 uppercase text-xs font-extrabold">Class Name</th>
                            <th class="px-8 py-5 text-slate-500 uppercase text-xs font-extrabold">Section</th>
                            <th class="px-8 py-5 text-slate-500 uppercase text-xs font-extrabold">Class Teacher</th>
                            <th class="px-8 py-5 text-slate-500 uppercase text-xs font-extrabold text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-slate-700 text-sm divide-y divide-slate-50">
                        @forelse($classes as $schoolClass)
                        <tr class="hover:bg-violet-50/40 transition">
                            <td class="px-8 py-5 font-bold text-slate-500">{{ $schoolClass->class_id }}</td>
                            <td class="px-8 py-5 font-extrabold text-slate-800">{{ strtoupper($schoolClass->class_name) }}</td>
                            <td class="px-8 py-5">
                                <span class="bg-violet-100 text-violet-700 px-3 py-1 rounded-lg font-bold text-xs">{{ $schoolClass->section }}</span>
                            </td>
                            <td class="px-8 py-5">
                                <span class="font-bold text-slate-600">
                                    <i class="fa-solid fa-chalkboard-user text-slate-400 mr-2"></i> 
                                    {{ $schoolClass->teacher ? $schoolClass->teacher->name : 'Not Assigned' }}
                                </span>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex justify-center gap-3">
                                    <a href="{{ route('classes.edit', $schoolClass->class_id) }}" class="text-blue-600 hover:text-white bg-blue-50 hover:bg-blue-600 p-2.5 rounded-xl transition-all"><i class="fa-solid fa-pen-to-square w-4"></i></a>
                                    <form action="{{ route('classes.destroy', $schoolClass->class_id) }}" method="POST" onsubmit="return confirm('Delete this class?');" class="inline-block">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-white bg-red-50 hover:bg-red-500 p-2.5 rounded-xl transition-all"><i class="fa-solid fa-trash w-4"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="p-10 text-center text-slate-500 font-medium">No classes found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>
</html>