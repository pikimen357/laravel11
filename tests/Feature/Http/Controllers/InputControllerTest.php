<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function test_map_upper(){
        $response = $this->get('/request?name=vidky&city=wonogiri&food=tempeh');

        $response->assertJson([
            'name' => 'VIDKY',
            'city' => 'WONOGIRI',
            'food' => 'TEMPEH'
        ]);

    }

    public function test_input(){
        $response = $this->post('/request', ["name" => "vidky", "city" => "wonogiri"]);
        $response->assertJson([
            'name' => 'vidky',
            'city' => 'wonogiri',
        ]);
    }

    public function test_login_success_with_username_and_password()
    {
        $response = $this->post('/request/login', [
            'username' => 'vidky',
            'password' => 'secret'
        ]);

        $response->assertSeeText('login success');
    }

    public function test_login_success_with_only_username()
    {
        $response = $this->post('/request/login', [
            'username' => 'vidky'
        ]);

        $response->assertSeeText('login success');
    }

    public function test_login_failed_without_credentials()
    {
        $response = $this->post('/request/login', []);

        $response->assertSeeText('login failed');
    }

    public function test_email_missing()
    {
        $response = $this->post('request/miss-email', []); // ganti endpoint sesuai route kamu

        $response->assertSeeText('admin@gmail.com');
    }

    public function test_email_present()
    {
        $response = $this->post('request/miss-email', [
            'email' => 'vidky@example.com'
        ]);

        $response->assertSeeText('vidky@example.com');
    }



}
