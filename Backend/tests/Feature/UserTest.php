<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_have_orders()
    {
        $user = User::create([
            'Username' => 'testuser',
            'email' => 'test@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'FullName' => 'Test User',
            'PhoneNumber' => '1234567890',
            'role' => 'user',
        ]);

        $order1 = Order::create([
            'user_id' => $user->id,
            'OrderDate' => now(),
            'Status' => 'Pending',
            'TotalAmount' => 100,
        ]);

        $order2 = Order::create([
            'user_id' => $user->id,
            'OrderDate' => now(),
            'Status' => 'Completed',
            'TotalAmount' => 200,
        ]);

        $this->assertCount(2, $user->orders);
        $this->assertEquals('Pending', $user->orders[0]->Status);
        $this->assertEquals('Completed', $user->orders[1]->Status);


    }

    public function test_get_all_users():void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum');

        $response = $this->get('api/users');

        $response->assertOk();
    }

    public function test_get_an_user():void{
        $user = User::factory()->create();

        $this->actingAs($user, 'sanctum');

        $response = $this->get('api/user');

        $response->assertOk();
    }

    public function test_login_user():void{
        $user=User::factory()->create([
            'email'=>'test@example.com',
            'password'=>bcrypt('password')
        ]);

        $this->actingAs($user, 'sanctum');

        $response=$this->post('api/login',[
            'email'=>''.$user->email,
            'password'=>'password'
        ]);

        if(!$response){
            $response->assertNotFound();
            if(!$response && !$user){
                $response->assertUnauthorized();
            }
        }

        $response->assertSuccessful();
    }

    public function test_logout_user():void{
        $user=User::factory()->create();

        $this->actingAs($user, 'sanctum');

        $response=$this->post('api/logout');



        $response->assertSuccessful();
    }

    public function test_register_user():void{
        $response=$this->post('api/register',[
            'Username'=>'testuser',
            'email'=>'test@example.com',
            'password'=>'password123',
            'password_confirmation'=>'password123',
            'FullName'=>'Test User',
            'PhoneNumber'=>'+36301234567'
        ]);

        if(!$response){
            $response->assertNotFound();
        }

        $response->assertCreated();
    }

    public function test_update_user():void{
        $user=User::factory()->create();

        $this->actingAs($user, 'sanctum');

        $response=$this->put('api/users/'.$user->id,[
            'username'=>'testuser',
            'email'=>'test@example.com',
            'PhoneNumber'=>'+36301234567'
        ]);

        if(!$response){
            $response->assertNotFound();
        }

        $response->assertOk();
}

    public function test_update_user_role():void{
        $admin=User::factory()->create([
            'role'=>'admin'
        ]);

        $this->actingAs($admin, 'sanctum');

        $user=User::factory()->create();


        $response=$this->put('api/users/'.$user->id.'/role',[
            'role'=>'admin'
        ]);

        if(!$response){
            $response->assertNotFound();
        }

        $response->assertOk();
    }
}
