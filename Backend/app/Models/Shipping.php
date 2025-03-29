<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $table = 'shipping';

    protected $fillable = [
        'order_id',
        'name',
        'email',
        'phone',
        'address',
        'method',
        'fee'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
