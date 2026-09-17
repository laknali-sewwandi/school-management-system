<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teachers Management - School MS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 font-sans antialiased">
    <div class="min-h-screen flex">
        
        <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="flex-1 p-10 overflow-y-auto bg-slate-50">
            
            <!-- Alert Messages (Success/Error) -->
            <?php if(session('success')): ?>
            <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-r-xl shadow-sm mb-6 flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fa-solid fa-circle-check text-xl mr-3"></i>
                    <p class="font-bold text-sm"><?php echo e(session('success')); ?></p>
                </div>
            </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
            <div class="bg-rose-50 border-l-4 border-rose-500 text-rose-700 p-4 rounded-r-xl shadow-sm mb-6 flex items-center">
                <i class="fa-solid fa-circle-exclamation text-xl mr-3"></i>
                <p class="font-bold text-sm"><?php echo e(session('error')); ?></p>
            </div>
            <?php endif; ?>

            <div class="flex justify-between items-center mb-10">
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-800">Teachers Management</h2>
                    <p class="text-slate-500 mt-1 text-sm font-medium">Manage and organize your teaching staff</p>
                </div>
                <a href="<?php echo e(route('teachers.create')); ?>" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3.5 px-6 rounded-xl shadow-lg transition-all duration-300 flex items-center">
                    <i class="fa-solid fa-user-plus mr-2"></i> Add New Teacher
                </a>
            </div>

            <form action="<?php echo e(route('teachers.index')); ?>" method="GET" class="mb-8 bg-white p-3 pr-4 rounded-2xl shadow-md border border-slate-100 flex gap-3 items-center">
                <div class="relative flex-1 group">
                    <i class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                    <input type="text" name="search" value="<?php echo e($search ?? ''); ?>" placeholder="Search teachers..." 
                           class="w-full pl-12 pr-4 py-3.5 rounded-xl bg-transparent outline-none text-sm font-medium text-slate-800">
                </div>
                <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white px-8 py-3 rounded-xl text-sm font-bold transition">
                    <i class="fa-solid fa-filter mr-2"></i> Search
                </button>
                <?php if(isset($search) && $search != ''): ?>
                    <a href="<?php echo e(route('teachers.index')); ?>" class="bg-red-50 text-red-600 px-6 py-3 rounded-xl font-bold text-sm">
                        <i class="fa-solid fa-xmark mr-2"></i> Clear
                    </a>
                <?php endif; ?>
            </form>

            <div class="bg-white rounded-3xl shadow-lg border border-slate-100 overflow-hidden">
                <table class="min-w-full text-left border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-8 py-5 text-slate-500 uppercase text-xs font-extrabold">ID</th>
                            <th class="px-8 py-5 text-slate-500 uppercase text-xs font-extrabold">Teacher Info</th>
                            <th class="px-8 py-5 text-slate-500 uppercase text-xs font-extrabold">Contact</th>
                            <th class="px-8 py-5 text-slate-500 uppercase text-xs font-extrabold">Subject</th>
                            <th class="px-8 py-5 text-slate-500 uppercase text-xs font-extrabold text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-slate-700 text-sm divide-y divide-slate-50">
                        <?php $__empty_1 = true; $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-blue-50/40 transition">
                            <td class="px-8 py-5 font-bold text-slate-500"><?php echo e($teacher->teacher_id); ?></td>
                            <td class="px-8 py-5">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-extrabold mr-4"><?php echo e(strtoupper(substr($teacher->name, 0, 1))); ?></div>
                                    <span class="font-extrabold text-slate-800"><?php echo e($teacher->name); ?></span>
                                </div>
                            </td>
                            <td class="px-8 py-5"><?php echo e($teacher->contact); ?></td>
                            <td class="px-8 py-5">
                                <span class="bg-indigo-50 text-indigo-700 text-xs font-extrabold px-4 py-2 rounded-xl border border-indigo-100"><?php echo e($teacher->subject); ?></span>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex justify-center gap-3">
                                    <a href="<?php echo e(route('teachers.edit', $teacher->teacher_id)); ?>" class="text-blue-600 hover:bg-blue-600 hover:text-white bg-blue-50 p-2.5 rounded-xl transition-all">
                                        <i class="fa-solid fa-pen-to-square w-4"></i>
                                    </a>
                                    <form action="<?php echo e(route('teachers.destroy', $teacher->teacher_id)); ?>" method="POST" onsubmit="return confirm('Delete this teacher?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-red-500 hover:bg-red-500 hover:text-white bg-red-50 p-2.5 rounded-xl transition-all">
                                            <i class="fa-solid fa-trash w-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="5" class="p-10 text-center">No teachers found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\school_management_system\resources\views/teachers/index.blade.php ENDPATH**/ ?>