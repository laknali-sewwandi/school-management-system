<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClassController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TeacherController;

// 1. API Login & Register (public route)
Route::post('/register', [AuthController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);

// 2. Protected Routes (Token eka aniwaryai)

Route::middleware('auth:sanctum')->name('api.')->group(function () {

    // Classes Routes
    Route::apiResource('classes', ClassController::class);

    // Teachers Routes
    Route::apiResource('teachers', TeacherController::class);

    // Students Routes
    Route::apiResource('students', StudentController::class);

    // All Users List
    Route::get('/users', function () {
        return \App\Models\User::all();
    });
        // Update User
    Route::put('/users/{id}', function (\Illuminate\Http\Request $request, $id) {
        $user = \App\Models\User::find($id);
        
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->update($request->all());
        
        return response()->json([
            'message' => 'User updated successfully!', 
            'user' => $user
        ]);
    });

    // Delete User
    Route::delete('/users/{id}', function ($id) {
        $user = \App\Models\User::find($id);
        
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();
        
        return response()->json(['message' => 'User deleted successfully!']);
    });
   
});