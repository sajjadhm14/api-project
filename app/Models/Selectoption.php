<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectOption extends Model
{
    /** @use HasFactory<\Database\Factories\SelectOptionFactory> */
    use HasFactory;

    protected $fillable = [
        'question_id',
        'text',
        'is_correct',
        
    ];
    
      public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class);
    }
}
