<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable=['title','author','isbn','publish_date','price','describe','cover_image','views','rating'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_category','book_id', 'category_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function raters()
{
    return $this->hasManyThrough(User::class, Rating::class, 'book_id', 'id', 'id', 'user_id');
}

    public function averageRating()
{
     $avarage=$this->ratings()->avg('rating');
        return round($avarage,1);
}

public function comments()
{
    return $this->hasMany(Comment::class,'book_id');
}

public function getRatingStats()
{
    return [
        'average' => $this->averageRating(),
        'total_ratings' => $this->ratings()->count(),
        'distribution' => [
            5 => $this->ratings()->where('rating', 5)->count(),
            4 => $this->ratings()->where('rating', 4)->count(),
            3 => $this->ratings()->where('rating', 3)->count(),
            2 => $this->ratings()->where('rating', 2)->count(),
            1 => $this->ratings()->where('rating', 1)->count(),
        ]
    ];
}
}
