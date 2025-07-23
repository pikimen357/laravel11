<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function testCreate(){
        $response = $this->post('/categories', [
            'title' => 'Test 1',
        ]);

        $response->assertStatus(200)
            ->assertSeeText('1');

        $this->get('/categories')->assertSeeText('Test 1');

    }

    public function testUpdate(){
        $this->testCreate();
        $this->put('/categories/1', [
            'title' => 'Test 2',
        ]);

        $this->get('/categories')->assertSeeText('Test 2')
                        ->assertDontSeeText('Test 1');
    }

    public function testDelete(){
        $this->testCreate();
        $this->delete('/categories/1');

        $this->get('/categories')->assertDontSeeText('Test 1');
    }
}
