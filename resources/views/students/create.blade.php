<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Student - School MS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 font-sans antialiased">
    <div class="min-h-screen flex">
        
        @include('layouts.sidebar')

        <div class="flex-1 p-10 overflow-y-auto bg-slate-50">
            
            <div class="flex justify-between items-center mb-10">
                <div class="flex items-center gap-4">
                    <div class="bg-emerald-100 p-3 rounded-2xl text-emerald-600">
                        <i class="fa-solid fa-user-graduate text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-extrabold text-slate-800">Add New Student</h2>
                        <p class="text-slate-500 mt-1 text-sm font-medium">Enter student details and enroll them to the system</p>
                    </div>
                </div>
                <a href="{{ route('students.index') }}" class="bg-white border border-slate-200 text-slate-700 hover:bg-slate-100 font-bold py-2.5 px-5 rounded-xl shadow-sm transition-all duration-300 flex items-center text-sm">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Back to List
                </a>
            </div>

            <div class="bg-white rounded-3xl shadow-lg border border-slate-100 overflow-hidden relative">
                
                <div class="h-2 w-full bg-gradient-to-r from-emerald-500 to-teal-600 absolute top-0 left-0"></div>
                
                <form action="{{ route('students.store') }}" method="POST" class="p-10">
                    @csrf
                    
                    <div class="flex items-center gap-3 mb-8">
                        <div class="bg-blue-50 text-blue-600 p-2 rounded-lg">
                            <i class="fa-regular fa-address-card"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800">Personal Information</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 mb-12">
                        
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Full Name <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i class="fa-regular fa-user absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                                <input type="text" name="name" required class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 bg-slate-50 focus:bg-white text-sm font-medium transition-all" placeholder="e.g. A.B.C. Perera">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Date of Birth <span class="text-red-500">*</span></label>
                            <input type="date" name="dob" required class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 bg-slate-50 focus:bg-white text-sm font-medium transition-all text-slate-500">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Contact Number <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i class="fa-solid fa-mobile-screen absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                                <input type="text" name="contact" required class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 bg-slate-50 focus:bg-white text-sm font-medium transition-all" placeholder="07X XXX XXXX">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Address <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i class="fa-solid fa-location-dot absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                                <input type="text" name="address" required class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 bg-slate-50 focus:bg-white text-sm font-medium transition-all" placeholder="Home address">
                            </div>
                        </div>
                    </div>

                    <hr class="border-slate-100 mb-8">

                    <div class="flex items-center gap-3 mb-8">
                        <div class="bg-purple-50 text-purple-600 p-2 rounded-lg">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800">Academic & Account Relations</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                        
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Email Address <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i class="fa-regular fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                                <input type="email" name="email" required class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 bg-slate-50 focus:bg-white text-sm font-medium transition-all" placeholder="student@example.com">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Assign Class <span class="text-red-500">*</span></label>
                            <select name="class_id" required class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 bg-slate-50 focus:bg-white text-sm font-medium transition-all text-slate-600 appearance-none">
                                <option value="" disabled selected>Select Class</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->class_id }}">Class ID: {{ $class->class_id }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Select Parent <span class="text-red-500">*</span></label>
                            <select name="parent_id" required class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 bg-slate-50 focus:bg-white text-sm font-medium transition-all text-slate-600 appearance-none">
                                <option value="" disabled selected>Select Parent</option>
                                @foreach($parents as $parent)
                                    <option value="{{ $parent->parent_id }}">Parent ID: {{ $parent->parent_id }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="flex items-center justify-end gap-4 mt-12">
                        <button type="reset" class="text-slate-500 font-bold text-sm px-6 py-3 hover:text-slate-800 transition-colors flex items-center">
                            <i class="fa-solid fa-rotate-right mr-2"></i> Reset Form
                        </button>
                        <button type="submit" class="bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg shadow-emerald-500/30 transition-all duration-300 flex items-center">
                            <i class="fa-solid fa-floppy-disk mr-2"></i> Save Student Record
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</body>
</html>