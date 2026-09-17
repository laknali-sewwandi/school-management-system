<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Teacher; // Teacher model eka import karanna oni
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Subject::with('teacher'); // Teacherge details gannawa

        if ($search) {
            $query->where('subject_name', 'LIKE', "%{$search}%");
        } 
        
        $subjects = $query->orderBy('subject_id', 'desc')->get();
        return view('subjects.index', compact('subjects', 'search'));
    }

    public function create()
    {
        $teachers = Teacher::all(); // Teachers list get
        return view('subjects.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject_name' => 'required|string|max:255',
            'teacher_id' => 'required|integer' // Teacher aniwarya kara
        ]);

        Subject::create($request->all());
        return redirect()->route('subjects.index')->with('success', 'Subject created successfully!');
    }


    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $teachers = Teacher::all();
        return view('subjects.edit', compact('subject', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'subject_name' => 'required|string|max:255',
            'teacher_id' => 'required|integer'
        ]);

        $subject = Subject::findOrFail($id);
        $subject->update($request->all());

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully!');
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully!');
    }


}