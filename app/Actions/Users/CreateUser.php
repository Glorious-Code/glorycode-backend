<?php

namespace App\Actions\Users;

use App\Actions\Roles\SearchRoles;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateUser
{
    use AsAction;

    public function authorize(Request $request): bool
    {
        return $request->user()->can('users.create');
    }

    public function handle(array $data): array
    {
        return [
            'roles' => SearchRoles::run($data),
        ];
    }

    public function asController(Request $request): \Inertia\Response
    {
        $data = $this->handle([
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

        return Inertia::render('Admin/Users/Create', $data);
    }
}
