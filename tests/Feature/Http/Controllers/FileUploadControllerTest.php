<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FileUploadControllerTest extends TestCase
{
    public function testUploadImage()
    {
        // Fake the "public" disk so no real files are written
        Storage::fake('public');

        // Create a fake image file
        $img = UploadedFile::fake()->image('kera.png');

        // Send a POST request with the fake image
        $response = $this->post('/upload/picture', [
            'picture' => $img
        ]);

        // Assert that the image was stored in the correct path
        Storage::disk('public')->assertExists('pictures/' . $img->getClientOriginalName());

        // Assert the response contains the upload success message
        $response->assertSee('Upload success');

        // Assert the <img> tag is present (not checking full HTML, just the tag)
        $response->assertSee('<img', false); // false = do not escape HTML

        // Assert the uploaded file name appears in the response
        $response->assertSee($img->getClientOriginalName());
    }

}
