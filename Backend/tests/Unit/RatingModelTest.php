<?php

namespace Tests\Unit;

use App\Models\Book;
use App\Models\Category;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RatingModelTest extends TestCase
{
   use RefreshDatabase;

    private $rating;
    private $book;
    private $user;
    private $category;

    public function setUp():void{
        parent::setUp();
        $this->user = User::create([
            'Username' => 'Test User',
            'email' => '',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'FullName' => 'Test User',
            'PhoneNumber' => '1234567890',
            'role' => 'user',
        ]);

        $this->category = Category::create([
            'CategoryName' => 'Test Category'
        ]);
        $this->book=Book::create([
            'title' => 'Test Book',
            'author' => 'Test Author',
            'isbn' => '1234567890123',
            'publish_date' => '2022-01-01',
            'price' => 1000,
            'describe' => 'Test Description',
            'cover_image' => 'test.jpg',
            'category_id' => $this->category->id,
        ]);

        $this->rating = Rating::create([
            'user_id' => $this->user->id,
            'book_id' => $this->book->id,
            'rating' => 5
        ]);
    }

    public function test_fillable_attributes(){
        $this->assertEquals(['user_id', 'book_id', 'rating'], $this->rating->getFillable());
    }

    public function test_rating_belongs_to_user(){
        $this->assertInstanceOf(User::class, $this->rating->user);
    }

    public function test_rating_belongs_to_book(){
        $this->assertInstanceOf(Book::class, $this->rating->book);
    }

}
