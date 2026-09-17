<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subjects - School MS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 font-sans antialiased">
    <div class="min-h-screen flex">
        @include('layouts.sidebar')

        <div class="flex-1 p-10 bg-slate-50">
            <div class="flex justify-between items-center mb-10">
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-800">Subjects</h2>
                    <p class="text-slate-500 mt-1 text-sm font-medium">Manage academic subjects and teachers</p>
                </div>
                <a href="{{ route('subjects.create') }}" class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg transition-all"><i class="fa-solid fa-plus mr-2"></i> Add Subject</a>
            </div>

            <form action="{{ route('subjects.index') }}" method="GET" class="mb-8 bg-white p-3 pr-4 rounded-2xl shadow-md border border-slate-100 flex gap-3 items-center">
                <div class="relative flex-1 group">
                    <i class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search subjects..." class="w-full pl-12 pr-4 py-3.5 rounded-xl bg-transparent outline-none text-sm font-medium text-slate-800 focus:bg-slate-50 transition-all">
                </div>
                <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white px-8 py-3 rounded-xl text-sm font-bold transition">Search</button>
                @if(isset($search) && $search != '')
                    <a href="{{ route('subjects.index') }}" class="bg-red-50 text-red-600 px-6 py-3 rounded-xl font-bold text-sm flex items-center hover:bg-red-100"><i class="fa-solid fa-xmark mr-2"></i> Clear</a>
                @endif
            </form>

            <div class="bg-white rounded-3xl shadow-lg border border-slate-100 overflow-hidden">
                <table class="min-w-full text-left">
                    
         <thead class="bg-slate-50 border-b border-slate-100">
        <tr>
            <th class="px-8 py-5 text-slate-500 uppercase text-xs font-extrabold">ID</th>
            <th class="px-8 py-5 text-slate-500 uppercase text-xs font-extrabold">Subject Name</th>
            <th class="px-8 py-5 text-slate-500 uppercase text-xs font-extrabold">Assigned Teacher</th>
            <th class="px-8 py-5 text-slate-500 uppercase text-xs font-extrabold text-center">Actions</th>
        </tr>
    </thead>
    <tbody class="text-slate-700 text-sm divide-y divide-slate-50">
        @forelse($subjects as $subject)
        <tr class="hover:bg-pink-50/40 transition">
            <td class="px-8 py-5 font-bold text-slate-500">{{ $subject->subject_id }}</td>
            <td class="px-8 py-5 font-extrabold text-slate-800">{{ $subject->subject_name }}</td>
            <td class="px-8 py-5 font-medium text-slate-600">
                <i class="fa-solid fa-chalkboard-user text-slate-400 mr-2"></i>
                {{ $subject->teacher ? $subject->teacher->name : 'No Teacher Assigned' }}
            </td>
            <td class="px-8 py-5 text-center">
                <div class="flex justify-center gap-3">
                    <!-- Edit Button -->
                    <a href="{{ route('subjects.edit', $subject->subject_id) }}" class="text-blue-600 hover:text-white bg-blue-50 hover:bg-blue-600 p-2.5 rounded-xl transition-all">
                        <i class="fa-solid fa-pen-to-square w-4"></i>
                    </a>
                    <!-- Delete Button -->
                    <form action="{{ route('subjects.destroy', $subject->subject_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this subject?');" class="inline-block">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-white bg-red-50 hover:bg-red-500 p-2.5 rounded-xl transition-all">
                            <i class="fa-solid fa-trash w-4"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr><td colspan="4" class="p-10 text-center text-slate-500 font-medium">No subjects found.</td></tr>
        @endforelse
    </tbody>
</table>
                </table>
            </div>
        </div>
    </div>
</body>
</html>