<?php

namespace App\Actions\Roles;

use App\Models\MessageType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Session;
use Spatie\Permission\Models\Role;

class UpdateRole
{
    use AsAction;

    public function authorize(Request $request): bool
    {
        return $request->user()->can('roles.update');
    }

    public function rules(): array
    {
        return [
            'name' => ['string', 'required', Rule::unique('roles')->ignore(request()->route('id'))],
            'permissions' => ['exists:permissions,name'],
            'users.*' => ['exists:users'],
        ];
    }

    public function handle($id, $name, $permissions, $users): bool
    {
        $role = Role::findById($id);
        $role->name = $name;
        $updated = $role->save();

        SyncPermissionsToRole::run($id, $permissions);
        SyncUsersToRole::run($id, $users);

        $message = 'Role has been updated.';
        $type = MessageType::SUCCESS;

        if (! $updated) {
            $message = 'Could not update role.';
            $type = MessageType::ERROR;
        }

        Session::flash('message', $message);
        Session::flash('message_type', $type->value);

        return $updated;
    }

    public function asController(ActionRequest $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $request->validated();
        $name = $request->get('name');
        $permissions = $request->get('permissions') ?? [];
        $users = $request->get('users') ?? [];

        if (! $this->handle($id, $name, $permissions, $users)) {
            return redirect()->route('roles.update', $id)->withInput($request->all());
        }

        return redirect()->route('roles.index');
    }
}
