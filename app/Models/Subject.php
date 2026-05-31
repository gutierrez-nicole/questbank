<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['instructor_id', 'code', 'name', 'program', 'description', 'units'];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function examinations()
    {
        return $this->hasMany(Examination::class);
    }

    public function performanceRecords()
    {
        return $this->hasMany(AcademicPerformanceRecord::class);
    }
}
