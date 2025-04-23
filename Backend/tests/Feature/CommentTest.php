<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_comments():void
    {
        $user=User::factory()->create([
            'email'=>'test@example.com',
            'password'=>bcrypt('password')
        ]);

        $this->actingAs($user, 'sanctum');

        $response = $this->get('api/comments');

        $response->assertOk();
    }

    public function test_get_a_comment():void
    {
        $user=User::factory()->create([
            'email'=>'test@example.com',
            'password'=>bcrypt('password')
        ]);

        $this->actingAs($user, 'sanctum');

        $category=Category::create([
            'CategoryName' => 'Test Category',
        ]);
        $book=Book::create([
            'title' => 'Test Book',
            'author' => 'Test Author',
            'isbn' => '7890076306114',
            'publish_date' => '2021-10-10',
            'describe' => 'Test Description',
            'price' => 100,
            'describe' => 'Test Description',
            'cover_image' => 'test.jpg',
            'category_id' => $category->id,
        ]);

        $comment=Comment::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'comment' => 'Test Comment',
        ]);
        $response = $this->get('api/comments/'.$comment->id);

        $response->assertOk();
    }

    public function test_create_a_comment():void{
        $user=User::factory()->create([
            'email'=>'test@example.com',
            'password'=>bcrypt('password')
        ]);

        $this->actingAs($user, 'sanctum');

        $category=Category::create([
            'CategoryName' => 'Test Category',
        ]);

        $book=Book::create([
            'title' => 'Test Book',
            'author' => 'Test Author',
            'isbn' => '7890076306114',
            'publish_date' => '2021-10-10',
            'describe' => 'Test Description',
            'price' => 100,
            'describe' => 'Test Description',
            'cover_image' => 'test.jpg',
            'category_id' => $category->id,
        ]);

        $response=$this->post('api/comments',[
            'user_id'=>$user->id,
            'book_id'=>$book->id,
            'comment'=>'Test Comment'
        ]);

        $response->assertSuccessful();

    }

    public function test_update_a_comment():void{
        $user=User::factory()->create([
            'email'=>'test@example.com',
            'password'=>bcrypt('password')
        ]);

        $this->actingAs($user, 'sanctum');

        $category=Category::create([
            'CategoryName' => 'Test Category',
        ]);

        $book=Book::create([
            'title' => 'Test Book',
            'author' => 'Test Author',
            'isbn' => '7890076306114',
            'publish_date' => '2021-10-10',
            'describe' => 'Test Description',
            'price' => 100,
            'describe' => 'Test Description',
            'cover_image' => 'test.jpg',
            'category_id' => $category->id,
        ]);

        $comment=Comment::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'comment' => 'Test Comment',
        ]);

        $response=$this->put('api/comments/'.$comment->id,[
            'user_id'=>$user->id,
            'book_id'=>$book->id,
            'comment'=>'Test Comment Updated'
        ]);

        $response->assertOk();

    }

    public function test_delete_a_comment():void{
        $user=User::factory()->create([
            'email'=>'test@exapmle.com',
            'password'=>bcrypt('password')
        ]);

        $this->actingAs($user, 'sanctum');

        $category=Category::create([
            'CategoryName' => 'Test Category',
        ]);

        $book=Book::create([
            'title' => 'Test Book',
            'author' => 'Test Author',
            'isbn' => '7890076306114',
            'publish_date' => '2021-10-10',
            'describe' => 'Test Description',
            'price' => 100,
            'describe' => 'Test Description',
            'cover_image' => 'test.jpg',
            'category_id' => $category->id,
        ]);

        $comment=Comment::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'comment' => 'Test Comment',
        ]);

        $response=$this->delete('api/comments/'.$comment->id);

        $response->assertSuccessful();
    }
}
