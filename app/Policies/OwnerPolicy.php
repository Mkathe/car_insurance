<?php

namespace App\Policies;

use App\Models\Owner;
use App\Models\User;

class OwnerPolicy
{
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isAdmin()) {
            return true;
        }

        return null;
    }

    public function view(User $user, Owner $owner): bool
    {
        return $owner->user_id === $user->id;
    }

    public function update(User $user, Owner $owner): bool
    {
        return $owner->user_id === $user->id;
    }

    public function delete(User $user, Owner $owner): bool
    {
        return $owner->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return true;
    }
}
