<?php

namespace Tests\Unit;

use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Shipping;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderModelTest extends TestCase
{
   use RefreshDatabase;

    private $order;
    private $orderItem;
    private $user;
    private $payments;
    private $book;
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

        $this->order = Order::create
        ([
            'user_id' => $this->user->id,
            'OrderDate' => '2022-01-01',
            'Status' => 'pending',
            'TotalAmount' => 1000,
           'reference_id' => 'v3213123',
        ]);



    }

    public function test_fillable_tables():void{

        $this->assertEquals([
            'user_id',
            'OrderDate',
            'Status',
            'TotalAmount',
           'reference_id',
        ], $this->order->getFillable());
    }

    public function test_order_belongs_to_user(){
        $this->assertInstanceOf(User::class, $this->order->user);
    }


    public function test_order_has_many_order_items(){
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->order->orderItems);
    }

    public function test_order_has_many_payments(){
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->order->payments);
    }

    public function test_order_has_one_shipping(){
        $shipping = \App\Models\Shipping::create([
            'order_id' => $this->order->id,
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '1234567890',
            'address' => 'Test Address',
            'method' => 'home',
            'fee' => 500
        ]);
        $this->order->refresh();

        $this->assertInstanceOf(\App\Models\Shipping::class, $this->order->shipping);
    }

}
