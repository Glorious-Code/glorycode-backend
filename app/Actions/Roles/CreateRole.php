<?php

namespace App\Actions\Roles;

use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Session;
use Spatie\Permission\Models\Role;

class CreateRole
{
    use AsAction;

    public function rules(): array
    {
        return [
            'name' => ['string', 'required', Rule::unique('roles')],
        ];
    }

    public function handle(string $name): \Spatie\Permission\Contracts\Role|Role
    {
        $role = Role::create([
            'name' => $name,
        ]);

        Session::flash('success', "Role \"{$role->name}\" has been created.");

        return $role;
    }

    public function asController(ActionRequest $request): RedirectResponse
    {
        $request->validated();
        $data = $request->only('name');

        $this->handle($data['name']);

        return redirect()->route('roles');
    }
}
