<?php

namespace App\Actions\Roles;

use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class SyncUsersToRole
{
    use AsAction;

    public function handle(int $id, array $users): void
    {
        foreach ($users as $userId) {
            $user = User::find($userId);
            $user->syncRoles([$id]);
        }
    }
}
