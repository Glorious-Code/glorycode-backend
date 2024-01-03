<?php

namespace App\Actions\Users;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\MessageType;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use Session;

class UpdateUser
{
    use AsAction;
    use PasswordValidationRules;

    public function authorize(Request $request): bool
    {
        return $request->user()->can('users.create');
    }

    public function rules(): array
    {
        $passwordValidation = collect($this->passwordRules())->map(function ($x) {
            if ($x === 'required') {
                return 'nullable';
            }

            return $x;
        })->toArray();

        return [
            'name' => ['string', 'required'],
            'email' => ['string', 'required', Rule::unique('users')->ignore(request()->route('id'))],
            'password' => $passwordValidation,
            'roles' => ['exists:roles,id'],
        ];
    }

    public function handle(int $id, array $data): bool
    {
        $user = User::findOrFail($id);
        $user->name = $data['name'];
        $user->email = $data['email'];

        if (! empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $created = $user->save();

        $message = 'User has been updated.';
        $type = MessageType::SUCCESS;

        if (! $created) {
            $message = 'User could not be updated.';
            $type = MessageType::ERROR;
        }

        if (array_key_exists('roles', $data)) {
            SyncRolesToUser::run($user->id, $data['roles']);
        }

        Session::flash('message', $message);
        Session::flash('message_type', $type->value);

        return $created;
    }

    public function asController(ActionRequest $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $request->validated();
        $data = $request->all();

        if (! $this->handle($id, $data)) {
            return redirect()->route('users.edit')->withInput($data);
        }

        return redirect()->route('users.index');
    }
}
