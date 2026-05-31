<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningRecommendation extends Model
{
    protected $fillable = [
        'student_id',
        'subject_id',
        'category',
        'recommendation',
        'is_ai_generated',
    ];

    protected function casts(): array
    {
        return ['is_ai_generated' => 'boolean'];
    }
}
