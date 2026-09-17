<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Progress Report</title>
    <style>
        body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; }
        .header { text-align: center; border-bottom: 2px solid #4f46e5; padding-bottom: 10px; margin-bottom: 20px; }
        .school-name { font-size: 24px; font-weight: bold; color: #4f46e5; margin: 0; }
        .report-title { font-size: 18px; color: #666; margin: 5px 0; }
        .details-table { width: 100%; margin-bottom: 30px; border-collapse: collapse; }
        .details-table td { padding: 8px; border-bottom: 1px solid #eee; }
        .section-title { background-color: #f8fafc; padding: 10px; font-size: 16px; font-weight: bold; border-left: 4px solid #4f46e5; margin-bottom: 15px; }
        .data-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .data-table th, .data-table td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        .data-table th { background-color: #f1f5f9; color: #333; }
        .footer { text-align: center; font-size: 12px; color: #999; margin-top: 50px; border-top: 1px solid #eee; padding-top: 10px; }
    </style>
</head>
<body>

    <div class="header">
        <h1 class="school-name">School Management System</h1>
        <p class="report-title">Student Progress & Attendance Report</p>
        <p style="font-size: 12px; color: #999;">Generated on: {{ date('Y-m-d') }}</p>
    </div>

    <div class="section-title">Student & Parent Information</div>
    <table class="details-table">
        <tr>
            <td width="25%"><strong>Student Name:</strong></td>
            <td width="25%">{{ $student->name }}</td>
            <td width="25%"><strong>Parent Name:</strong></td>
            <td width="25%">{{ $parent->name }}</td>
        </tr>
        <tr>
            <td><strong>Student ID:</strong></td>
            <td>{{ $student->student_id }}</td>
            <td><strong>Contact No:</strong></td>
            <td>{{ $parent->contact }}</td>
        </tr>
    </table>

    <div class="section-title">Attendance Summary</div>
    <table class="data-table">
        <tr>
            <th>Total School Days</th>
            <th>Days Attended</th>
            <th>Attendance Percentage</th>
        </tr>
        <tr>
            <td>{{ $totalDays }} Days</td>
            <td>{{ $attendedDays }} Days</td>
            <td><strong>{{ number_format($attendancePercentage, 0) }}%</strong></td>
        </tr>
    </table>

    <div class="section-title">Academic Performance (Marks)</div>
    <table class="data-table">
        <tr>
            <th width="70%">Subject Name</th>
            <th width="30%">Marks Scored</th>
        </tr>
        @forelse($student->marks as $mark)
        <tr>
            <td>{{ $mark->subject->subject_name ?? 'N/A' }}</td>
            <td>{{ $mark->marks }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="2" style="text-align: center;">No exam marks recorded yet.</td>
        </tr>
        @endforelse
    </table>

    <div class="footer">
        This is a computer-generated report and does not require a signature.<br>
        © {{ date('Y') }} School Management System. All rights reserved.
    </div>

</body>
</html>