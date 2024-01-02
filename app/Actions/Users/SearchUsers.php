<?php

namespace App\Actions\Users;

use App\Models\User;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class SearchUsers
{
    use AsAction;

    public function handle(string $key, mixed $value, string $operator = '='): array
    {

        if (strtolower($operator) === 'like') {
            $value = "%{$value}%";
        }

        return User::where($key, strtolower($operator), $value)->select(['id', 'name', 'email'])->get()->toArray();
    }

    public function asController(Request $request): array
    {
        $keyAttribute = 'key';
        $valueAttribute = 'value';
        $operatorAttribute = 'operator';

        if (! $request->has($keyAttribute) || ! $request->has($valueAttribute)) {
            return [];
        }

        $operator = '=';

        if ($request->has($operatorAttribute)) {
            $operator = $request->get($operatorAttribute);
        }

        $key = $request->get($keyAttribute);
        $value = $request->get($valueAttribute);

        if (empty($value)) {
            return [];
        }

        return $this->handle($key, $value, $operator);
    }
}
