<?php

namespace App\Actions\Roles;

use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Permission\Models\Permission;

class FormatPermissionsForTable
{
    use AsAction;

    public function handle(): array
    {
        $permissions = Permission::pluck('name', 'id');

        $subjects = [];
        $actions = [];

        foreach ($permissions as $permission) {
            $name = $permission;

            $seperated = explode('.', $name);

            if (count($seperated) < 2) {
                continue;
            }

            if (! array_key_exists($seperated[0], $subjects)) {
                $subjects[$seperated[0]] = $seperated[0];
            }

            if (! array_key_exists($seperated[1], $actions)) {
                $actions[$seperated[1]] = $seperated[1];
            }
        }

        return [
            'permissions' => $permissions,
            'subjects' => $subjects,
            'actions' => $actions,
        ];
    }
}
