<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student - School MS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 font-sans antialiased">
    <div class="min-h-screen flex">
        
        <!-- Sidebar -->
        <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Main Content -->
        <div class="flex-1 p-10 overflow-y-auto bg-slate-50">
            
            <!-- Header Section -->
            <div class="flex justify-between items-center mb-10">
                <div class="flex items-center gap-4">
                    <div class="bg-blue-100 p-3 rounded-2xl text-blue-600">
                        <i class="fa-solid fa-pen-to-square text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-extrabold text-slate-800">Edit Student Record</h2>
                        <p class="text-slate-500 mt-1 text-sm font-medium">Update details for <span class="font-bold text-blue-600"><?php echo e($student->name); ?></span></p>
                    </div>
                </div>
                <a href="<?php echo e(route('students.index')); ?>" class="bg-white border border-slate-200 text-slate-700 hover:bg-slate-100 font-bold py-2.5 px-5 rounded-xl shadow-sm transition-all duration-300 flex items-center text-sm">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Back to List
                </a>
            </div>

            <!-- Form Container -->
            <div class="bg-white rounded-3xl shadow-lg border border-slate-100 overflow-hidden relative">
                
                <!-- Top Color Bar (Blue Theme for Edit) -->
                <div class="h-2 w-full bg-gradient-to-r from-blue-500 to-indigo-600 absolute top-0 left-0"></div>
                
                <form action="<?php echo e(route('students.update', $student->student_id)); ?>" method="POST" class="p-10">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?> <!-- Update කිරීම සඳහා මෙය අනිවාර්යයි -->
                    
                    <div class="flex items-center gap-3 mb-8">
                        <div class="bg-blue-50 text-blue-600 p-2 rounded-lg">
                            <i class="fa-regular fa-address-card"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800">Personal Information</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 mb-12">
                        
                        <!-- Name Field -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Full Name <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i class="fa-regular fa-user absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                                <input type="text" name="name" value="<?php echo e($student->name); ?>" required class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 bg-slate-50 focus:bg-white text-sm font-medium transition-all">
                            </div>
                        </div>

                        <!-- Date of Birth Field -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Date of Birth <span class="text-red-500">*</span></label>
                            <input type="date" name="dob" value="<?php echo e($student->dob); ?>" required class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 bg-slate-50 focus:bg-white text-sm font-medium transition-all text-slate-700">
                        </div>

                        <!-- Contact Field -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Contact Number <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i class="fa-solid fa-mobile-screen absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                                <input type="text" name="contact" value="<?php echo e($student->contact); ?>" required class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 bg-slate-50 focus:bg-white text-sm font-medium transition-all">
                            </div>
                        </div>

                        <!-- Address Field -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Address <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i class="fa-solid fa-location-dot absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                                <input type="text" name="address" value="<?php echo e($student->address); ?>" required class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 bg-slate-50 focus:bg-white text-sm font-medium transition-all">
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
                        
                        <!-- User ID -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">System User Account <span class="text-red-500">*</span></label>
                            <select name="user_id" required class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 bg-slate-50 focus:bg-white text-sm font-medium transition-all text-slate-700 appearance-none">
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->user_id); ?>" <?php echo e($student->user_id == $user->user_id ? 'selected' : ''); ?>>User ID: <?php echo e($user->user_id); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <!-- Class ID -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Assign Class <span class="text-red-500">*</span></label>
                            <select name="class_id" required class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 bg-slate-50 focus:bg-white text-sm font-medium transition-all text-slate-700 appearance-none">
                                <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($class->class_id); ?>" <?php echo e($student->class_id == $class->class_id ? 'selected' : ''); ?>>Class ID: <?php echo e($class->class_id); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <!-- Parent ID -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Select Parent <span class="text-red-500">*</span></label>
                            <select name="parent_id" required class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 bg-slate-50 focus:bg-white text-sm font-medium transition-all text-slate-700 appearance-none">
                                <?php $__currentLoopData = $parents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($parent->parent_id); ?>" <?php echo e($student->parent_id == $parent->parent_id ? 'selected' : ''); ?>>Parent ID: <?php echo e($parent->parent_id); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end mt-12">
                        <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg shadow-blue-500/30 transition-all duration-300 flex items-center">
                            <i class="fa-solid fa-cloud-arrow-up mr-2"></i> Update Record
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\school_management_system\resources\views/students/edit.blade.php ENDPATH**/ ?>