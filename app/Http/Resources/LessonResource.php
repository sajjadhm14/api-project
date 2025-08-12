<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class LessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        'id' => $this->id,
        'title' => $this->title,
        'description' => $this->description,
        'category_id' => $this->category_id,
        'category' => new CategoryResource($this->whenLoaded('category')),
        'banner_url' => $this->getFirstMediaUrl('banner'),
        'banner_thumb_url' => $this->getFirstMediaUrl('banner', 'thumb'),
        ];
    }
}
