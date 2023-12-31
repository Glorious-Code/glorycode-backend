<?php

namespace App\Actions\Roles;

use App\Models\MessageType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Session;
use Spatie\Permission\Models\Role;

class StoreRole
{
    use AsAction;

    public function rules(): array
    {
        return [
            'name' => ['string', 'required', Rule::unique('roles')],
        ];
    }

    public function handle(string $name): bool
    {
        $role = new Role;
        $role->name = $name;
        $created = $role->save();

        $message = "Role with name \"$role->name\" has been created.";
        $type = MessageType::SUCCESS;

        if (! $created) {
            $message = "Could not create role with name \"$role->name\".";
            $type = MessageType::ERROR;
        }

        Session::flash('message', $message);
        Session::flash('message_type', $type->value);

        return $created;
    }

    public function asController(ActionRequest $request): RedirectResponse
    {
        $request->validated();
        $name = $request->get('name');

        if (! $this->handle($name)) {
            return redirect()->route('roles.create')->withInput($request->all());
        }

        return redirect()->route('roles.index');
    }
}
