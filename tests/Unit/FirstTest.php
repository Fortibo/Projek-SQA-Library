<?php

namespace Tests\Unit;

use Tests\TestCase;

class FirstTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    // Testing for route
    public function test_example(): void
    {
        // $this->assertTrue(true);
        // artinya kita get routenya, status 200 berarti ok, 404 itu not found
        $this->get('/')->assertStatus(200);
        $this->get('/signup')->assertStatus(200);
        
    }
}
