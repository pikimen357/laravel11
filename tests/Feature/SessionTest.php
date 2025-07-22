<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionTest extends TestCase
{
    public function test_session()
    {
        $response = $this->get('/session/create');

        $response->assertStatus(200)
                 ->assertSeeText('OK');

        $sessionValue = session('is_membership');

//       $this->assertSame('yes', $sessionValue);
       self::assertSame('yes', $sessionValue);
    }

    public function test_session_get(){

        // get session first
        $this->test_session();

        $response = $this->get('/session/get');

        $response->assertStatus(200)
                ->assertSeeText('yes');


    }

    public function test_session_input(){
       $this->get('/session/input?name=farhan&hobby1=coding&hobby2=reading');

        $response = $this->get('/session/get');

        $sessionName = session('name');
        $sessionHobby1 = session('hobbies')[0];
        $sessionHobby2 = session('hobbies')[1];

        self::assertSame('farhan', $sessionName);
        self::assertIsArray(session('hobbies'));
        self::assertSame('coding', $sessionHobby1);
        self::assertSame('reading', $sessionHobby2);

    }

    public function test_session_delete(){
        $this->test_session_input();

        $response = $this->get('/session/forget');

        $sessionName = session('name');

        self::assertNull($sessionName);
        self::assertNotSame('farhan', $sessionName);

    }
}
