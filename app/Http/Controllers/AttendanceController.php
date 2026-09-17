<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\Teacher; 
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // 1. present list show (Index Page) - 
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Attendance::with(['student', 'teacher']);

        if ($search) {
            // Student name or ID eken seweema
            $query->whereHas('student', function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('student_id', 'LIKE', "%{$search}%");
            })
            // date or Status eken seveema
            ->orWhere('date', 'LIKE', "%{$search}%")
            ->orWhere('status', 'LIKE', "%{$search}%");
        }

        // Student and Teacher details ekkama Attendance data gannawa
        $attendances = $query->orderBy('date', 'desc')
                             ->orderBy('attendance_id', 'desc')
                             ->get();

        return view('attendances.index', compact('attendances', 'search'));
    }


    // new Attendance form show (Bulk Entry)
    public function create()
    {
        $students = Student::orderBy('student_id', 'asc')->get(); 
        $teachers = Teacher::all();
        return view('attendances.create', compact('students', 'teachers'));
    }

    // Attendance data save (Bulk Entry Store)
    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|integer',
            'date' => 'required|date',
            'statuses' => 'required|array', // all student  status eka Array ekk vidiyata enne
        ]);

        $teacher_id = $request->teacher_id;
        $date = $request->date;

        foreach ($request->statuses as $student_id => $status) {
            // updateOrCreate use karanne ekama dwse deparak  attendance mark wena eka nawaththnna
            Attendance::updateOrCreate(
                [
                    'student_id' => $student_id,
                    'date' => $date
                ],
                [
                    'teacher_id' => $teacher_id,
                    'status' => $status
                ]
            );
        }

        return redirect()->route('attendances.index')->with('success', 'Bulk attendance marked successfully!');
    }
    // 4. Edit form show
    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);
        $students = Student::orderBy('student_id', 'desc')->get();
        $teachers = Teacher::all(); 

        return view('attendances.edit', compact('attendance', 'students', 'teachers'));
    }

    // 5. Update 
    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'teacher_id' => 'required|integer',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,late',
        ]);

        $attendance = Attendance::findOrFail($id);
        $attendance->update($request->all());

        return redirect()->route('attendances.index')->with('success', 'Attendance updated successfully!');
    }

    // 6. Delete
    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();

        return redirect()->route('attendances.index')->with('success', 'Attendance deleted successfully!');
    }


}