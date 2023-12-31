<?php

namespace App\Actions\Roles;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Permission\Models\Role;

class GetRoles
{
    use AsAction;

    private int $per_page = 15;

    public function handle(int $per_page, ?string $name = null): LengthAwarePaginator
    {
        $roles = Role::with(['users', 'permissions']);

        if (isset($name)) {
            $roles->where('name', 'LIKE', "%{$name}%");
        }

        return $roles->paginate($per_page);
    }

    public function asController(Request $request): \Inertia\Response
    {
        $per_page = $this->per_page;
        $name = null;

        if ($request->has('name')) {
            $name = $request->get('name');
        }

        if ($request->has('per_page')) {
            $per_page = $request->get('per_page');
        }

        $roles = $this->handle($per_page, $name);

        return Inertia::render('Admin/Roles/Index', [
            'roles' => $roles,
            'name' => $name,
        ]);
    }
}
