<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    public function test_get_all_categories():void
    {
        $response = $this->get('api/categories');

        $response->assertOk();
    }

    public function test_get_a_category():void
    {
        $category=Category::create([
            'CategoryName' => 'Test Category',
        ]);
        $response = $this->get('api/categories/'.$category->id);

        $response->assertOk();
    }



}
