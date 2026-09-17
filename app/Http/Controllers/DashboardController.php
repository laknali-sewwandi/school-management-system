<?php

namespace App\Http\Controllers;



use App\Models\SchoolParent;
use Illuminate\Support\Facades\Mail;
use App\Mail\LowAttendanceMail;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\Attendance; 
use Carbon\Carbon;         // date calculate karann Carbon dnn
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTeachers = Teacher::count();
        $totalStudents = Student::count();
        $totalClasses  = SchoolClass::count();
        
        $recentTeachers = Teacher::orderBy('created_at', 'desc')->take(3)->get();


        // 1. Chart Data calculation (this week monday and fridey dakwa)
        
        $chartData = [];
        $startOfWeek = Carbon::now()->startOfWeek(); // this week monday dwasa gani

        for ($i = 0; $i < 5; $i++) {
            // monday idn dws gann gann krl hadagannw (Y-m-d format)
            $date = $startOfWeek->copy()->addDays($i)->format('Y-m-d');

            // e dwst adla mulu lamaiganana and apu student ganna
            $total = Attendance::where('date', $date)->count();
            $present = Attendance::where('date', $date)->where('status', 'present')->count();

            if ($total > 0) {
                //  (Percentage) calculation
                $chartData[] = round(($present / $total) * 100);
            } else {
                // e dwse kisima data ekk neththm 0% lesa penni
                $chartData[] = 0; 
            }
        }


        // 2. Low Attendance student calculation (75% ට අඩු අය)
    
        $lowAttendanceStudents = Student::withCount([
            'attendances as total_attendances',
            'attendances as present_attendances' => function ($query) {
                $query->where('status', 'present');
            }
        ])->get()->filter(function ($student) {
            // attendance satahan nomethi student athharinna
            if ($student->total_attendances == 0) return false;
            
            // student present pracentage caculation
            $percentage = ($student->present_attendances / $student->total_attendances) * 100;
            
            // presentage eka View ekta yawanna student object ekatama save karanawa
            $student->attendance_percentage = round($percentage);
            
            // 75% t low aya pamanak filter karala gannwa 
            return $percentage < 75; 
        })->take(4); // uprima lami 4k penni

        return view('dashboard', compact(
            'totalTeachers', 'totalStudents', 'totalClasses', 
            'recentTeachers', 'lowAttendanceStudents', 'chartData'
        ));
    }
    

   public function sendAlert($id)
{
    // 1. Dashboard eken ena ID eken Student wa hoyagannawa
    $student = Student::findOrFail($id);
    
    // 2. your Student module eke thiyena parent() relationship eka use karala Parent wa hoyagannawa 
    $parent = $student->parent;

    // Parent kenek link karala neththm error enw
    if (!$parent) {
        return redirect()->back()->with('error', 'No parent assigned to this student.');
    }

    // 3.your module eke tiyena getAttendancePercentageAttribute eka use karanawa
    $percentage = $student->attendance_percentage;

    // 4. Parent ge Email eka gannawa (nethinam Test Email ekak  danawa)
    $parentEmail = $parent->email ?? 'test@gmail.com';

    // 5. full HTML Mail ekama yawanawa
    Mail::to($parentEmail)->send(new LowAttendanceMail($parent, $student, $percentage));

    // 6. Success msg eka pennala aye dashboard ekt ynwa
    return redirect()->back()->with('success', 'Alert email sent successfully to the parent!');
}



}