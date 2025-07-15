<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{

    public function testRoute()
    {
        $response = $this->get('/hello');
        $response->assertSeeText('Halo Dunia');
    }

    public function testRouteParameterGet(){
        $response = $this->get('/movie/1');
        $response->assertSeeText('2001');
    }

    public function testRouteParameterPut()
    {
        $response = $this->put('/movie/1', [
            'title' => 'Test',
            'year' => '2001',
            'genre' => 'Animal',
        ]);

        $response->assertSeeText('Test')
                ->assertDontSeeText('Movie 1')
                ->assertSeeText('Animal');
    }

    public function testRouteParameterPatch()
    {
        $response = $this->patch('/movie/2', [
            'title' => 'Test',
            'year' => '2002',
        ]);

        $response->assertSeeText('Test')
        ->assertDontSeeText('Movie 2')
        ->assertSeeText('2002');
    }

    public function testRouteParameterDelete(){
        $response = $this->delete('/movie/2');
        $response->assertDontSeeText('Movie 2');
    }
}
