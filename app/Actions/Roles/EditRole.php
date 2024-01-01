<?php

namespace App\Actions\Roles;

use Inertia\Inertia;
use Lorisleiva\Actions\Concerns\AsAction;
use Request;
use Spatie\Permission\Models\Role;

class EditRole
{
    use AsAction;

    public function authorize(\Illuminate\Http\Request $request): bool
    {
        return $request->user()->can('roles.update');
    }

    public function handle(int $id): array
    {
        return array_merge(FormatPermissionsForTable::run(), [
            'role' => Role::with('permissions:name')->find($id),
        ]);
    }

    public function asController(Request $request, int $id): \Inertia\Response
    {
        return Inertia::render('Admin/Roles/Edit', $this->handle($id));
    }
}
