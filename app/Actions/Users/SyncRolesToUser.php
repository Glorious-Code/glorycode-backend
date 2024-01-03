<?php

namespace App\Actions\Users;

use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class SyncRolesToUser
{
    use AsAction;

    public function handle(int $id, array $roles): void
    {
        $user = User::findOrFail($id);
        $user->syncRoles($roles);
    }
}
