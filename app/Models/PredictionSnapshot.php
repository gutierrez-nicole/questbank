<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PredictionSnapshot extends Model
{
    protected $fillable = [
        'student_id',
        'subject_id',
        'prediction_type',
        'confidence_score',
        'predicted_outcome',
        'input_summary',
        'model_version',
        'generated_at',
    ];

    protected function casts(): array
    {
        return [
            'input_summary' => 'array',
            'generated_at' => 'datetime',
        ];
    }
}
