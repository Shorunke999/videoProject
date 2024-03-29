<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use EdwardMuss\Rave\Facades\Rave as Flutterwave;

class authTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_if_authUser_endpoint_works(): void
    {
        $user = $this->newUser();
        $response = $this->post('/authUser',[
            'email' => $user->email,
            'password' => $user->password
        ]);
        $response->assertStatus(200);
        //$response->assertStatus(302);
    }
    public function test_if_homePage(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    public function test_if_get_authuser_works(){
        $user = $this->newUser();
       //dd($user);
       $response = $this->actingAs($user)->get('/authUser');
       $response->assertStatus(200);
    }
    public function test_if_created_middleware_works(){
        $user = $this->newUser();
        $response= $this->actingAs($user)->get('/api/getVideo');
        $response->assertStatus(200);
    }
    /*public function test_flutterwaveEndpoint(){
        $request =    [
            "amount"=> "The amount required to be charged. (*)",
            "currency"=> "The currency to charge in. (*)",
            "first_name"=> "The first name of the customer. (*)",
            "last_name" => "The last name of the customer. (*)",
            "email"=> "The customers email address. (*)",
            "phone_number"=> "The customer's phone number. (Optional).",
            "success_url"=> "The url to redirect customer to after successful payment.",
            "failure_url"=> "The url to redirect customer to after a failed payment.",
            "tx_ref"=>"The unique transaction identifier. if ommited the apiclient would generate one"
        ];
       $response = $this->post('/api/flutter',$request);
        $response->assertStatus(200);
       $response->assertSee('redirect_url');
    }*/
    public function test_flutter_api_endpoint(){
        // Enter the details of the payment
        //$user = $this->newUser();
        //$response = $this->actingAs($user)->post('api/flutter',['Amount'=>300]);
        //$payment = 
        //dd($payment = Flutterwave::initializePayment($data))
        //$response->assertStatus(200);
    }
    private function newUser(){
        $user =  User::factory()->create();
        return $user;
    }
}
