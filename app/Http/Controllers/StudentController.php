<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User; // (User account create)
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; //  (Password encrypt )
use App\Models\Attendance;

class StudentController extends Controller
{
    // 1. student list show
    public function index(Request $request)
    {
        $search = $request->input('search');

        // this place with('attendances') kiyala aluthin (N+1 Issue eka stop karanna)
        $query = Student::with('attendances');

        // 3. Search filter
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('contact', 'LIKE', "%{$search}%")
                  ->orWhere('student_id', 'LIKE', "%{$search}%");
            });
        }

        $students = $query->orderBy('student_id', 'desc')->get();

        return view('students.index', compact('students', 'search'));
    }

    // 2. new student enter page give (Create Form)
    public function create()
    {
        // Dropdowns walata adala data Database eken gannwa
        $users = DB::table('users')->get();
        $classes = DB::table('classes')->get();
        $parents = DB::table('parents')->get();

        return view('students.create', compact('users', 'classes', 'parents'));
    }

    // 3. new student data save Database (Store Logic)
    public function store(Request $request)
    {
        // (Validation)
        $request->validate([
            'class_id' => 'required|integer',
            'parent_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255', // student email aniwarya krnw
            'dob' => 'required|date',
            'address' => 'required|string|max:500',
            'contact' => 'required|string|max:15',
        ]);

        // student User Account eka hadeema
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make('student123'); // Default Password
        $user->save(); 

        // create unu new user database eken aragen aniwarya id eka gannwa 
        $savedUser = User::where('email', $request->email)->first();
        $realUserId = $savedUser->id ?? $savedUser->user_id;

        // Database ekata save 
        Student::create([
            'name' => $request->name,
            'dob' => $request->dob,
            'address' => $request->address,
            'contact' => $request->contact,
            'class_id' => $request->class_id,
            'parent_id' => $request->parent_id,
            'user_id' => $realUserId, // methan ibema new id watenw
        ]);

        // save after go list
        return redirect()->route('students.index')->with('success', 'Student added and User account created successfully!');
    }


   // 4. student full details show (View Profile)
    public function show($id)
    {
        // parent and  attendances kiyana relationship dekama ekapara load karanawa
        $student = Student::with(['attendances', 'parent'])->findOrFail($id);
        return view('students.show', compact('student'));
    }

    // 5.  (Edit Form)
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        
        // Dropdowns walata awashsha data
        $users = DB::table('users')->get();
        $classes = DB::table('classes')->get();
        $parents = DB::table('parents')->get();

        return view('students.edit', compact('student', 'users', 'classes', 'parents'));
    }

    // 6. edit data Database update (Update Logic)
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'class_id' => 'required|integer',
            'parent_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'address' => 'required|string|max:500',
            'contact' => 'required|string|max:15',
        ]);

        $student = Student::findOrFail($id);
        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Student record updated successfully!');
    }

    // 7. delete student (Delete Logic)
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student record deleted successfully!');
    }
}