<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextAnswer extends Model
{
    /** @use HasFactory<\Database\Factories\TextAnswerFactory> */
    use HasFactory;
    protected $fillable = [
        'question_id',
        'expected_answer',
        
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
