<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResource extends JsonResource
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
            'user_id' => $this->user_id,
            'OrderDate' => $this->OrderDate,
            'Status' => $this->Status,
            'TotalAmount' => $this->TotalAmount,
            'reference_id' => $this->reference_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'order_items' => $this->whenLoaded('orderItems', function() {
                return $this->orderItems->map(function($item) {
                    return [
                        'id' => $item->id,
                        'order_id' => $item->order_id,
                        'book_id' => $item->book_id,
                        'Quantity' => $item->Quantity,
                        'UnitPrice' => $item->UnitPrice,
                        'BooksTotalPrice' => $item->BooksTotalPrice,
                        'created_at' => $item->created_at,
                        'updated_at' => $item->updated_at,
                        'book' => $item->book ? [
                            'id' => $item->book->id,
                            'title' => $item->book->title,
                            'author' => $item->book->author,
                            'isbn' => $item->book->isbn,
                            'publish_date' => $item->book->publish_date,
                            'price' => $item->book->price,
                            'rating' => $item->book->rating,
                            'cover_image' => $item->book->cover_image,
                            'describe' => $item->book->describe,
                            'views' => $item->book->views,
                            'category_id' => $item->book->category_id,
                            'created_at' => $item->book->created_at,
                            'updated_at' => $item->book->updated_at,
                        ] : null
                    ];
                });
            }),
            'payments' => $this->whenLoaded('payments'),
            'shipping' => $this->whenLoaded('shipping')
        ];
    }
}
