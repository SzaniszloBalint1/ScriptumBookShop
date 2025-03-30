<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'title' => $this->title,
            'author' => $this->author,
            'isbn' => $this->isbn,
            'publish_date' => $this->publish_date,
            'price' => $this->price,
            'describe' => $this->describe,
            'cover_image' => $this->cover_image,
            'categories' => $this->collection($this->whenLoaded('categories'))
        ];
    }
}
