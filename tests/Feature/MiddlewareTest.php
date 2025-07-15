<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MiddlewareTest extends TestCase
{
    public function test_membership_login_valid(){
        $response = $this->withHeaders(["auth" => "true", "membership" => "true"])
                        ->get('/movie/1');
        $response->assertSeeText('Movie 1');
    }

    public function test_membership_valid_login_invalid(){
        $response = $this->withHeaders(["membership" => "true"])->get('/movie/1');
        $response->assertRedirect(route('login'));
    }

    public function test_membership_middleware_invalid()
    {
        $response = $this->withHeaders([
            'auth' => 'true',          // agar lolos middleware login
            'membership' => 'false',   // agar gagal membership
        ])->get('/movie/1');

        // Redirect ke /pricing
        $response->assertRedirect(route('pricing'));

        // Follow redirect dan cek kontennya
        $followed = $this->get($response->headers->get('Location'));

        $followed->assertSeeText('Please, buy a membership');
    }

    public function testRoleAdmin(){
        $response = $this->withHeaders(["role" => "admin"])
                        ->get('/admin/dashboard');

        $response->assertSeeText('Movie')
                ->assertSeeText('sold');
    }

    public function testRoleUser(){
        $response = $this->withHeaders(["role" => "user"])
                        ->get('/admin/dashboard');

        $response->assertRedirect(route('admin.login'));
    }

}
