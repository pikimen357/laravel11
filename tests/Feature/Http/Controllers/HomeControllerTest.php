<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function test_home_admin(){
        $response = $this->get('/home');
        $response->assertSeeText('Rizky')
        ->assertSeeText('admin');
    }

}
