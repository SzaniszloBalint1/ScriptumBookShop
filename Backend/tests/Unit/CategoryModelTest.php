<?php

namespace Tests\Unit;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryModelTest extends TestCase
{
    use RefreshDatabase;

    private $category;
    private $book;

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
            'category_id' => $this->category->id,
        ]);
    }

    public function test_fillable_attributes(){
        $this->assertEquals(['CategoryName'], $this->category->getFillable());
    }

    public function test_category_has_many_books(){
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->category->books);
    }



}
