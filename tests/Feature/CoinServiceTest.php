<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Services\CoinService;

use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class CoinServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_ping()
    {
        $mock = $this->instance(
            CoinService::class,
            Mockery::mock(CoinService::class, function (MockInterface $mock) {
                $mock->shouldReceive('process')->once();
            })
        );

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
