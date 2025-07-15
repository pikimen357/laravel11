<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MovieControllerTest extends TestCase
{
   public function test_index()
   {
       $response = $this->withHeaders(["auth" => "true"])
                        ->get('/movie');
       $response->assertStatus(200)
                ->assertSeeText('Movie 1')
                ->assertSeeText('Raisan');
   }

   public function test_show(){
       $response = $this->withHeaders(["auth" => "true", "membership" => "true"])
                        ->get('/movie/1');
       $response->assertStatus(200)
                ->assertSeeText('Movie 1')
                ->assertSeeText('2001');
   }

   public function test_store(){
       $response = $this->withHeaders(["auth" => "true"])
                        ->post('/movie', [
                            'title' => 'Jurrasic Park',
                            'year' => '2001',
                            'rating' => 4,
                        ]);
       $response->assertSeeText('Jurrasic Park')
                ->assertSeeText(4);
   }

   public function test_update(){
       $response = $this->withHeaders(["auth" => "true"])
                        ->put('/movie/1', [
                            'title' => 'Jurrasic World',
                            'year' => '2001',
                            'rating' => 4,
                        ]);
       $response->assertSeeText('Jurrasic World')
                ->assertSeeText(4)
                ->assertDontSeeText('Movie 1');
   }

   public function test_patch(){
       $response = $this->withHeaders(["auth" => "true"])
                        ->patch('/movie/3', [
                            'title' => 'Conjuring',
                            'rating' => 3,
                        ]);
       $response->assertSeeText('Conjuring')
                ->assertSeeText(3)
                ->assertDontSeeText('Movie 3')
                ->assertSeeText('Raisan');
   }

   public function test_delete(){
       $response = $this->withHeaders(["auth" => "true"])
                        ->delete('/movie/1');
       $response->assertDontSeeText('Movie 1');
   }
}
