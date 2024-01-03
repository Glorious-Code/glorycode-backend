<?php

namespace App\Actions\Users;

use App\Actions\Roles\SearchRoles;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Lorisleiva\Actions\Concerns\AsAction;

class EditUser
{
    use AsAction;

    public function authorize(Request $request): bool
    {
        return $request->user()->can('users.update');
    }

    public function handle(int $id, array $data): array
    {
        return [
            'user' => User::with('roles:id,name')->find($id),
            'roles' => SearchRoles::run($data),
        ];
    }

    public function asController(Request $request, int $id): \Inertia\Response
    {
        $data = $this->handle($id, [
            'key' => $request->get('key'),
            'value' => $request->get('value'),
            'operator' => $request->get('operator'),
            'select' => ['id', 'name'],
        ]);

        if ($request->isMethod('post')) {
            $roles = $request->input('roles', []);

            $data = array_merge($data, [
                'input' => [
                    'name' => $request->input('name', ''),
                    'email' => $request->input('email', ''),
                    'password' => $request->input('password', ''),
                    'password_confirmation' => $request->input('password_confirmation', ''),
                    'roles' => $roles,
                ],
            ]);
        }

        return Inertia::render('Admin/Users/Edit', $data);
    }
}
