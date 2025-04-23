<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentModelTest extends TestCase
{
    use RefreshDatabase;

    private $book;
    private $comment;
    private $user;
    private $category;
    public function setUp():void{
        parent::setUp();

        $this->user = User::create([
            'Username' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'FullName' => 'Test User',
            'PhoneNumber' => '1234567890',
            'role' => 'user',
        ]);

        $this->category = Category::create([
            'CategoryName' => 'Test Category'
        ]);

        $this->book = Book::create([
            'title' => 'Test Book',
            'author' => 'Test Author',
            'isbn' => '1234567890123',
            'publish_date' => '2022-01-01',
            'price' => 1000,
            'describe' => 'Test Description',
            'cover_image' => 'test.jpg',
            'category_id' =>$this->category->id,
        ]);



        $this->comment = Comment::create([
            'user_id' => $this->user->id,
            'book_id' => $this->book->id,
            'comment' => 'Test Comment'
        ]);
    }


    public function test_fillable_attributes(){
        $this->assertEquals(['user_id', 'book_id', 'comment'], $this->comment->getFillable());
    }

    public function test_relations():void{
        $this->assertTrue(method_exists($this->comment, 'user'));
        $this->assertTrue(method_exists($this->comment, 'book'));

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\BelongsTo', $this->comment->user());
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\BelongsTo', $this->comment->book());
    }

    public function test_comment_belongs_to_user():void{
        $this->assertEquals($this->user->id, $this->comment->user->id);
    }

    public function test_comment_belongs_to_book():void{
        $this->assertEquals($this->book->id, $this->comment->book->id);
    }

}
