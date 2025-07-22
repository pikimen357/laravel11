<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FileUploadControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    /** @test */
    public function it_returns_error_message_when_no_file_uploaded()
    {
        $response = $this->post('/upload/picture'); // sesuaikan dengan route Anda

        $response->assertStatus(200);
        $response->assertSeeText('please upload a picture');
    }

    /** @test */
    public function it_successfully_uploads_picture_and_returns_success_message()
    {
        $file = UploadedFile::fake()->image('example.jpg');

        $response = $this->post('/upload/picture', [
            'picture' => $file
        ]);

        $response->assertStatus(200);
        $response->assertSeeText('Upload success');
        $response->assertSeeHtml('<img src=');

        // Verify file was stored
        Storage::disk('public')->assertExists('pictures/example.jpg');
    }

    /** @test */
    public function it_uploads_file_and_accessible_via_storage_url()
    {
        $file = UploadedFile::fake()->image('sandal.jpg');

        $response = $this->post('/upload/picture/', [
            'picture' => $file
        ]);

        $response->assertStatus(200);
        $response->assertSeeText('Upload success');

        // Verify file was stored
        Storage::disk('public')->assertExists('pictures/sandal.jpg');

        // Test direct access via storage URL
        $storageResponse = $this->get('/storage/pictures/sandal.jpg');
        $storageResponse->assertStatus(200);
    }

    /** @test */
    public function it_returns_404_when_picture_does_not_exist()
    {
        $response = $this->get(route('picture.show', ['filename' => 'nonexistent.jpg']));

        $response->assertStatus(404);
    }

    /** @test */
    public function it_handles_file_with_special_characters_in_name()
    {
        $file = UploadedFile::fake()->image('test image with spaces.jpg');

        $response = $this->post('/upload/picture', [
            'picture' => $file
        ]);

        $response->assertStatus(200);
        $response->assertSeeText('Upload success');

        // Verify file was stored with original name
        Storage::disk('public')->assertExists('pictures/test image with spaces.jpg');
    }

}
