<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserLessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
        'id' => $this->id,
        'user_id' => $this->user_id,
        'lesson_id' => $this->lesson_id,
        'progress' => $this->progress,
        'total_points' => $this->total_points,
        ];
        
    }
}
