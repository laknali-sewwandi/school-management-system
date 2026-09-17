<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    // 1. marks list show and  search (Index)
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = Mark::with(['student', 'subject']);

        if ($search) {
            // Group the search conditions to prevent SQL logic issues
            $query->where(function($q) use ($search) {
                
                // 1.student name search
                $q->whereHas('student', function($q2) use ($search) {
                    $q2->where('name', 'LIKE', "%{$search}%");
                })
                
                // 2. subject name search  kirima
                ->orWhereHas('subject', function($q3) use ($search) {
                    $q3->where('subject_name', 'LIKE', "%{$search}%");
                })
                
                // 3. exam name search kiriema
                ->orWhere('exam_name', 'LIKE', "%{$search}%");
                
            });
        }

        $marks = $query->orderBy('mark_id', 'desc')->get();
        return view('marks.index', compact('marks', 'search'));
    }

    // 2. new marks enter form show (Bulk Entry Create)
    public function create()
    {
        $students = Student::orderBy('student_id', 'asc')->get(); 
        $subjects = Subject::all();
        return view('marks.create', compact('students', 'subjects'));
    }

    // 3. new marks data store save(Bulk Entry Store)
    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|integer',
            'exam_name' => 'required|string|max:255',
            'marks' => 'required|array', 
            'grades' => 'required|array', 
        ]);

        $subject_id = $request->subject_id;
        $exam_name = $request->exam_name;

        foreach ($request->marks as $student_id => $mark) {
            if ($mark !== null && $mark !== '') { 
                Mark::updateOrCreate(
                    [
                        'student_id' => $student_id,
                        'subject_id' => $subject_id,
                        'exam_name' => $exam_name
                    ],
                    [
                        'marks' => $mark,
                        'grade' => $request->grades[$student_id] ?? 'W'
                    ]
                );
            }
        }

        return redirect()->route('marks.index')->with('success', 'Bulk marks saved successfully!');
    }

    // 4. edit form show (Edit)
    public function edit($id)
    {
        $mark = Mark::findOrFail($id);
        $students = Student::all();
        $subjects = Subject::all();
        return view('marks.edit', compact('mark', 'students', 'subjects'));
    }

    // 5. update form (Update)
    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'exam_name' => 'required|string|max:255',
            'marks' => 'required|integer|min:0|max:100',
            'grade' => 'required|string|max:5',
        ]);

        $mark = Mark::findOrFail($id);
        $mark->update($request->all());

        return redirect()->route('marks.index')->with('success', 'Marks updated successfully!');
    }

    // 6. data recode delete(Destroy)
    public function destroy($id)
    {
        $mark = Mark::findOrFail($id);
        $mark->delete();

        return redirect()->route('marks.index')->with('success', 'Marks deleted successfully!');
    }
}