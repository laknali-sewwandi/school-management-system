<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolParent extends Model
{
    use HasFactory;

    // Database 
    protected $table = 'parents'; 
    protected $primaryKey = 'parent_id';

    // Ekhane user_id 
    protected $fillable = [
        'user_id',
        'name',
        'contact',
        'email',
        'address'
    ];
}