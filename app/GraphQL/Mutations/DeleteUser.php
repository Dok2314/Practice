<?php

namespace App\GraphQL\Mutations;

use App\Models\User;

final class DeleteUser
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = User::find($args['id']);
        $status = $user?->delete();

        return [
            "status" => $status == 1 ? "200" : "404",
            "message" => $status == 1 ? "User was successfully deleted!" : "User was not found!"
        ];
    }
}
