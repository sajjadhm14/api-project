<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFactory> */
    use HasFactory;

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function options()
    {
        return $this->hasMany(SelectOption::class);
    }


    public function textAnswer()
    {
        return $this->hasOne(TextAnswer::class);
    }

    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class);
    }



}
