<?php

namespace App\Actions\Roles;

use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Permission\Models\Role;

class SyncPermissionsToRole
{
    use AsAction;

    public function handle(int $id, array $permissions): void
    {
        $role = Role::findById($id);
        $role->syncPermissions($permissions);
    }
}
