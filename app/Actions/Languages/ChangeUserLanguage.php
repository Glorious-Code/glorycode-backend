<?php

namespace App\Actions\Languages;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class ChangeUserLanguage
{
    use AsAction;

    public function rules(): array
    {
        return [
            'language' => ['string', 'required'],
        ];
    }

    public function handle(string $language, ?User $user = null): void
    {
        App::setLocale($language);

        if (isset($user)) {
            $user->language = $language;
            $user->save();
        }
    }

    public function asController(ActionRequest $request): RedirectResponse
    {
        $request->validated();

        $data = $request->only('language');

        $this->handle($data['language'], $request->user());

        return redirect()->back();
    }
}
