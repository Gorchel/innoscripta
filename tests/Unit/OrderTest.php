<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Classes\Order\OrderCreator;

class OrderTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $creator = new OrderCreator;
        $response = $creator->make([
            'user_id' => 20,
            'name' => 'test',
            'delivery_id' => 1,
            'goods_ids' => json_encode([1=>2, 3=>4]),
            'total' => 4000,
            'address' => 'Lorem ipsum',
        ]);

        $this->assertSame(200, $response['status']);

        $response = $creator->make([
            'user_id' => null,
            'name' => 'test',
            'delivery_id' => 1,
            'goods_ids' => json_encode([1=>2, 3=>4]),
            'total' => 4000,
            'address' => 'Lorem ipsum',
        ]);

        $this->assertSame(200, $response['status']);

        $response = $creator->make([
            'name' => 'test',
            'goods_ids' => json_encode([1=>2, 3=>4]),
            'total' => 4000,
            'address' => 'Lorem ipsum',
        ]);

        $this->assertSame(400, $response['status']);
    }
}
