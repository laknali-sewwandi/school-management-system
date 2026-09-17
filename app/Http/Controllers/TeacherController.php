<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\Subject;

class TeacherController extends Controller
{
    // Teachers list show with Search
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $teachers = Teacher::where('name', 'LIKE', "%{$search}%")
                                ->orWhere('subject', 'LIKE', "%{$search}%")
                                ->orderBy('teacher_id', 'desc')
                                ->get();
        } else {
            $teachers = Teacher::orderBy('teacher_id', 'desc')->get();
        }

        return view('teachers.index', compact('teachers', 'search'));
    }

    
    // New Teacher add form show
    public function create()
    {
        // database eke all subjects get
        $subjects = \App\Models\Subject::all(); 
        
        // e subjecrt tika ekk page eka load karana
        return view('teachers.create', compact('subjects'));
    }
    // Form data save to Database 
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:15',
            'subject' => 'required|string|max:255',
        ]);

        Teacher::create($request->all());

        return redirect()->route('teachers.index')->with('success', 'Teacher added successfully!');
    }

    // Edit page show
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('teachers.edit', compact('teacher'));
    }

    // change data Database ekat Update kirima
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:15',
            'subject' => 'required|string|max:255',
        ]);

        $teacher = Teacher::findOrFail($id);
        $teacher->update($request->all());

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully!');
    }

    // teacher (Delete)form system
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully!');
    }
}