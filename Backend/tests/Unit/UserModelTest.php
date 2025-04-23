<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp():void{
        parent::setUp();
        $this->user =User::create([
            'Username' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'FullName' => 'Test User',
            'PhoneNumber' => '1234567890',
            'role' => 'user',
        ]);
    }

    public function test_fillable_attributes(){
        $this->assertEquals(['Username', 'email', 'password','FullName', 'PhoneNumber', 'role'], $this->user->getFillable());
    }

    public function test_user_belongs_to_many_books(){
        $this->assertInstanceOf(
            \Illuminate\Database\Eloquent\Relations\BelongsToMany::class,
            $this->user->books()
        );
    }

    public function test_user_has_many_ratings(){
        $this->assertInstanceOf(
            \Illuminate\Database\Eloquent\Relations\HasMany::class,
            $this->user->ratings()
        );
    }

    public function test_user_has_many_orders(){
        $this->assertInstanceOf(
            \Illuminate\Database\Eloquent\Relations\HasMany::class,
            $this->user->orders()
        );
    }

    public function test_user_has_many_comments(){
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $this->user->comments()
        );
    }

    
}
