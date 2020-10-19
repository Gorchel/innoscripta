<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->call('POST','/api/auth/login', [
            'name' => 'Test',
            'email' => 'test@test.com',
        ]);

        $response->assertStatus(401);

        $response = $this->call('POST','/api/auth/login', [
            'name' => 'Test1',
            'email' => 'test1@test.com',
            'password' => 123456789,
            'password_confirmation' => 123456789,
        ]);

        $response->assertStatus(200);
    }
}
