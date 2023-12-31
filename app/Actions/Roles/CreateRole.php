<?php

namespace App\Actions\Roles;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateRole
{
    use AsAction;

    public function handle()
    {
        // TODO: Get Users and Permissions
    }

    public function asController(Request $request): \Inertia\Response
    {
        return Inertia::render('Admin/Roles/Create');
    }
}
