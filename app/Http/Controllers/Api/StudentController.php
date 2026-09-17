<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // 1. Get all students
    public function index() {
        return Student::all();
    }

    // 2. Add new student
    public function store(Request $request) {
        $request->validate([
            'user_id' => 'required|integer',
            'class_id' => 'required|integer',
            'parent_id' => 'required|integer',
            'name' => 'required|string',
            'dob' => 'required|date',
            'address' => 'required|string',
            'contact' => 'required|string',
            'attendance_percentage' => 'nullable|numeric'
        ]);

        return Student::create($request->all());
    }

    // 3. Show student details
    public function show($student_id) {
        return Student::findOrFail($student_id);
    }

    // 4. Update student details
    public function update(Request $request, $student_id) {
        $student = Student::findOrFail($student_id);
        $student->update($request->all());
        
        return response()->json([
            'message' => 'Student updated successfully', 
            'data' => $student
        ]);
    }

    // 5. Delete student
    public function destroy($student_id) {
        $student = Student::findOrFail($student_id);
        $student->delete();
        
        return response()->json([
            'message' => 'Student deleted successfully'
        ]);
    }
}