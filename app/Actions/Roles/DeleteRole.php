<?php

namespace App\Actions\Roles;

use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Permission\Models\Role;

class DeleteRole
{
    use AsAction;

    public function handle($id)
    {
        $role = Role::findById($id);

        return $role->delete();
    }

    public function asController(ActionRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        if (! $this->handle($id)) {
            throw new \Exception('Could not delete');
        }

        if ($request->has('back') && $request->get('back')) {
            return redirect()->back();
        }

        return redirect()->route('roles.index');
    }
}
