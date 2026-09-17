<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;

    protected $table = 'classes';
    protected $primaryKey = 'class_id';

    protected $fillable = [
        'class_name', 
        'section', 
        'teacher_id'
    ];

    // class bara teacher athara sambandaya
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'teacher_id');
    }
}