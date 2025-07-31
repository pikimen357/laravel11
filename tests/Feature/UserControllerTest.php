<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateUser(){
        $user = User::factory()->create([
                'id' => 3,
                'name' => 'Rizky',
                'email' => 'rizky@gmail.com',

        ]);

        $this->assertDatabaseHas('users',[
                'id' => 3,
                'name' => 'Rizky',
                'email' => 'rizky@gmail.com',
        ]);
    }

    public function testCreateProfile(){

        $this->testCreateUser();

        $response = $this->post('/user/profile/3');
        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
                'name' => 'Rizky',
                'email' => 'rizky@gmail.com',
        ]);

        $this->assertDatabaseHas('profiles', [
            'phone' => '0813547892',
            'address' => 'Jl. Pakisbaru Kismantoro'
        ]);
    }

    public function testGetProfile(){
        $this->testCreateProfile();

        $response = $this->get('/user/profile/3');

        $response->assertSeeText('Rizky')->assertSeeText('rizky@gmail.com')
                ->assertSeeText('phone')->assertSeeText('0813547892')
                ->assertSeeText('address')->assertSeeText('Jl. Pakisbaru Kismantoro');

    }

    public function testUpdateProfile(){
        $this->testCreateProfile();

        $response = $this->put('/user/profile/3');

        $response->assertSeeText('phone')->assertSeeText('082999998')
                ->assertSeeText('address')->assertSeeText('Jl. Antah Brantah')
                ->assertDontSeeText('0813547892')
                ->assertDontSeeText('Jl. Pakisbaru Kismantoro');;
    }

    public function testDeleteProfile(){
        $this->testCreateProfile();

        $this->delete('/user/profile/3');

        $getResponse = $this->get('/user/profile/3');

        $getResponse->assertDontSeeText('phone')->assertDontSeeText('0813547892')
            ->assertDontSeeText('address')->assertDontSeeText('Jl. Pakisbaru Kismantoro')
            ->assertSeeText('Rizky')->assertSeeText('rizky@gmail.com');


    }
}
