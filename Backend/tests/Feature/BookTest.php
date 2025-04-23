<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Pail\ValueObjects\Origin\Console;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_books_with_categories(): void
    {
        $category=Category::create([
            'CategoryName' => 'Test Category',
        ]);
        Book::create([
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

        $response = $this->get('api/books');

        $response->assertOk();

    }

    public function test_get_a_book(): void
    {
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

        $response = $this->get('api/books/'.$book->id);

        $response->assertOk();
    }


    public function test_create_a_book():void{

        $category=Category::create([
            'CategoryName' => 'Test Category',
        ]);
        $response = $this->post('api/books',[
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

        $response->assertCreated();
    }

    public function test_update_a_book():void{
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
        $response = $this->put('api/books/'.$book->id,[
            'title' => 'Test Book Updated',
            'author' => 'Test Author Updated',
            'isbn' => '7890076306155',
            'publish_date' => '2021-10-10',
            'describe' => 'Test Description Updated',
            'price' => 100,
            'describe' => 'Test Description Updated',
            'cover_image' => 'test.jpg',
            'category_id' => $category->id,
        ]);

        $response->assertSuccessful();
    }

    public function test_delete_a_book():void{
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

        $response = $this->delete('api/books/'.$book->id);

        $response->assertSuccessful();
    }

    public function test_increment_views():void{
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

        $response = $this->post('api/books/'.$book->id.'/view');

        $response->assertOk();
    }

    public function test_most_viewed_books_returns_in_correct_order():void{
        $category = Category::create(['CategoryName' => 'Test Category']);

        $mostViewed = Book::create([
            'title' => 'Most Viewed Book',
            'author' => 'Test Author',
            'isbn' => '7890076306114',
            'publish_date' => '2021-10-10',
            'describe' => 'Test Description',
            'price' => 100,
            'cover_image' => 'test.jpg',
            'views' => 20,
            'category_id' => $category->id,
        ]);

        $midViewed = Book::create([
            'title' => 'Mid Viewed Book',
            'author' => 'Test Author',
            'isbn' => '7890076306115',
            'publish_date' => '2021-10-10',
            'describe' => 'Test Description',
            'price' => 100,
            'cover_image' => 'test.jpg',
            'views' => 10,
            'category_id' => $category->id,
        ]);

        $leastViewed = Book::create([
            'title' => 'Least Viewed Book',
            'author' => 'Test Author',
            'isbn' => '7890076306116',
            'publish_date' => '2021-10-10',
            'describe' => 'Test Description',
            'price' => 100,
            'cover_image' => 'test.jpg',
            'views' => 5,
            'category_id' => $category->id,
        ]);

        $response = $this->get('api/books/most-viewed');

        $response->assertOk();

        $responseData = $response->json('data');


        $this->assertEquals($mostViewed->id, $responseData[0]['id']);

        $this->assertEquals([
            $mostViewed->id,
            $midViewed->id,
            $leastViewed->id
        ], collect($responseData)->pluck('id')->toArray());
    }

    public function test_oldest_book():void{
        $category=Category::create([
            'CategoryName' => 'Test Category',
        ]);

        $oldestbook=Book::create([
            'title' => 'Oldest Book',
            'author' => 'Test Author',
            'isbn' => '7890076306114',
            'publish_date' => '2021-10-10',
            'describe' => 'Test Description',
            'price' => 100,
            'cover_image' => 'test.jpg',
            'category_id' => $category->id,
        ]);

        $newestbook=Book::create([
            'title' => 'Newest Book',
            'author' => 'Test Author',
            'isbn' => '7890076306115',
            'publish_date' => '2021-10-11',
            'describe' => 'Test Description',
            'price' => 100,
            'cover_image' => 'test.jpg',
            'category_id' => $category->id,
        ]);

        $response = $this->get('api/books/oldest-books');

        $response->assertOk();

        $responseData = $response->json('data');

        $this->assertEquals($oldestbook->id, $responseData[0]['id']);

        $this->assertEquals([
            $oldestbook->id,
            $newestbook->id,
        ], collect($responseData)->pluck('id')->toArray());

    }


    public function test_newest_book():void{
        $category=Category::create([
            'CategoryName' => 'Test Category',
        ]);

        $oldestbook=Book::create([
            'title' => 'Oldest Book',
            'author' => 'Test Author',
            'isbn' => '7890076306114',
            'publish_date' => '2021-10-10',
            'describe' => 'Test Description',
            'price' => 100,
            'cover_image' => 'test.jpg',
            'category_id' => $category->id,
        ]);

        $newestbook=Book::create([
            'title' => 'Newest Book',
            'author' => 'Test Author',
            'isbn' => '7890076306115',
            'publish_date' => '2021-10-11',
            'describe' => 'Test Description',
            'price' => 100,
            'cover_image' => 'test.jpg',
            'category_id' => $category->id,
        ]);

        $response = $this->get('api/books/newest-books');

        $response->assertOk();

        $responseData = $response->json('data');

        $this->assertEquals($newestbook->id, $responseData[0]['id']);

        $this->assertEquals([
            $newestbook->id,
            $oldestbook->id,
        ], collect($responseData)->pluck('id')->toArray());

    }

    public function test_most_liked_books():void{
        $category=Category::create([
            'CategoryName' => 'Test Category',
        ]);

        $mostLikedBook=Book::create([
            'title' => 'Most Liked Book',
            'author' => 'Test Author',
            'isbn' => '7890076306114',
            'publish_date' => '2021-10-10',
            'describe' => 'Test Description',
            'price' => 100,
            'cover_image' => 'test.jpg',
            'rating' => 5,
            'category_id' => $category->id,
        ]);

        $leastLikedBook=Book::create([
            'title' => 'Least Liked Book',
            'author' => 'Test Author',
            'isbn' => '7890076306115',
            'publish_date' => '2021-10-11',
            'describe' => 'Test Description',
            'price' => 100,
            'cover_image' => 'test.jpg',
            'rating' => 1,
            'category_id' => $category->id,
        ]);

        $response = $this->get('api/books/most-liked');

        $response->assertOk();

        $responseData = $response->json('data');

        $this->assertEquals($mostLikedBook->id, $responseData[0]['id']);

        $this->assertEquals([
            $mostLikedBook->id,
            $leastLikedBook->id,
        ], collect($responseData)->pluck('id')->toArray());

    }

    public function test_most_commented_books():void{
        $category=Category::create([
            'CategoryName' => 'Test Category',
        ]);

        $mostCommentedBook=Book::create([
            'title' => 'Most Commented Book',
            'author' => 'Test Author',
            'isbn' => '7890076306114',
            'publish_date' => '2021-10-10',
            'describe' => 'Test Description',
            'price' => 100,
            'cover_image' => 'test.jpg',
            'category_id' => $category->id,
        ]);

        $leastCommentedBook=Book::create([
            'title' => 'Least Commented Book',
            'author' => 'Test Author',
            'isbn' => '7890076306115',
            'publish_date' => '2021-10-11',
            'describe' => 'Test Description',
            'price' => 100,
            'cover_image' => 'test.jpg',
            'category_id' => $category->id,
        ]);

        $mostCommentedBook->comments()->create([
            'user_id' => User::factory()->create()->id,
            'comment' => 'Test Comment',
        ]);

        $leastCommentedBook->comments()->create([
            'user_id' => User::factory()->create()->id,
            'comment' => 'Test Comment',
        ]);

        $response = $this->get('api/books/most-commented');

        $response->assertOk();

        $responseData = $response->json('data');

        $this->assertEquals($mostCommentedBook->id, $responseData[0]['id']);

        $this->assertEquals([
            $mostCommentedBook->id,
            $leastCommentedBook->id,
        ], collect($responseData)->pluck('id')->toArray());

    }

    public function test_search_books():void{
        $category=Category::create([
            'CategoryName' => 'Test Category',
        ]);

        $book1=Book::create([
            'title' => 'Test Book 1',
            'author' => 'Test Author',
            'isbn' => '7890076306114',
            'publish_date' => '2021-10-10',
            'describe' => 'Test Description',
            'price' => 100,
            'cover_image' => 'test.jpg',
            'category_id' => $category->id,
        ]);


        $response = $this->get('api/books/search/Test Book 1');

        $response->assertOk();

        $responseData = $response->json('data');

        $this->assertEquals($book1->id, $responseData[0]['id']);

        $this->assertEquals([
            $book1->id,
        ], collect($responseData)->pluck('id')->toArray());

    }

    public function test_get_books_by_author():void{
        $category=Category::create([
            'CategoryName' => 'Test Category',
        ]);

        $book1=Book::create([
            'title' => 'Test Book 1',
            'author' => 'Test Author 1',
            'isbn' => '7890076306114',
            'publish_date' => '2021-10-10',
            'describe' => 'Test Description',
            'price' => 100,
            'cover_image' => 'test.jpg',
            'category_id' => $category->id,
        ]);

        $response = $this->get('api/books/author/Test Author 1');

        $response->assertOk();

        $responseData = $response->json('data');

        $this->assertEquals($book1->id, $responseData[0]['id']);

        $this->assertEquals([
            $book1->id,
        ], collect($responseData)->pluck('id')->toArray());
    }
}
