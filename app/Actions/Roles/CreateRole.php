<?php

namespace App\Actions\Roles;

use App\Actions\Users\SearchUsers;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateRole
{
    use AsAction;

    public function authorize(Request $request): bool
    {
        return $request->user()->can('roles.create');
    }

    public function handle(array $data): array
    {
        $result = FormatPermissionsForTable::run();

        return array_merge($result, [
            'users' => SearchUsers::run($data),
        ]);
    }

    public function asController(Request $request): \Inertia\Response
    {
        $data = $this->handle([
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

        return Inertia::render('Admin/Roles/Create', $data);
    }
}
