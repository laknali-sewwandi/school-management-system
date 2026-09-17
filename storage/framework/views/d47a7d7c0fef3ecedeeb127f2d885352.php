<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parents Management - School MS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 font-sans antialiased">
    <div class="min-h-screen flex">
        
        <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="flex-1 p-10 overflow-y-auto bg-gradient-to-br from-slate-50 to-indigo-50/50">
            
            <?php if(session('success')): ?>
            <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-r-xl shadow-sm mb-6 flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fa-solid fa-circle-check text-xl mr-3"></i>
                    <p class="font-bold text-sm"><?php echo e(session('success')); ?></p>
                </div>
            </div>
            <?php endif; ?>

            <div class="flex justify-between items-center mb-10">
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-800">Parents Management</h2>
                    <p class="text-slate-500 mt-1 text-sm font-medium">Manage and view parent or guardian details</p>
                </div>
                <a href="<?php echo e(route('parents.create')); ?>" class="bg-gradient-to-r from-indigo-500 to-blue-600 hover:from-indigo-600 hover:to-blue-700 text-white font-bold py-3.5 px-6 rounded-xl shadow-lg transition-all duration-300 flex items-center transform hover:-translate-y-1 w-fit">
                    <i class="fa-solid fa-user-plus mr-2"></i> Add New Parent
                </a>
            </div>

            <form action="<?php echo e(route('parents.index')); ?>" method="GET" class="mb-8 bg-white p-3 pr-4 rounded-2xl shadow-md border border-slate-100 flex gap-3 items-center">
                <div class="relative flex-1 group">
                    <i class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 transform -translate-y-1/2 text-slate-400 group-focus-within:text-indigo-500 transition-colors"></i>
                    <input type="text" name="search" value="<?php echo e($search ?? ''); ?>" placeholder="Search parents by name or contact number..." 
                           class="w-full pl-12 pr-4 py-3.5 rounded-xl bg-transparent outline-none text-sm font-medium text-slate-800">
                </div>
                
                <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white px-8 py-3.5 rounded-xl text-sm font-bold transition-colors shadow-sm">
                    <i class="fa-solid fa-filter mr-2"></i> Search
                </button>

                <?php if($search): ?>
                <a href="<?php echo e(route('parents.index')); ?>" class="bg-rose-50 hover:bg-rose-100 text-rose-600 px-6 py-3.5 rounded-xl text-sm font-bold transition-colors shadow-sm flex items-center">
                    <i class="fa-solid fa-xmark mr-2"></i> Clear
                </a>
                <?php endif; ?>
            </form>

            <div class="bg-white rounded-3xl shadow-lg border border-slate-100 overflow-hidden">
                <table class="min-w-full text-left border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-8 py-5 text-slate-400 uppercase text-xs font-extrabold tracking-wider w-20">ID</th>
                            <th class="px-8 py-5 text-slate-400 uppercase text-xs font-extrabold tracking-wider">Parent Info</th>
                            <th class="px-8 py-5 text-slate-400 uppercase text-xs font-extrabold tracking-wider">Contact Info</th>
                            <th class="px-8 py-5 text-slate-400 uppercase text-xs font-extrabold tracking-wider">Address</th>
                            <th class="px-8 py-5 text-slate-400 uppercase text-xs font-extrabold tracking-wider text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-slate-700 text-sm divide-y divide-slate-50">
                        <?php $__empty_1 = true; $__currentLoopData = $parents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-indigo-50/40 transition-colors duration-200">
                            <td class="px-8 py-5 font-bold text-slate-400"><?php echo e($parent->parent_id); ?></td>
                            <td class="px-8 py-5">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-100 to-blue-50 text-indigo-700 flex items-center justify-center font-extrabold mr-4 border border-indigo-200 shadow-sm">
                                        <?php echo e(strtoupper(substr($parent->name, 0, 1))); ?>

                                    </div>
                                    <span class="font-extrabold text-slate-800 text-base"><?php echo e($parent->name); ?></span>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="font-semibold text-slate-600 mb-1 flex items-center">
                                    <i class="fa-solid fa-phone text-xs text-slate-400 mr-2"></i> <?php echo e($parent->contact); ?>

                                </div>
                                <div class="text-xs text-slate-500 font-medium flex items-center">
                                    <i class="fa-solid fa-envelope text-xs text-slate-400 mr-2"></i> 
                                    <?php echo e($parent->email ? $parent->email : 'No email added'); ?>

                                </div>
                            </td>
                            <td class="px-8 py-5 text-slate-500 font-medium"><?php echo e($parent->address ?? 'N/A'); ?></td>

                            <td class="px-8 py-5">
                                <div class="flex items-center justify-center gap-3">
                                    <a href="<?php echo e(route('parents.show', $parent->parent_id)); ?>" class="text-white bg-gradient-to-r from-indigo-500 to-blue-600 hover:from-indigo-600 hover:to-blue-700 px-4 py-2.5 rounded-xl transition-all font-bold text-xs flex items-center shadow-md transform hover:-translate-y-0.5" title="View Dashboard">
                                        <i class="fa-solid fa-chart-pie mr-2"></i> Analytics
                                    </a>

                                    <a href="<?php echo e(route('parents.edit', $parent->parent_id)); ?>" class="text-amber-600 hover:text-white bg-amber-50 hover:bg-amber-500 px-3 py-2.5 rounded-xl transition-all font-bold text-sm flex items-center" title="Edit Parent">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <form action="<?php echo e(route('parents.destroy', $parent->parent_id)); ?>" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this parent?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-rose-600 hover:text-white bg-rose-50 hover:bg-rose-500 px-3 py-2.5 rounded-xl transition-all font-bold text-sm flex items-center" title="Delete Parent">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="p-16 text-center">
                                <div class="flex flex-col items-center justify-center text-slate-400">
                                    <i class="fa-solid fa-users-slash text-4xl mb-3"></i>
                                    <p class="text-lg font-bold">No parents found in the system.</p>
                                    <p class="text-sm font-medium mt-1">Try adding a new parent or adjusting your search.</p>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\school_management_system\resources\views/parents/index.blade.php ENDPATH**/ ?>