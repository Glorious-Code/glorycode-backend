<?php

namespace App\Actions\Users;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Lorisleiva\Actions\Concerns\AsAction;

class ShowUser
{
    use AsAction;

    public function authorize(Request $request): bool
    {
        return $request->user()->can('users.read');
    }

    public function handle(int $id): array
    {
        return [
            'user' => User::with('roles:id,name')->find($id),
            'roles' => [],
            'editable' => false,
        ];
    }

    public function asController(Request $request, int $id): \Inertia\Response
    {
        $data = $this->handle($id);

        return Inertia::render('Admin/Users/EditOrView', $data);
    }
}
