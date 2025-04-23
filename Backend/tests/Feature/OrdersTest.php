<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentMethod;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrdersTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $adminUser;
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
            'email_verified_at' => now(),
            'role' => 'user'
        ]);


        $this->adminUser = User::factory()->create([
            'email_verified_at' => now(),
            'role' => 'admin'
        ]);


        PaymentMethod::create([
            'MethodName' => 'Bankkártya',
            'Description' => 'Fizetés bankkártyával'
        ]);
    }

    public function test_get_all_orders(): void
    {
        $order = Order::create([
            'user_id' => $this->user->id,
            'OrderDate' => now(),
            'Status' => 'Pending',
            'TotalAmount' => 1000,
        ]);
        $this->actingAs($this->user, 'sanctum');

        $response = $this->get('api/orders');

        $response->assertOk()
                 ->assertJsonStructure(['data'])
                 ->assertJsonCount(1, 'data');
    }

    public function test_create_an_order(): void
{

    $this->actingAs($this->user, 'sanctum');


    $orderData = [
        'items' => [
            [
                'book_id' => $this->book->id,
                'quantity' => 2,
                'price' => $this->book->price,
                'books_total_price' => $this->book->price * 2
            ]
        ],
        'shipping' => [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '1234567890',
            'address' => 'Test Address',
            'method' => 'home',
            'fee' => 500
        ],
        'payment_method' => 'Bankkártya',
        'total_amount' => 2500
    ];
    $response = $this->post('api/orders', $orderData);
    $response->assertCreated();
}

public function test_delete_an_order(): void
{

    $order = Order::create([
        'user_id' => $this->user->id,
        'OrderDate' => now(),
        'Status' => 'Pending',
        'TotalAmount' => 1000,
    ]);


    $orderItem = OrderItem::create([
        'order_id' => $order->id,
        'book_id' => $this->book->id,
        'Quantity' => 1,
        'UnitPrice' => 1000,
        'BooksTotalPrice' => 1000
    ]);

    $this->actingAs($this->adminUser, 'sanctum');
    $response = $this->delete('api/orders/'.$orderItem->id);

    $response->assertStatus(200);
}

    public function test_non_admin_cannot_delete_order(): void
    {

        $order = Order::create([
            'user_id' => $this->user->id,
            'OrderDate' => now(),
            'Status' => 'Pending',
            'TotalAmount' => 1000,
        ]);

        $this->actingAs($this->user, 'sanctum');

        $response = $this->delete('api/orders/'.$order->id);

        $response->assertForbidden();
    }
}
