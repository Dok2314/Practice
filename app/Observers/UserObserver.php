<?php

namespace App\Observers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

class UserObserver
{
    public function create(User $user)
    {
        $token = Str::random(80);

        $user->api_token = hash('sha256', $token);
        $user->expired_at = Carbon::now()->addDays(30);
        $user->save();
    }
}
