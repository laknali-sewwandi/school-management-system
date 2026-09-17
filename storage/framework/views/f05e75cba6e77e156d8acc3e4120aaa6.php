<!DOCTYPE html>
<html>
<head>
    <title>Low Attendance Alert</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
        <div style="background-color: #e11d48; color: white; padding: 20px; text-align: center;">
            <h2 style="margin: 0;">Attendance Warning Notice</h2>
        </div>
        <div style="padding: 24px; background-color: #ffffff;">
            <p>Dear <strong><?php echo e($parent->name); ?></strong>,</p>
            
            <p>This is an automated notification from the School Management System to inform you regarding the attendance of your child, <strong><?php echo e($student->name); ?></strong>.</p>
            
            <div style="background-color: #fff1f2; border-left: 4px solid #e11d48; padding: 15px; margin: 20px 0; border-radius: 4px;">
                <p style="margin: 0; font-size: 16px; color: #9f1239;">
                    Current Attendance Rate: <strong style="font-size: 20px;"><?php echo e(number_format($percentage, 0)); ?>%</strong>
                </p>
                <p style="margin: 5px 0 0 0; font-size: 13px; color: #be123c;">Minimum required attendance is 75%.</p>
            </div>

            <p>Please note that low attendance may affect their academic eligibility and exam admissions. We highly recommend discussing this matter with your child to ensure regular attendance.</p>
            
            <p>If you have any queries or justification for absences (medical reasons, etc.), please reply to this email or contact the school office directly.</p>
            
            <hr style="border: 0; border-top: 1px solid #edf2f7; margin: 24px 0;">
            <p style="font-size: 12px; color: #718096; text-align: center;">School Administration Team<br>© <?php echo e(date('Y')); ?> School MS. All rights reserved.</p>
        </div>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\school_management_system\resources\views/emails/low_attendance.blade.php ENDPATH**/ ?>