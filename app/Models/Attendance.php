<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';
    protected $primaryKey = 'attendance_id'; // primary key 

    protected $fillable = [
        'teacher_id', // Foreign Key
        'student_id', // Foreign Key
        'date',
        'status'
    ];

    // Student samaga aethi sambandaya (Relationship)
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    // Teacher samaga aethi sambndaya
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'teacher_id');
    }
}