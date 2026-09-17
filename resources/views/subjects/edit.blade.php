<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Subject - School MS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 font-sans antialiased">
    <div class="min-h-screen flex">
        @include('layouts.sidebar')

        <div class="flex-1 p-10 bg-slate-50">
            <div class="bg-white rounded-3xl shadow-lg border border-slate-100 overflow-hidden relative max-w-2xl mx-auto mt-10">
                <div class="h-2 w-full bg-pink-600 absolute top-0 left-0"></div>
                <form action="{{ route('subjects.update', $subject->subject_id) }}" method="POST" class="p-10">
                    @csrf
                    @method('PUT')
                    
                    <h2 class="text-2xl font-extrabold text-slate-800 mb-6"><i class="fa-solid fa-pen-to-square text-pink-600 mr-2"></i> Edit Subject</h2>
                    
                    <div class="space-y-6 mb-8">
                        <!-- Subject Name -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Subject Name <span class="text-red-500">*</span></label>
                            <input type="text" name="subject_name" value="{{ $subject->subject_name }}" required class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-pink-500 bg-slate-50 focus:bg-white text-sm font-medium">
                        </div>

                        <!-- Select Teacher -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Assign Teacher <span class="text-red-500">*</span></label>
                            <select name="teacher_id" required class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-pink-500 bg-slate-50 focus:bg-white text-sm font-medium text-slate-700">
                                <option value="" disabled>-- Select a Teacher --</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->teacher_id }}" {{ $subject->teacher_id == $teacher->teacher_id ? 'selected' : '' }}>
                                        {{ $teacher->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end gap-4">
                        <a href="{{ route('subjects.index') }}" class="text-slate-500 hover:text-slate-800 font-bold px-6 py-3.5 rounded-xl hover:bg-slate-100">Cancel</a>
                        <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg">Update Subject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>