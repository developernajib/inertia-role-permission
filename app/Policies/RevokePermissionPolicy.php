<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RevokePermissionPolicy
{
    public function revoke(User $user): bool
    {
        return $user->hasPermission('update.permission');
    }
}