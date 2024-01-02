<?php

namespace App\Actions\Roles;

use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Permission\Models\Role;

class SyncUsersToRole
{
    use AsAction;

    public function handle(int $id, array $users): void
    {
        $role = Role::findById($id);
        $role->users()->sync($users);
    }
}
