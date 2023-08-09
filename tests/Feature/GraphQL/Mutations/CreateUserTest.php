<?php

namespace Tests\Feature\GraphQL\Mutations;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->graphQL('
            mutation {
                createUser(input:{
                    name: "TEST",
                    email: "test@example.com",
                    password: "123456"
                }) {
                    id
                    name
                    email
                    created_at
                }
            }
        ');

        $this->assertEquals($response['data']['createUser']['email'], 'test@example.com');
    }
}
