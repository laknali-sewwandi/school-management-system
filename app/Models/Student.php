<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attendance;
use App\Models\Mark;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $primaryKey = 'student_id';
    
    //
    protected $fillable = [
        'user_id', 'class_id', 'parent_id', 'name', 'dob', 'address', 'contact', 'percentage'
    ];

    // 1. Attendance relationship
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'student_id', 'student_id');
    }

    // 2. Parent relationship
    public function parent()
    {
        return $this->belongsTo(SchoolParent::class, 'parent_id', 'parent_id');
    }

    // 3. Attendance Percentage Function 
    public function getAttendancePercentageAttribute()
    {
        $totalDays = $this->attendances()->count();

        if ($totalDays === 0) {
            return 0;
        }

        $attendedDays = $this->attendances()->whereIn('status', ['Present', 'Late'])->count();

        return round(($attendedDays / $totalDays) * 100, 0);
    }

    // 4. Marks relationship
    public function marks()
    {
        return $this->hasMany(Mark::class, 'student_id', 'student_id');
    }
}