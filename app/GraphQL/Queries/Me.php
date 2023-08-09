<?php

namespace App\GraphQL\Queries;

use GraphQL\Error\Error;
use Illuminate\Support\Facades\Auth;

final class Me
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = Auth::guard()->user();

        if(is_null($user)) {
            throw new Error("User unauthenticated.");
        }

        return $user;
    }
}
