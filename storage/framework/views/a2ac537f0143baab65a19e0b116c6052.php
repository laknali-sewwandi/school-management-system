<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Dashboard - School MS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-slate-50 font-sans antialiased">
    <div class="min-h-screen flex">
        
        <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="flex-1 p-10 overflow-y-auto bg-slate-50">
            
            <?php if(session('success')): ?>
            <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-r-xl shadow-sm mb-6 flex items-center">
                <i class="fa-solid fa-circle-check text-xl mr-3"></i>
                <p class="font-bold text-sm"><?php echo e(session('success')); ?></p>
            </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
            <div class="bg-rose-50 border-l-4 border-rose-500 text-rose-700 p-4 rounded-r-xl shadow-sm mb-6 flex items-center">
                <i class="fa-solid fa-circle-exclamation text-xl mr-3"></i>
                <p class="font-bold text-sm"><?php echo e(session('error')); ?></p>
            </div>
            <?php endif; ?>
            
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center gap-4">
                    <div class="bg-indigo-100 p-3 rounded-2xl text-indigo-600 shadow-sm">
                        <i class="fa-solid fa-house-chimney-user text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-extrabold text-slate-800">Parent Analytics Portal</h2>
                        <p class="text-slate-500 mt-1 text-sm font-medium">Performance & Attendance Overview</p>
                    </div>
                </div>
                <div class="flex gap-3">
                    <a href="<?php echo e(route('parents.index')); ?>" class="bg-white border border-slate-200 text-slate-700 hover:bg-slate-100 font-bold py-2.5 px-5 rounded-xl shadow-sm transition-all flex items-center text-sm">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Back
                    </a>
                    <a href="<?php echo e(route('parents.report', $parent->parent_id)); ?>" class="bg-gradient-to-r from-indigo-500 to-blue-600 hover:from-indigo-600 hover:to-blue-700 text-white font-bold py-2.5 px-5 rounded-xl shadow-lg transition-all flex items-center text-sm transform hover:-translate-y-1">
                        <i class="fa-solid fa-file-pdf mr-2"></i> Generate Report
                    </a>

                    <form action="<?php echo e(route('parents.alert-email', $parent->parent_id)); ?>" method="POST" class="inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="bg-gradient-to-r from-rose-500 to-red-600 hover:from-rose-600 hover:to-red-700 text-white font-bold py-2.5 px-5 rounded-xl shadow-lg transition-all flex items-center text-sm transform hover:-translate-y-1">
                            <i class="fa-solid fa-envelope-open-text mr-2"></i> Send Alert Email
                        </button>
                    </form>
                </div>
            </div>

            <?php if($student): ?>
                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6 mb-8 flex flex-col md:flex-row justify-between items-center gap-6 relative overflow-hidden">
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-indigo-500"></div>
                    
                    <div class="flex items-center gap-6 pl-2">
                        <div class="h-16 w-16 rounded-full bg-gradient-to-br from-indigo-50 to-blue-50 border border-indigo-100 text-indigo-600 flex items-center justify-center font-black text-2xl shadow-sm">
                            <?php echo e(strtoupper(substr($student->name, 0, 1))); ?>

                        </div>
                        <div>
                            <h3 class="text-xl font-black text-slate-800 mb-3">Student: <?php echo e($student->name); ?></h3>
                            
                            <div class="flex flex-wrap items-center gap-3">
                                <div class="text-sm font-bold text-slate-600 bg-slate-50 border border-slate-200 px-3 py-1.5 rounded-lg flex items-center shadow-sm">
                                    <i class="fa-solid fa-user-shield text-indigo-500 mr-2"></i> <?php echo e($parent->name); ?>

                                </div>
                                
                                <div class="text-sm font-bold text-slate-600 bg-slate-50 border border-slate-200 px-3 py-1.5 rounded-lg flex items-center shadow-sm">
                                    <i class="fa-solid fa-phone text-indigo-500 mr-2"></i> <?php echo e($parent->contact); ?>

                                </div>

                                <div class="text-sm font-bold text-slate-600 bg-slate-50 border border-slate-200 px-3 py-1.5 rounded-lg flex items-center shadow-sm">
                                    <i class="fa-solid fa-envelope text-indigo-500 mr-2"></i> 
                                    <?php echo e($parent->email ? $parent->email : 'No email added'); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <div class="lg:col-span-2 bg-white p-8 rounded-3xl shadow-lg border border-slate-100 relative overflow-hidden">
                        <div class="h-1 w-full bg-gradient-to-r from-indigo-500 to-blue-500 absolute top-0 left-0"></div>
                        <h3 class="text-lg font-extrabold text-slate-800 mb-6 flex items-center">
                            <i class="fa-solid fa-chart-simple text-indigo-500 mr-3 text-xl"></i> Academic Performance Overview
                        </h3>
                        
                        <div class="relative h-[300px] w-full">
                            <canvas id="marksChart"></canvas>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-3xl shadow-lg border border-slate-100 relative overflow-hidden flex flex-col">
                        <div class="h-1 w-full bg-gradient-to-r from-emerald-500 to-teal-500 absolute top-0 left-0"></div>
                        <h3 class="text-lg font-extrabold text-slate-800 mb-6 flex items-center">
                            <i class="fa-solid fa-calendar-check text-emerald-500 mr-3 text-xl"></i> Attendance Rate
                        </h3>
                        
                        <div class="relative h-[220px] w-full flex-1 flex justify-center items-center">
                            <canvas id="attendanceChart"></canvas>
                            <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none mt-4">
                                <span class="text-4xl font-black text-slate-800"><?php echo e(number_format($student->attendance_percentage ?? 0, 0)); ?>%</span>
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Present</span>
                            </div>
                        </div>
                        
                        <div class="mt-6 pt-6 border-t border-slate-100 flex justify-between">
                            <div class="text-center">
                                <p class="text-xs font-bold text-slate-400">Total Days</p>
                                <p class="text-lg font-black text-slate-700"><?php echo e($student->attendances->count()); ?></p>
                            </div>
                            <div class="text-center">
                                <p class="text-xs font-bold text-emerald-400">Attended</p>
                                <p class="text-lg font-black text-emerald-600"><?php echo e($student->attendances->whereIn('status', ['Present', 'Late','present','late'])->count()); ?></p>
                            </div>
                        </div>
                    </div>

                </div>
            <?php else: ?>
                <div class="bg-amber-50 border border-amber-200 text-amber-700 px-6 py-8 rounded-2xl flex flex-col items-center justify-center shadow-sm text-center">
                    <i class="fa-solid fa-triangle-exclamation text-4xl mb-4 text-amber-400"></i>
                    <h3 class="font-black text-xl mb-1">No Student Data Found</h3>
                    <p class="font-medium text-amber-600">This parent does not have a registered student assigned to them yet.</p>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <?php if($student): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // Get data passed from the Controller
            const labels = <?php echo json_encode($chartLabels, 15, 512) ?>;
            const data = <?php echo json_encode($chartData, 15, 512) ?>;
            const attendancePercentage = <?php echo e($student->attendance_percentage ?? 0); ?>;
            const absentPercentage = 100 - attendancePercentage;

            // --- 1. Render Bar Chart for Exam Marks ---
            const marksCtx = document.getElementById('marksChart').getContext('2d');
            
            // Create a nice gradient for the bars
            let marksGradient = marksCtx.createLinearGradient(0, 0, 0, 400);
            marksGradient.addColorStop(0, 'rgba(79, 70, 229, 0.9)'); // Indigo color top
            marksGradient.addColorStop(1, 'rgba(59, 130, 246, 0.4)'); // Blue fade bottom

            new Chart(marksCtx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: ' Exam Marks',
                        data: data,
                        backgroundColor: marksGradient,
                        borderRadius: 8, // Modern rounded corners
                        borderSkipped: false,
                        barThickness: 35
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
                            titleFont: { size: 14, family: 'sans-serif' },
                            bodyFont: { size: 16, weight: 'bold' },
                            callbacks: {
                                label: function(context) { return context.parsed.y + ' Marks'; }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100, // Maximum marks out of 100
                            grid: { color: 'rgba(241, 245, 249, 1)', drawBorder: false },
                            ticks: { font: { weight: 'bold' }, color: '#94a3b8' }
                        },
                        x: {
                            grid: { display: false, drawBorder: false },
                            ticks: { font: { weight: 'bold' }, color: '#64748b' }
                        }
                    },
                    animation: {
                        duration: 2000,
                        easing: 'easeOutQuart'
                    }
                }
            });

            // --- 2. Render Doughnut Chart for Attendance ---
            const attCtx = document.getElementById('attendanceChart').getContext('2d');
            
            new Chart(attCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Attended', 'Absent/Missed'],
                    datasets: [{
                        data: [attendancePercentage, absentPercentage],
                        backgroundColor: [
                            'rgba(16, 185, 129, 0.9)', // Emerald color for attended
                            'rgba(241, 245, 249, 1)'   // Light gray for missing
                        ],
                        borderWidth: 0,
                        hoverOffset: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%', // Creates space in the middle for the text
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) { return ' ' + context.parsed + '%'; }
                            }
                        }
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true,
                        duration: 1500
                    }
                }
            });

        });
    </script>
    <?php endif; ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\school_management_system\resources\views/parents/show.blade.php ENDPATH**/ ?>