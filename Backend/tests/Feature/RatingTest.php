<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Book;
use App\Models\Category;
use App\Models\Rating;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RatingTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $book;

    protected function setUp(): void
    {
        parent::setUp();


        $category = Category::create([
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
            'category_id' => $category->id,
        ]);


        $this->user = User::factory()->create([
            'email_verified_at' => now()
        ]);
    }

    public function test_get_all_ratings(): void
    {

        Rating::create([
            'user_id' => $this->user->id,
            'book_id' => $this->book->id,
            'rating' => 5
        ]);


        $response = $this->get('api/rating');


        $response->assertOk()
                 ->assertJsonCount(1);
    }

    public function test_create_rating(): void
    {

        $this->actingAs($this->user, 'sanctum');


        $ratingData = [
            'user_id' => $this->user->id,
            'book_id' => $this->book->id,
            'rating' => 4
        ];


        $response = $this->post('api/rating', $ratingData);


        $response->assertSuccessful();

        $this->book->refresh();
        $this->assertEquals(4, $this->book->rating);
    }

    public function test_update_existing_rating(): void
    {

             Rating::create([
            'user_id' => $this->user->id,
            'book_id' => $this->book->id,
            'rating' => 3
        ]);


        $this->actingAs($this->user, 'sanctum');


        $updatedRating = [
            'user_id' => $this->user->id,
            'book_id' => $this->book->id,
            'rating' => 5
        ];


        $response = $this->post('api/rating', $updatedRating);


        $response->assertOk();

        $this->assertEquals(1, Rating::count());
        $this->assertEquals(5, Rating::first()->rating);

        $this->book->refresh();
        $this->assertEquals(5, $this->book->rating);
    }

    public function test_get_rating_by_id(): void
{
    $rating = Rating::create([
        'user_id' => $this->user->id,
        'book_id' => $this->book->id,
        'rating' => 4
    ]);
    $this->actingAs($this->user, 'sanctum');

    $response = $this->get('api/rating/'.$rating->id);
    $response->assertOk();
    $responseData = $response->json();
    $this->assertEquals($rating->id, $responseData['data']['id']);
    $this->assertEquals(4, $responseData['data']['rating']);
}
}
