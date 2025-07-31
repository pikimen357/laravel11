<?php

namespace Tests\Feature\Http\Controllers;

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

}
