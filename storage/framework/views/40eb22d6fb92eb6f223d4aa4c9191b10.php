<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Dashboard | School MS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-slate-50 font-sans antialiased">

    <div class="min-h-screen flex">
        
        <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="flex-1 p-10 overflow-y-auto bg-slate-50">
            <?php if(session('success')): ?>
        <div class="fixed top-8 right-8 z-[999] bg-emerald-500 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3 border-2 border-emerald-400">
            <i class="fa-solid fa-circle-check text-xl"></i>
            <span class="font-bold tracking-wide"><?php echo e(session('success')); ?></span>
        </div>
    <?php endif; ?>
           
            
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 mb-8 flex justify-between items-center">
                <div>
                    <!-- login user name -->
                    <h2 class="text-2xl font-black text-slate-800 tracking-tight">Welcome back, <span class="text-blue-600"><?php echo e(Auth::user()->name); ?>!</span></h2>
                    <p class="text-slate-500 mt-1 text-sm font-medium">Here is what's happening in your school today.</p>
                </div>
                <!--name first word show -->
                <div class="h-12 w-12 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 text-white flex items-center justify-center font-bold text-xl shadow-md border-2 border-white uppercase">
                    <?php echo e(substr(Auth::user()->name, 0, 1)); ?>

                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md transition-all">
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-blue-500 rounded-l-3xl"></div>
                    <div class="flex justify-between items-center mb-4">
                        <p class="text-xs font-extrabold text-slate-500 uppercase tracking-widest">Total Teachers</p>
                        <div class="bg-blue-50 p-2 rounded-lg text-blue-500 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-chalkboard-user"></i>
                        </div>
                    </div>
                    <h3 class="text-4xl font-black text-slate-800"><?php echo e($totalTeachers); ?></h3>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md transition-all">
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-emerald-500 rounded-l-3xl"></div>
                    <div class="flex justify-between items-center mb-4">
                        <p class="text-xs font-extrabold text-slate-500 uppercase tracking-widest">Total Students</p>
                        <div class="bg-emerald-50 p-2 rounded-lg text-emerald-500 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-user-graduate"></i>
                        </div>
                    </div>
                    <h3 class="text-4xl font-black text-slate-800"><?php echo e($totalStudents); ?></h3>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md transition-all">
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-amber-500 rounded-l-3xl"></div>
                    <div class="flex justify-between items-center mb-4">
                        <p class="text-xs font-extrabold text-slate-500 uppercase tracking-widest">Active Classes</p>
                        <div class="bg-amber-50 p-2 rounded-lg text-amber-500 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-school"></i>
                        </div>
                    </div>
                    <h3 class="text-4xl font-black text-slate-800"><?php echo e($totalClasses); ?></h3>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                
                <div class="lg:col-span-2 bg-white p-7 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-extrabold text-slate-800 flex items-center">
                            <i class="fa-solid fa-chart-line text-indigo-500 mr-3 text-xl"></i> Weekly Attendance Overview
                        </h3>
                        <span class="bg-indigo-50 text-indigo-700 text-xs font-bold px-3 py-1 rounded-full">This Week</span>
                    </div>
                    <div class="relative h-[300px] w-full">
                        <canvas id="attendanceChart"></canvas>
                    </div>
                </div>

                <div class="bg-white p-7 rounded-3xl shadow-sm border border-slate-100 flex flex-col">
                    <h3 class="text-lg font-extrabold text-slate-800 mb-6 flex items-center">
                        <i class="fa-solid fa-bell text-rose-500 mr-3 text-xl hover:animate-ping"></i> Important Alerts
                    </h3>
                    
                    <div class="space-y-4 flex-1 overflow-y-auto">
                        <?php $__empty_1 = true; $__currentLoopData = $lowAttendanceStudents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="bg-rose-50 border-l-4 border-rose-500 p-4 rounded-r-xl">
                            <div class="flex justify-between items-start mb-1">
                                <h4 class="text-sm font-bold text-rose-800">Low Attendance</h4>
                                <span class="text-[10px] font-bold text-rose-500 bg-rose-100 px-2 py-0.5 rounded">URGENT</span>
                            </div>
                            <p class="text-xs font-medium text-rose-600">
                                <?php echo e($student->name); ?>'s attendance requires attention (Currently at <span class="font-black"><?php echo e($student->attendance_percentage); ?>%</span>).
                            </p>

                            <a href="<?php echo e(route('dashboard.sendAlert', $student->student_id)); ?>" class="text-xs font-bold text-rose-700 mt-2 inline-block hover:underline">
    <i class="fa-solid fa-envelope text-[10px] mr-1"></i> Send Parent Alert
</a>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-xl">
                            <p class="text-xs font-medium text-emerald-600">No urgent alerts. All student attendances are looking good!</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

            <div class="bg-white p-7 rounded-3xl shadow-sm border border-slate-100">
                <h3 class="text-lg font-extrabold text-slate-800 mb-6 flex items-center">
                    <i class="fa-solid fa-bolt text-amber-400 mr-3 text-xl"></i> Recent Staff Additions
                </h3>
                
                <div class="space-y-6 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-200 before:to-transparent">
                    
                    <?php $__empty_1 = true; $__currentLoopData = $recentTeachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-blue-500 text-white shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10">
                            <i class="fa-solid fa-user-plus text-sm"></i>
                        </div>
                        <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-slate-50 p-4 rounded-2xl border border-slate-100 shadow-sm">
                            <div class="flex items-center justify-between mb-1">
                                <h4 class="font-bold text-sm text-slate-800">New Teacher Added</h4>
                                <span class="text-xs font-bold text-slate-400"><?php echo e($teacher->created_at->diffForHumans()); ?></span>
                            </div>
                            <p class="text-xs font-medium text-slate-500"><?php echo e($teacher->name); ?> was registered into the system (Subject: <?php echo e($teacher->subject); ?>).</p>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-center py-4 text-slate-500 text-sm font-medium">
                        No recent staff additions found.
                    </div>
                    <?php endif; ?>

                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('attendanceChart').getContext('2d');
            
            let gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(79, 70, 229, 0.4)'); 
            gradient.addColorStop(1, 'rgba(79, 70, 229, 0.0)'); 

            // Get dynamic chart data from Controller
            const dynamicChartData = <?php echo json_encode($chartData, 15, 512) ?>;

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
                    datasets: [{
                        label: ' Present Percentage (%)',
                        data: dynamicChartData, 
                        borderColor: '#4f46e5', 
                        borderWidth: 4,
                        backgroundColor: gradient, 
                        fill: true,
                        tension: 0.4, 
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#4f46e5',
                        pointBorderWidth: 3,
                        pointRadius: 6,
                        pointHoverRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(30, 41, 59, 0.9)',
                            padding: 12,
                            titleFont: { size: 13 },
                            bodyFont: { size: 14, weight: 'bold' },
                            displayColors: false,
                        }
                    },
                    scales: {
                        y: {
                            min: 50,
                            max: 100,
                            grid: { color: 'rgba(241, 245, 249, 1)', drawBorder: false },
                            ticks: { font: { weight: 'bold' }, color: '#94a3b8' }
                        },
                        x: {
                            grid: { display: false, drawBorder: false },
                            ticks: { font: { weight: 'bold' }, color: '#64748b' }
                        }
                    },
                    interaction: { intersect: false, mode: 'index' },
                    animation: {
                        duration: 2000,
                        easing: 'easeOutQuart'
                    }
                }
            });
        });
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\school_management_system\resources\views/dashboard.blade.php ENDPATH**/ ?>