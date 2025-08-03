<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_register(){
        $response = $this->post('/register', [
            'name' => 'Rizky',
            'email' => 'rizky@gmail.com',
            'password' => 'rizkyganteng123',
            'password_confirmation' => 'rizkyganteng123'
        ]);

        $response->assertStatus(302)
                ->assertRedirect(route('login'))
                ->assertSessionHas('success', 'Signup Berhasil!');

        $this->assertDatabaseHas('users', [
            'name' => 'Rizky',
            'email' => 'rizky@gmail.com',
        ]);

        $user = User::where('email', 'rizky@gmail.com')->first();

        // ensure that passwords are hashed
        $this->assertNotEquals('rizkyganteng123', $user->password);
    }

    public function test_successful_login()
    {
        // register first
        $this->test_register();

        $response = $this->post(route('login'), [
            'email' => 'rizky@gmail.com',
            'password' => 'rizkyganteng123',
        ]);

        $response->assertStatus(302)
            ->assertRedirect(route('dashboard'))
            ->assertSessionHas('success', 'Login Berhasil!');

        $this->assertAuthenticated();
    }

    public function test_failed_login()
    {
        // register first
        $this->test_register();

        $response = $this->post(route('login'), [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(302)
            ->assertSessionHas('error', 'Login Gagal!');

        $this->assertGuest();
    }

    public function test_login_validation_errors()
    {
        $response = $this->post(route('login'), []);

        $response->assertStatus(302)
            ->assertSessionHasErrors(['email', 'password']);

        $this->assertGuest();
    }

    public function test_logout()
    {
        // register and login first
        $this->test_successful_login();

        $response = $this->post(route('logout'));

        $response->assertStatus(302)
            ->assertRedirect(route('login'))
            ->assertSessionHas('success', 'Logout Berhasil!');

        $this->assertGuest();
    }


}
