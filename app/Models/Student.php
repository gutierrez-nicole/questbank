<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'student_number',
        'full_name',
        'email',
        'program',
        'year_level',
        'section',
        'address',
        'contact_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function results()
    {
        return $this->hasMany(ExaminationResult::class);
    }

    public function performanceRecords()
    {
        return $this->hasMany(AcademicPerformanceRecord::class);
    }
}
