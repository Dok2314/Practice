<?php

namespace Tests\Feature\GraphQL\Mutations;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UploadTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::find(10);

        $operations = [
            'query' => /** @lang GraphQL */ '
                mutation ($file: Upload!) {
                    upload(file: $file)
                    {id, name, url}
                }
            ',
            'variables' => [
                'file' => null,
            ],
        ];

        $map = [
            '0' => ['variables.file'],
        ];

        $file = [
            '0' => UploadedFile::fake()->create('image.jpg', 500),
        ];

        $response = $this->multipartGraphQL($operations, $map, $file);

        $upload = $response->json('data.upload');

        $this->assertNotEmpty($upload['id']);
        $this->assertNotEmpty($upload['name']);
        $this->assertNotEmpty($upload['url']);
    }
}
