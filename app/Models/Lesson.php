<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\LessonFactory> */
    use HasFactory, InteractsWithMedia;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('banner')->singleFile();

        $this->addMediaCollection('images');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(200)
            ->nonQueued()
            ->performOnCollections('banner','images');

        $this->addMediaConversion('webp')
            ->format('webp')
            ->performOnCollections('images');
    }
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
