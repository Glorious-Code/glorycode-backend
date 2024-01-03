<?php

namespace App\Actions\Users;

use App\Models\MessageType;
use App\Models\User;
use Illuminate\Http\Request;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Session;

class DeleteUser
{
    use AsAction;

    public function authorize(Request $request): bool
    {
        return $request->user()->can('users.delete');
    }

    public function handle($id): ?bool
    {
        $user = User::findOrFail($id);

        $deleted = $user->delete();

        $message = 'User has been deleted';
        $type = MessageType::SUCCESS;

        if (! $deleted) {
            $message = 'Could not delete user.';
            $type = MessageType::ERROR;
        }

        Session::flash('message', $message);
        Session::flash('message_type', $type->value);

        return $deleted;
    }

    public function asController(ActionRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        if (! $this->handle($id)) {
            throw new \Exception('Could not delete user');
        }

        if ($request->has('back') && $request->get('back')) {
            return redirect()->back();
        }

        return redirect()->route('users.index');
    }
}
