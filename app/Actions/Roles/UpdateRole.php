<?php

namespace App\Actions\Roles;

use App\Models\MessageType;
use Illuminate\Validation\Rule;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Session;
use Spatie\Permission\Models\Role;

class UpdateRole
{
    use AsAction;

    public function rules(): array
    {
        return [
            'name' => ['string', 'required', Rule::unique('roles')->ignore(request()->route('id'))],
        ];
    }

    public function handle($id, $name): bool
    {
        $role = Role::findById($id);
        $role->name = $name;
        $updated = $role->save();

        $message = "Role with id \"$role->id\" has been updated.";
        $type = MessageType::SUCCESS;

        if (! $updated) {
            $message = "Could not update role with id \"$role->id\".";
            $type = MessageType::ERROR;
        }

        Session::flash('message', $message);
        Session::flash('message_type', $type->value);

        return $updated;
    }

    public function asController(ActionRequest $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $request->validated();
        $data = $request->only('name');

        if (! $this->handle($id, $data['name'])) {
            return redirect()->route('roles.update', $id)->withInput($request->all());
        }

        return redirect()->route('roles.index');
    }
}
