<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolParent;
use App\Models\Student;
use App\Models\User; // aluthin ekathu kala (User account hadanna)
use Illuminate\Support\Facades\Hash; // (Password encrypt karanna)
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\LowAttendanceMail;

class ParentController extends Controller
{
    // 1. Show the list of parents (Index Page)
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = SchoolParent::query();

        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('contact', 'LIKE', "%{$search}%");
        }

        $parents = $query->orderBy('parent_id', 'desc')->get();
        
        return view('parents.index', compact('parents', 'search'));
    }

    // 2. Show the Parent Dashboard with Charts (Show Page)
    public function show($id)
    {
        $parent = SchoolParent::findOrFail($id);
        
        $student = Student::with(['attendances', 'marks.subject'])->where('parent_id', $id)->first();

        $chartLabels = [];
        $chartData = [];

        if ($student && $student->marks) {
            foreach ($student->marks as $mark) {
                $chartLabels[] = $mark->subject->subject_name ?? 'Subject';
                $chartData[] = $mark->marks;
            }
        }

        return view('parents.show', compact('parent', 'student', 'chartLabels', 'chartData'));
    }

    // 3. Show the form to add a new parent
    public function create()
    {
        return view('parents.create');
    }

    // 4. Store the new parent in the database
    public function store(Request $request)
    {
        // 1. Data Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email|max:255', 
            'address' => 'nullable|string',
        ]);

        // 2. new user set kirima
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make('password123');
        $user->save(); 

        // set unu user aniwaryayen database eken gannawa 
        $savedUser = User::where('email', $request->email)->first();
        
        // oyge table eke kiynne 'id' d 'user_id' d kiyala adala nethiwenna dekama allanwa
        $realUserId = $savedUser->id ?? $savedUser->user_id;

        // 3. e aniwarya ID eka use karala Parent wa set krnw
        SchoolParent::create([
            'name' => $request->name,
            'contact' => $request->contact,
            'email' => $request->email,
            'address' => $request->address,
            'user_id' => $realUserId, 
        ]);

        return redirect()->route('parents.index')->with('success', 'Parent added and User account created successfully!');
    }

    // 5. Show the form for editing the parent
    public function edit($id)
    {
        $parent = SchoolParent::findOrFail($id);
        return view('parents.edit', compact('parent'));
    }

    // 6. Update the parent in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:15',
             'email' => 'nullable|email|max:255', 
            'address' => 'nullable|string',
        ]);

        $parent = SchoolParent::findOrFail($id);
        $parent->update([
            'name' => $request->name,
            'contact' => $request->contact,
             'email' => $request->email,
            'address' => $request->address,
        ]);

        return redirect()->route('parents.index')->with('success', 'Parent updated successfully!');
    }

    // 7. Delete the parent from the database
    public function destroy($id)
    {
        $parent = SchoolParent::findOrFail($id);
        $parent->delete();

        return redirect()->route('parents.index')->with('success', 'Parent deleted successfully!');
    }

    
   // 8. Generate and Download PDF Report
    public function downloadReport($id)
    {
        $parent = SchoolParent::findOrFail($id);
        $student = Student::with(['attendances', 'marks.subject'])->where('parent_id', $id)->first();

        if (!$student) {
            return redirect()->back()->with('error', 'No student assigned to generate a report.');
        }

        $totalDays = $student->attendances->count();
        $attendedDays = $student->attendances->whereIn('status', ['Present', 'Late', 'present', 'late'])->count();
        $attendancePercentage = $student->attendance_percentage;

        // 
        $pdf = app('dompdf.wrapper')->loadView('parents.report', compact('parent', 'student', 'totalDays', 'attendedDays', 'attendancePercentage'));

        return $pdf->download($student->name . '_Progress_Report.pdf');
    }

// 9. Send Attendance Alert Email to Parent
    public function sendAttendanceAlert($id)
    {
        $parent = SchoolParent::findOrFail($id);
        $student = Student::where('parent_id', $id)->first();

        if (!$student) {
            return redirect()->back()->with('error', 'No student assigned to this parent.');
        }

        $percentage = $student->attendance_percentage;

        // methna simawa danawa (Threshold) 75% kiyala. 75% t low nam name eka vithrak email ekata yanawa
        if ($percentage < 75) {
            
            // NOTE:parent table eke email ekk neththm, test email (ex: 'test@gmail.com')
            $parentEmail = $parent->email ?? 'your-test-email@gmail.com'; 

            // email send code
            Mail::to($parentEmail)->send(new LowAttendanceMail($parent, $student, $percentage));

            return redirect()->back()->with('success', 'Alert email sent successfully to the parent!');
        } else {
            // 75% t wada high nam Warning email ekak ywnn awashsha ne
            return redirect()->back()->with('error', 'Student has good attendance (' . number_format($percentage,0) . '%). No alert needed.');
        }
    }

}