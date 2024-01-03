<?php

namespace App\Actions\Roles;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Permission\Models\Role;

class ShowRole
{
    use AsAction;

    public function authorize(Request $request): bool
    {
        return $request->user()->can('roles.read');
    }

    public function handle(int $id): array
    {
        return array_merge(FormatPermissionsForTable::run(), [
            'role' => Role::with('permissions:name')->with('users:id,name,email')->find($id),
            'users' => [],
            'editable' => false,
        ]);
    }

    public function asController(Request $request, int $id): \Inertia\Response
    {
        $data = $this->handle($id);

        return Inertia::render('Admin/Roles/EditOrView', $data);
    }
}
