<?php

namespace Tests\Unit;

use App\Models\PaymentMethod;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentMethodModelTest extends TestCase
{
    use RefreshDatabase;

    private $paymentMethod;

    public function setUp():void{
        parent::setUp();
        $this->paymentMethod = PaymentMethod::create([
            'MethodName' => 'Test Payment Method'
        ]);
    }

    public function test_fillable_attributes(){
        $this->assertEquals(['MethodName'], $this->paymentMethod->getFillable());
    }

    public function test_payment_method_has_many_payment(){
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->paymentMethod->payments);
    }
}
