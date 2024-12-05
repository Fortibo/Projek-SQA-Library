<?php

namespace Tests\Unit;

use Tests\TestCase;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
class SimpleRouteTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    // Testing for route
    public function test_for_simple_get_route_without_data_just_user(): void
    {
        $user = User::create([
            'name' => "user",
            'email' => "user@gmail.com",
            'password' => bcrypt("password"), 
        ]);
        $this->actingAs($user);
        $this->assertTrue(true);
        // artinya kita get routenya, status 200 berarti ok, 404 itu not found
        $home = $this->get('/')->assertStatus(302);
        dump("route '/' berhasil" . $home->getstatusCode());

        $response =  $this->get('/signup')->assertStatus(302);
        dump("route '/signup' berhasil (redirect) : " . $response->getstatusCode());
        $response->assertRedirect(route('login'));
        dump("route '/signup' berhasil redirect ke login");
        $response->assertLocation('/');
        dump("route '/signup' berhasil redirect ke login di lokasi /");
    }
}
