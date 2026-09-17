<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index() {
        return Teacher::all();
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'contact' => 'required|string',
            'subject' => 'required|string',
        ]);
        return Teacher::create($request->all());
    }

    public function show($teacher_id) {
        return Teacher::findOrFail($teacher_id);
    }

    public function update(Request $request, $teacher_id) {
        $teacher = Teacher::findOrFail($teacher_id);
        $teacher->update($request->all());
        return response()->json(['message' => 'Teacher updated successfully', 'data' => $teacher]);
    }

    public function destroy($teacher_id) {
        $teacher = Teacher::findOrFail($teacher_id);
        $teacher->delete();
        return response()->json(['message' => 'Teacher deleted successfully']);
    }
}