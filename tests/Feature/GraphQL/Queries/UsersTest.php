<?php

namespace Tests\Feature\GraphQL\Queries;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->graphQL('
            query {
                users {
                    data {
                        id
                        name
                        email
                        created_at
                    }
                }
            }
        ');

        $res = $response->json('data.users.data');
        $this->assertEquals($res[3]['email'], 'hosea67@example.com');
    }
}
