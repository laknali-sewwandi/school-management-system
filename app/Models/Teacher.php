<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory; // මේක එකතු කරගන්න

    protected $table = 'teachers';
    protected $primaryKey = 'teacher_id';

    // teacher colum
    protected $fillable = [
        'name', 
        'contact', 
        'subject',
        'image' // picture upload karanna nam
    ];
}