<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileStorageTest extends TestCase
{
    public function testStorage(){
        $filesystem = Storage::disk('local');

        $filesystem->put('sayHello.txt', 'Hello from village');

        $content = $filesystem->get('sayHello.txt');
        self::assertEquals('Hello from village', $content);
    }
    public function testPublic(){
        $filesystem = Storage::disk('public');

        $filesystem->put('sayHello.txt', 'Hello from village');

        $content = $filesystem->get('sayHello.txt');
        self::assertEquals('Hello from village', $content);
    }


}
