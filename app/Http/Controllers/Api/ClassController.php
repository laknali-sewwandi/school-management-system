<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    // 1. class see all (GET)
    public function index() {
        return SchoolClass::all();
    }

    // 2. add new class(POST)
    public function store(Request $request) {
        $request->validate([
            'class_name' => 'required|string',
            'section' => 'required|string',
            'teacher_id'=> 'required|integer',
        ]);

        return SchoolClass::create($request->all());
    }

    public function update(Request $request, $class_id) { 
    $class = SchoolClass::findOrFail($class_id);
    $class->update($request->all());
    return response()->json(['message' => 'Class updated successfully', 'data' => $class]);
}
//class details
public function show($class_id) { 
    return SchoolClass::findOrFail($class_id);
}
// class  delete
public function destroy($class_id) {
    $class = SchoolClass::findOrFail($class_id);
    $class->delete();
    return response()->json(['message' => 'Class deleted successfully']);
}
}