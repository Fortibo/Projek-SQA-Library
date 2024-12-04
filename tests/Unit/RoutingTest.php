<?php

namespace Tests\Unit;

use Tests\TestCase;

class RoutingTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {

        $this->assertTrue(true);
    }
    public function test_route_user(): void
    {
       $r =  $this->get('/')->assertStatus(200);
    //    dump($r->content());
       
    }
}
