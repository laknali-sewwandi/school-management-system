<style>
    /* තුනී, ලස්සන Custom Scrollbar එකක් හදන CSS කෝඩ් එක */
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px; /* ගොඩක් තුනී කරනවා */
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #334155; /* Sidebar එකේ කළු පාටට ගැලපෙන අඳුරු පාටක් */
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #475569;
    }
</style>

<div class="w-64 bg-slate-900 text-slate-300 flex flex-col h-screen sticky top-0 shadow-xl">
    <div class="p-6 flex flex-col items-center border-b border-slate-800">
        <div class="h-16 w-16 bg-gradient-to-tr from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center text-white text-2xl shadow-lg mb-3">
            <i class="fa-solid fa-graduation-cap"></i>
        </div>
        <h1 class="text-xl font-black text-white tracking-wider">School MS</h1>
        <p class="text-xs text-slate-500 font-semibold mt-0.5">Management System</p>
    </div>

    <div class="flex-1 px-4 py-6 space-y-7 overflow-y-auto custom-scrollbar">
        
        <div>
            <p class="px-3 text-xs font-extrabold text-slate-500 uppercase tracking-widest mb-3">Core</p>
            <a href="/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm transition-all <?php echo e(request()->is('dashboard') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200'); ?>">
                <i class="fa-solid fa-chart-pie text-lg"></i> Dashboard
            </a>
        </div>

        <div>
            <p class="px-3 text-xs font-extrabold text-slate-500 uppercase tracking-widest mb-3">Academic</p>
            <div class="space-y-1">
                <a href="<?php echo e(route('classes.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm transition-all <?php echo e(request()->routeIs('classes.*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200'); ?>">
                    <i class="fa-solid fa-school text-lg"></i> Classes
                </a>
                <a href="/subjects" class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm transition-all <?php echo e(request()->is('subjects*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200'); ?>">
                    <i class="fa-solid fa-book text-lg"></i> Subjects
                </a>
            </div>
        </div>

        <div>
            <p class="px-3 text-xs font-extrabold text-slate-500 uppercase tracking-widest mb-3">People</p>
            <div class="space-y-1">
                <a href="/teachers" class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm transition-all <?php echo e(request()->is('teachers*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200'); ?>">
                    <i class="fa-solid fa-chalkboard-user text-lg"></i> Teachers
                </a>
                <a href="/students" class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm transition-all <?php echo e(request()->is('students*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200'); ?>">
                    <i class="fa-solid fa-user-graduate text-lg"></i> Students
                </a>
                <a href="/parents" class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm transition-all <?php echo e(request()->is('parents*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200'); ?>">
                    <i class="fa-solid fa-user-group text-lg"></i> Parents
                </a>
            </div>
        </div>

        <div>
            <p class="px-3 text-xs font-extrabold text-slate-500 uppercase tracking-widest mb-3">Performance</p>
            <div class="space-y-1">
                <a href="<?php echo e(route('attendances.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm transition-all <?php echo e(request()->routeIs('attendances.*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200'); ?>">
                    <i class="fa-solid fa-calendar-check text-lg"></i> Attendance
                </a>
                <a href="/marks" class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm transition-all <?php echo e(request()->is('marks*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200'); ?>">
                    <i class="fa-solid fa-square-poll-vertical text-lg"></i> Exam Marks
                </a>
            </div>
        </div>

    </div>

    <div class="p-4 border-t border-slate-800 bg-slate-950/40 space-y-1">
        <a href="/profile" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-bold text-sm text-slate-400 hover:bg-slate-800 hover:text-slate-200 transition-all">
            <i class="fa-solid fa-user-gear"></i> Profile Settings
        </a>
       
        <form action="<?php echo e(route('logout')); ?>" method="POST" class="w-full">
            <?php echo csrf_field(); ?>
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl font-bold text-sm text-rose-400 hover:bg-rose-950/30 hover:text-rose-300 transition-all text-left">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
            </button>
        </form>
    </div>
</div><?php /**PATH C:\xampp\htdocs\school_management_system\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>