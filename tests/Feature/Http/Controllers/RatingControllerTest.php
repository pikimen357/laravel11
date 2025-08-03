<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Rating;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Movie;
use App\Models\Category;

class RatingControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_attach_category_to_movie()
    {
        $movie = Movie::factory()->create();
        $categories = Category::factory()->count(2)->create();

        $response = $this->postJson("/movies/{$movie->id}/categories", [
            'categories' => $categories->pluck('id')->toArray(),
        ]);

        $response->assertStatus(200);
        $this->assertCount(2, $movie->fresh()->categories);
        $response->assertJsonFragment([
            'id' => $categories[0]->id,
        ]);
    }

    public function test_detach_category_from_movie()
    {
        $movie = Movie::factory()->create();
        $categories = Category::factory()->count(2)->create();
        $movie->categories()->attach($categories->pluck('id')->toArray());

        $response = $this->deleteJson("/movies/{$movie->id}/categories", [
            'categories' => [$categories[0]->id],
        ]);

        $response->assertStatus(200);
        $this->assertFalse($movie->fresh()->categories->contains($categories[0]->id));
        $this->assertTrue($movie->fresh()->categories->contains($categories[1]->id));
    }

    public function test_can_create_rating()
    {
        $user = User::factory()->create();
        $movie = Movie::factory()->create();

        $response = $this->postJson('/ratings', [
            'user_id' => $user->id,
            'movie_id' => $movie->id,
            'rating' => 4,
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'user_id' => $user->id,
                'movie_id' => $movie->id,
                'rating' => 4,
            ]);

        $this->assertDatabaseHas('ratings', [
            'user_id' => $user->id,
            'movie_id' => $movie->id,
            'rating' => 4,
        ]);
    }

    public function test_get_ratings_by_movie_id()
    {
        $movie = Movie::factory()->create();
        $user = User::factory()->create();

        Rating::factory()->count(4)->create([
            'movie_id' => $movie->id,
            'user_id' => $user->id,
            'rating' => "4",
        ]);

        $response = $this->getJson("/ratings/{$movie->id}");

        $response->assertStatus(200)
            ->assertJsonFragment([
                "id film" => $movie->id,
                "Judul Film" => $movie->title,
            ])
            ->assertJsonCount(4, 'rating');
    }

}
