<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Parent - School MS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 font-sans antialiased">
    <div class="min-h-screen flex">
        
        <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="flex-1 p-10 overflow-y-auto bg-gradient-to-br from-slate-50 to-amber-50/30">
            <div class="max-w-3xl mx-auto">
                
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h2 class="text-3xl font-extrabold text-slate-800">Edit Parent Details</h2>
                        <p class="text-slate-500 mt-1 text-sm font-medium">Update existing parent information</p>
                    </div>
                    <a href="<?php echo e(route('parents.index')); ?>" class="bg-white border border-slate-200 text-slate-700 hover:bg-slate-100 font-bold py-2.5 px-5 rounded-xl shadow-sm transition-all flex items-center text-sm">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Back to List
                    </a>
                </div>

                <div class="bg-white rounded-3xl shadow-lg border border-slate-100 p-8">
                    <form action="<?php echo e(route('parents.update', $parent->parent_id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Full Name</label>
                                <div class="relative">
                                    <i class="fa-solid fa-user absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                                    <input type="text" name="name" value="<?php echo e($parent->name); ?>" required 
                                           class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Contact Number</label>
                                <div class="relative">
                                    <i class="fa-solid fa-phone absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                                    <input type="text" name="contact" value="<?php echo e($parent->contact); ?>" required 
                                           class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Email Address</label>
                                <div class="relative">
                                    <i class="fa-solid fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                                    <input type="email" name="email" value="<?php echo e($parent->email); ?>" placeholder="e.g. parent@gmail.com" 
                                           class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Home Address</label>
                                <div class="relative">
                                    <i class="fa-solid fa-location-dot absolute left-4 top-4 text-slate-400"></i>
                                    <textarea name="address" rows="3" 
                                              class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"><?php echo e($parent->address); ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t border-slate-100 flex justify-end gap-4">
                            <button type="reset" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-3 px-6 rounded-xl transition-all flex items-center">
                                <i class="fa-solid fa-rotate-left mr-2"></i> Reset
                            </button>
                            <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 px-8 rounded-xl shadow-lg transition-all transform hover:-translate-y-1 flex items-center">
                                <i class="fa-solid fa-arrows-rotate mr-2"></i> Update Parent
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\school_management_system\resources\views/parents/edit.blade.php ENDPATH**/ ?>