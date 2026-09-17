<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Teacher | School MS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 font-sans antialiased">

    <div class="min-h-screen flex">
        
        @include('layouts.sidebar')

        <div class="flex-1 p-10 overflow-y-auto bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] bg-fixed">
            
            <div class="flex justify-between items-center mb-10">
                <div class="flex items-center">
                    <div class="bg-white p-3 rounded-2xl shadow-sm border border-slate-200 mr-4 flex items-center justify-center">
                        <i class="fa-solid fa-chalkboard-user text-2xl text-blue-600 bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Add New Teacher</h2>
                        <p class="text-slate-500 mt-1 text-sm font-medium">Create a new staff profile in the system</p>
                    </div>
                </div>
                
                <a href="{{ route('teachers.index') }}" class="bg-white border border-slate-200 text-slate-700 hover:bg-slate-100 hover:text-blue-700 font-bold py-2.5 px-6 rounded-xl shadow-sm transition-all duration-300 flex items-center transform hover:-translate-x-1">
                    <i class="fa-solid fa-arrow-left-long mr-2"></i> Back to List
                </a>
            </div>

            <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 max-w-4xl relative overflow-hidden">
                
                <div class="h-2.5 w-full bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500"></div>

                <div class="p-8 sm:p-12">
                    <form action="{{ route('teachers.store') }}" method="POST">
                        @csrf
                        
                        <div class="flex items-center mb-8 border-b border-slate-100 pb-5">
                            <div class="bg-blue-50 p-2.5 rounded-xl mr-4 border border-blue-100">
                                <i class="fa-regular fa-id-badge text-blue-600 text-xl"></i>
                            </div>
                            <h3 class="text-xl font-extrabold text-slate-800 tracking-tight">
                                Personal Information
                            </h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-7 mb-10">
                            
                            <div class="col-span-1 md:col-span-2">
                                <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Full Name <span class="text-red-500">*</span></label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-blue-600 text-slate-400">
                                        <i class="fa-regular fa-user"></i>
                                    </div>
                                    <input type="text" id="name" name="name" required placeholder="e.g. A.B.C. Perera" 
                                           class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 bg-slate-50 hover:bg-slate-100/50 focus:bg-white text-slate-800 transition-all text-sm font-medium">
                                </div>
                            </div>

                            <div>
                                <label for="contact" class="block text-sm font-bold text-slate-700 mb-2">Contact Number <span class="text-red-500">*</span></label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-blue-600 text-slate-400">
                                        <i class="fa-solid fa-mobile-screen-button"></i>
                                    </div>
                                    <input type="text" id="contact" name="contact" required placeholder="07X XXX XXXX" 
                                           class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 bg-slate-50 hover:bg-slate-100/50 focus:bg-white text-slate-800 transition-all text-sm font-medium">
                                </div>
                            </div>

                            <div>
                                <label for="subject" class="block text-sm font-bold text-slate-700 mb-2">Teaching Subject <span class="text-red-500">*</span></label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-blue-600 text-slate-400">
                                        <i class="fa-solid fa-book-bookmark"></i>
                                    </div>
                                    <select id="subject" name="subject" required 
                                            class="w-full pl-11 pr-10 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 bg-slate-50 hover:bg-slate-100/50 focus:bg-white text-slate-800 transition-all text-sm font-medium appearance-none cursor-pointer">
                                        <option value="" disabled selected>Select a subject</option>
                                        
                                        @foreach($subjects as $subject)
                                            <option value="{{ $subject->subject_name }}">{{ $subject->subject_name }}</option>
                                        @endforeach

                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400">
                                        <i class="fa-solid fa-angle-down text-sm"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-5">
                            <button type="reset" class="px-6 py-3.5 rounded-xl text-slate-500 hover:bg-slate-100 hover:text-slate-800 font-bold transition-colors text-sm flex items-center">
                                <i class="fa-solid fa-rotate-left mr-2"></i> Reset Form
                            </button>
                            <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg shadow-blue-500/30 transition-all transform hover:-translate-y-1 flex items-center">
                                <i class="fa-solid fa-floppy-disk mr-2"></i> Save Teacher Data
                            </button>
                        </div>

                    </form>
                </div>
                
            </div>
        </div>
    </div>

</body>
</html>