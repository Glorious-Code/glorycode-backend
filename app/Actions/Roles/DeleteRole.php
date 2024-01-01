<?php

namespace App\Actions\Roles;

use App\Models\MessageType;
use Illuminate\Http\Request;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Session;
use Spatie\Permission\Models\Role;

class DeleteRole
{
    use AsAction;

    public function authorize(Request $request): bool
    {
        return $request->user()->can('roles.delete');
    }

    public function handle($id): ?bool
    {
        $role = Role::findById($id);

        $deleted = $role->delete();

        $message = "Role with name \"$role->name\" has been deleted.";
        $type = MessageType::SUCCESS;

        if (! $deleted) {
            $message = "Could not delete role with name \"$role->name\".";
            $type = MessageType::ERROR;
        }

        Session::flash('message', $message);
        Session::flash('message_type', $type->value);

        return $deleted;
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
