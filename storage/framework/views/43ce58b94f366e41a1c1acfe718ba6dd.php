<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Parent - School MS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 font-sans antialiased">
    <div class="min-h-screen flex">
        
        <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="flex-1 p-10 overflow-y-auto bg-slate-50">
            <div class="max-w-3xl mx-auto">
                
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h2 class="text-3xl font-extrabold text-slate-800">Add New Parent</h2>
                        <p class="text-slate-500 mt-1 text-sm font-medium">Register a new parent or guardian to the system</p>
                    </div>
                    <a href="<?php echo e(route('parents.index')); ?>" class="bg-white border border-slate-200 text-slate-700 hover:bg-slate-100 hover:text-indigo-600 font-bold py-2.5 px-5 rounded-xl shadow-sm transition-all flex items-center text-sm">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Back to List
                    </a>
                </div>

                <div class="bg-white rounded-3xl shadow-xl border border-slate-100 relative overflow-hidden">
                    <div class="h-2 w-full bg-gradient-to-r from-indigo-500 to-blue-500 absolute top-0 left-0"></div>
                    
                    <div class="p-8 md:p-10">
                        <form action="<?php echo e(route('parents.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-extrabold text-slate-700 mb-2 tracking-wide uppercase">Full Name <span class="text-rose-500">*</span></label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <i class="fa-solid fa-user text-slate-400 group-focus-within:text-indigo-500 transition-colors"></i>
                                        </div>
                                        <input type="text" name="name" required placeholder="e.g. Saman Kumara" 
                                               class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all font-medium text-slate-800 shadow-inner">
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-extrabold text-slate-700 mb-2 tracking-wide uppercase">Contact Number <span class="text-rose-500">*</span></label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <i class="fa-solid fa-phone text-slate-400 group-focus-within:text-indigo-500 transition-colors"></i>
                                        </div>
                                        <input type="text" name="contact" required placeholder="e.g. 0712345678" 
                                               class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all font-medium text-slate-800 shadow-inner">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-extrabold text-slate-700 mb-2 tracking-wide uppercase">Email Address</label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <i class="fa-solid fa-envelope text-slate-400 group-focus-within:text-indigo-500 transition-colors"></i>
                                        </div>
                                        <input type="email" name="email" placeholder="e.g. parent@gmail.com" 
                                               class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all font-medium text-slate-800 shadow-inner">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-extrabold text-slate-700 mb-2 tracking-wide uppercase">Home Address</label>
                                    <div class="relative group">
                                        <div class="absolute top-4 left-0 pl-4 flex items-center pointer-events-none">
                                            <i class="fa-solid fa-location-dot text-slate-400 group-focus-within:text-indigo-500 transition-colors"></i>
                                        </div>
                                        <textarea name="address" rows="3" placeholder="Enter full home address" 
                                                  class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all font-medium text-slate-800 shadow-inner"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-10 pt-6 border-t border-slate-100 flex justify-end gap-4">
                                <button type="reset" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-extrabold py-3.5 px-6 rounded-xl transition-all flex items-center text-sm tracking-wide">
                                    <i class="fa-solid fa-eraser mr-2 text-lg"></i> Clear Form
                                </button>
                                
                                <button type="submit" class="bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-extrabold py-3.5 px-8 rounded-xl shadow-lg transition-all transform hover:-translate-y-1 flex items-center text-sm tracking-wide">
                                    <i class="fa-solid fa-cloud-arrow-up mr-2 text-lg"></i> Save Parent Record
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\school_management_system\resources\views/parents/create.blade.php ENDPATH**/ ?>