<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentModelTest extends TestCase
{
    use RefreshDatabase;

    private $payment;
    private $paymentMethod;
    private $order;
    private $user;
    public function setUp():void{
        parent::setUp();

        $this->user = User::create([
            'Username' => 'Test User',
            'email' => '',
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
            'reference_id' => 'v3213123',
        ]);

        $this->paymentMethod = PaymentMethod::create([
            'MethodName' => 'Test Payment Method'
        ]);
        $this->payment = Payment::create([
            'order_id' => $this->order->id,
            'paymentmethod_id' => $this->paymentMethod->id,
            'PaymentDate' => '2022-01-01'
        ]);




    }

    public function test_fillable_tables():void{

        $this->assertEquals([
            'order_id',
            'paymentmethod_id',
           'PaymentDate',
        ], $this->payment->getFillable());
    }


    public function test_payment_belongs_to_order(){
        $this->assertInstanceOf(Order::class, $this->payment->order);
    }

    public function test_payment_belongs_to_payment_method(){
        $this->assertInstanceOf(PaymentMethod::class, $this->payment->paymentMethod);
    }
}
