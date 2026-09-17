<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Class - School MS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 font-sans antialiased">
    <div class="min-h-screen flex">
        
        @include('layouts.sidebar')

        <div class="flex-1 p-10 overflow-y-auto bg-slate-50">
            
            <div class="flex justify-between items-center mb-10">
                <div class="flex items-center gap-4">
                    <div class="bg-violet-100 p-3 rounded-2xl text-violet-600 shadow-sm">
                        <i class="fa-solid fa-chalkboard text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-extrabold text-slate-800">Add New Class</h2>
                        <p class="text-slate-500 mt-1 text-sm font-medium">Create a new class and assign a teacher</p>
                    </div>
                </div>
                <a href="{{ route('classes.index') }}" class="bg-white border border-slate-200 text-slate-700 hover:bg-slate-100 font-bold py-2.5 px-5 rounded-xl shadow-sm transition-all duration-300 flex items-center text-sm">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Back to List
                </a>
            </div>

            <div class="bg-white rounded-3xl shadow-lg border border-slate-100 overflow-hidden relative max-w-4xl">
                
                <div class="h-2 w-full bg-gradient-to-r from-violet-600 to-fuchsia-600 absolute top-0 left-0"></div>
                
                <form action="{{ route('classes.store') }}" method="POST" class="p-10">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Class Name <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i class="fa-solid fa-layer-group absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                                <input type="text" name="class_name" required placeholder="e.g. Grade 10" class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 bg-slate-50 focus:bg-white text-sm font-medium transition-all text-slate-700">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Section <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i class="fa-solid fa-shapes absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                                <input type="text" name="section" required placeholder="e.g. A, B, Science, Arts" class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 bg-slate-50 focus:bg-white text-sm font-medium transition-all text-slate-700">
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-slate-700 mb-2">Class Teacher (Optional)</label>
                            <div class="relative">
                                <i class="fa-solid fa-chalkboard-user absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                                <select name="teacher_id" class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 bg-slate-50 focus:bg-white text-sm font-medium transition-all text-slate-700 appearance-none">
                                    <option value="">-- Select a Teacher --</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->teacher_id }}">{{ $teacher->name }} (ID: {{ $teacher->teacher_id }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="flex items-center justify-end gap-4 mt-8 pt-8 border-t border-slate-50">
                        <button type="reset" class="text-slate-500 hover:text-slate-800 font-bold text-sm px-6 py-3.5 rounded-xl hover:bg-slate-100 transition-all flex items-center">
                            <i class="fa-solid fa-rotate-left mr-2"></i> Reset Form
                        </button>
                        <button type="submit" class="bg-gradient-to-r from-violet-600 to-fuchsia-600 hover:from-violet-700 hover:to-fuchsia-700 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg shadow-violet-500/30 transition-all duration-300 flex items-center">
                            <i class="fa-solid fa-check mr-2"></i> Save Class
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</body>
</html>