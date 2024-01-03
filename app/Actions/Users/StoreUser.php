<?php

namespace App\Actions\Users;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\MessageType;
use App\Models\User;
use Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Session;

class StoreUser
{
    use AsAction;
    use PasswordValidationRules;

    public function authorize(Request $request): bool
    {
        return $request->user()->can('users.create');
    }

    public function rules(): array
    {
        return [
            'name' => ['string', 'required'],
            'email' => ['string', 'required', Rule::unique('users')],
            'password' => $this->passwordRules(),
            'roles' => ['exists:roles,id'],
        ];
    }

    public function handle($data): bool
    {
        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $created = $user->save();

        $message = 'User has been created.';
        $type = MessageType::SUCCESS;

        if (! $created) {
            $message = 'User could not be created.';
            $type = MessageType::ERROR;
        }

        event(new Registered($user));

        if (array_key_exists('roles', $data)) {
            SyncRolesToUser::run($user->id, $data['roles']);
        }

        Session::flash('message', $message);
        Session::flash('message_type', $type->value);

        return $created;
    }

    public function asController(ActionRequest $request): \Illuminate\Http\RedirectResponse
    {
        $request->validated();
        $data = $request->all();

        if (! $this->handle($data)) {
            return redirect()->route('users.create')->withInput($data);
        }

        return redirect()->route('users.index');
    }
}
