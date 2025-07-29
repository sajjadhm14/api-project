<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    /** @use HasFactory<\Database\Factories\LessonFactory> */
    use HasFactory;
    protected $fillable = [
        'category_id',
        'title',
        'description',
        
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function users()
    {
        return $this->hasMany(UserLessons::class);
    }
}
