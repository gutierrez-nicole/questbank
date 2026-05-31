<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'examination_id',
        'type',
        'question_text',
        'options',
        'correct_answer',
        'points',
    ];

    protected function casts(): array
    {
        return ['options' => 'array'];
    }

    public function examination()
    {
        return $this->belongsTo(Examination::class);
    }
}
