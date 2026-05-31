<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicPerformanceRecord extends Model
{
    protected $fillable = [
        'student_id',
        'subject_id',
        'examination_result_id',
        'assessment_type',
        'score',
        'total_points',
        'percentage',
        'recorded_on',
    ];

    protected function casts(): array
    {
        return ['recorded_on' => 'date'];
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function examinationResult()
    {
        return $this->belongsTo(ExaminationResult::class);
    }
}
