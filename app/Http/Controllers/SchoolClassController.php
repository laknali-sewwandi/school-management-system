<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = SchoolClass::with('teacher');

        if ($search) {
            $query->where('class_name', 'LIKE', "%{$search}%")
                  ->orWhere('section', 'LIKE', "%{$search}%");
        }

        $classes = $query->orderBy('class_id', 'desc')->get();
        return view('classes.index', compact('classes', 'search'));
    }

    public function create()
    {
        $teachers = Teacher::all();
        return view('classes.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_name' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'teacher_id' => 'nullable|integer'
        ]);

        SchoolClass::create($request->all());
        return redirect()->route('classes.index')->with('success', 'Class created successfully!');
    }

    public function edit($id)
    {
        $schoolClass = SchoolClass::findOrFail($id);
        $teachers = Teacher::all();
        return view('classes.edit', compact('schoolClass', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'class_name' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'teacher_id' => 'nullable|integer'
        ]);

        $schoolClass = SchoolClass::findOrFail($id);
        $schoolClass->update($request->all());

        return redirect()->route('classes.index')->with('success', 'Class updated successfully!');
    }

    public function destroy($id)
    {
        $schoolClass = SchoolClass::findOrFail($id);
        $schoolClass->delete();

        return redirect()->route('classes.index')->with('success', 'Class deleted successfully!');
    }
}