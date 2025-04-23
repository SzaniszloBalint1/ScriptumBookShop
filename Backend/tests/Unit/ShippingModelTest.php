<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\Shipping;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShippingModelTest extends TestCase
{
  use RefreshDatabase;

    private $shipping;
    private $order;
    private $user;

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

        $this->order = Order::create([
            'user_id' => $this->user->id,
            'OrderDate' => '2022-01-01',
            'Status' => 'pending',
            'TotalAmount' => 1000,
        ]);

        $this->shipping = Shipping::create([
            'order_id' => $this->order->id,
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '1234567890',
            'address' => 'Test Address',
            'method' => 'home',
            'fee' => 500
        ]);
    }


    public function test_fillable_attributes(){
        $this->assertEquals([  'order_id',
        'name',
        'email',
        'phone',
        'address',
        'method',
        'fee'], $this->shipping->getFillable());
    }

    public function test_shipping_belongs_to_order(){
        $this->assertInstanceOf(Order::class, $this->shipping->order);
    }

    public function test_shipping_has_one_order(){
        $this->assertInstanceOf(Shipping::class, $this->order->shipping);
    }
}
