<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('students', function (Blueprint $table) {
    $table->id('student_id');
    $table->foreignId('user_id')->constrained('users','user_id');
    $table->foreignId('class_id')->constrained('classes', 'class_id');
    $table->foreignId('parent_id')->constrained('parents', 'parent_id');
    $table->string('name');
    $table->date('dob');
    $table->string('address');
    $table->string('contact');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
