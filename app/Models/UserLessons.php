<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLessons extends Model
{
    /** @use HasFactory<\Database\Factories\UserLessonsFactory> */
    use HasFactory;
    protected $fillable = [
    'user_id',
    'lesson_id',
    'progress',
    'total_points',
    ];
      public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
