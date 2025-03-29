<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'orderitems';
    protected $fillable = [
        'order_id',
        'book_id',
        'Quantity',
        'UnitPrice',
        'BooksTotalPrice'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class,'book_id');
    }
}
