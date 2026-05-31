<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExaminationResult extends Model
{
    protected $fillable = [
        'examination_id',
        'student_id',
        'score',
        'total_points',
        'percentage',
        'status',
        'answers',
        'started_at',
        'submitted_at',
    ];

    protected function casts(): array
    {
        return [
            'answers' => 'array',
            'started_at' => 'datetime',
            'submitted_at' => 'datetime',
        ];
    }

    public function examination()
    {
        return $this->belongsTo(Examination::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
