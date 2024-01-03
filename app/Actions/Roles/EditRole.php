<?php

namespace App\Actions\Roles;

use App\Actions\Users\SearchUsers;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Permission\Models\Role;

class EditRole
{
    use AsAction;

    public function authorize(Request $request): bool
    {
        return $request->user()->can('roles.update');
    }

    public function handle(int $id, array $data): array
    {
        return array_merge(FormatPermissionsForTable::run(), [
            'role' => Role::with('permissions:name')->with('users:id,name,email')->find($id),
            'users' => SearchUsers::run($data),
        ]);
    }

    public function asController(Request $request, int $id): \Inertia\Response
    {
        $data = $this->handle($id, [
            'key' => $request->get('key'),
            'value' => $request->get('value'),
            'operator' => $request->get('operator'),
        ]);

        if ($request->isMethod('post')) {
            $permissions = $request->input('permissions', []);
            $users = $request->input('users', []);

            $data = array_merge($data, [
                'input' => [
                    'name' => $request->input('name', ''),
                    'permissions' => $permissions,
                    'users' => $users,
                ],
            ]);
        }

        return Inertia::render('Admin/Roles/Edit', $data);
    }
}
