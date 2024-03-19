<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class authTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_if_authUser_endpoint_works(): void
    {
        $response = $this->post('/authUser',[
            'email' => 'new@gmail.com',
            'password' => 'ghjkl'
        ]);
        $response->assertStatus(200);
    }
    public function test_if_homePage(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    public function test_if_get_authuser_works(){
       $user = User::factory()->create();
       //dd($user);
       $response = $this->actingAs($user)->get('/authUser');
       $response->assertStatus(200);
    }
}
