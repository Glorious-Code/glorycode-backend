<?php

namespace App\Actions\Roles;

use Inertia\Inertia;
use Lorisleiva\Actions\Concerns\AsAction;
use Request;
use Spatie\Permission\Models\Role;

class EditRole
{
    use AsAction;

    public function handle(int $id): \Spatie\Permission\Contracts\Role|Role
    {
        return Role::findById($id);
    }

    public function asController(Request $request, int $id): \Inertia\Response
    {
        return Inertia::render('Admin/Roles/Edit', [
            'role' => $this->handle($id),
        ]);
    }
}
