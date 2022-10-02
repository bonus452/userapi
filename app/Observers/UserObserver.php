<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserObserver
{
    public function creating(User $user): User
    {
        $user->password = Hash::make($user->password);
        return $user;
    }

    public function updating(User $user): User
    {
        $user->password = Hash::make($user->password);
        return $user;
    }
}
