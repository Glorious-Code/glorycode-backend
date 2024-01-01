<?php

namespace App\Actions\Roles;

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

    public function handle()
    {
        return FormatPermissionsForTable::run();
    }

    public function asController(Request $request): \Inertia\Response
    {
        return Inertia::render('Admin/Roles/Create', $this->handle());
    }
}
