<?php

namespace Tests\Unit;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookModelTest extends TestCase
{
    use RefreshDatabase;

    private $book;
    private $category;
    private $comment;
    private $rating;
    private $orderItem;
    private $user;
    private $inventory;
    public function setUp():void{
        parent::setUp();
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
        ]);
        $this->user = User::create([
            'Username' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'FullName' => 'Test User',
            'PhoneNumber' => '1234567890',
            'role' => 'user',

        ]);
        $this->comment = $this->book->comments()->create([
            'user_id' => $this->user->id,
            'comment' => 'Test Comment'
        ]);

        $this->rating = $this->book->ratings()->create([
            'user_id' => $this->user->id,
            'rating' => 5
        ]);


    }

    public function test_fillable_tables():void{

        $this->assertEquals([
            'title',
            'author',
            'isbn',
            'publish_date',
            'price',
            'describe',
            'cover_image',
            'views',
            'rating',
        ], $this->book->getFillable());
    }

    public function test_book_model_relations():void{
        $this->assertTrue(method_exists($this->book, 'categories'));
        $this->assertTrue(method_exists($this->book, 'comments'));
        $this->assertTrue(method_exists($this->book, 'ratings'));
        $this->assertTrue(method_exists($this->book, 'orderItems'));
        $this->assertTrue(method_exists($this->book, 'users'));

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\BelongsToMany', $this->book->categories());
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\HasMany', $this->book->comments());
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\HasMany', $this->book->ratings());
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\HasMany', $this->book->orderItems());
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\BelongsToMany', $this->book->users());

    }

  

    public function test_book_get_a_comment():void{
        $this->book->comments()->delete();
        $comment = $this->book->comments()->create([
            'user_id' => $this->user->id,
            'comment' => 'Test Comment'
        ]);
        $this->book->refresh();
        $this->assertEquals($comment->id, $this->book->comments->first()->id);
    }

    public function test_book_get_a_rating():void{
    $newUser = User::create([
        'Username' => 'Another User',
        'email' => 'another@example.com',
        'password' => bcrypt('password'),
        'email_verified_at' => now(),
        'FullName' => 'Another User',
        'PhoneNumber' => '9876543210',
        'role' => 'user',
    ]);

    $rating = $this->book->ratings()->create([
        'user_id' => $newUser->id,
        'rating' => 4
    ]);
    $this->book->refresh();
    $this->assertTrue($this->book->ratings->contains('id', $rating->id));

    }


}
