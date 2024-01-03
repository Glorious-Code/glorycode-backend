<?php

namespace App\Actions\Users;

use App\Models\User;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class SearchUsers
{
    use AsAction;

    public function handle($data): array
    {
        if (! array_key_exists('key', $data) || ! array_key_exists('value', $data)) {
            return [];
        }

        $key = $data['key'];
        $value = $data['value'];

        if (empty($key) || empty($value)) {
            return [];
        }

        $operator = 'like';

        if (array_key_exists('operator', $data)) {
            $operator = $data['operator'];
        }

        if (strtolower($operator) === 'like') {
            $value = "%{$value}%";
        }

        $select = ['*'];

        if (array_key_exists('select', $data)) {
            $select = $data['select'];
        }

        $with = [];

        if (array_key_exists('with', $data)) {
            $with = $data['with'];
        }

        $users = User::where($key, strtolower($operator), $value);

        if (! empty($select)) {
            $users->select(['id', 'name', 'email']);
        }

        if (! empty($with)) {
            $users->with($with);
        }

        return $users->get()->toArray();
    }

    public function asController(Request $request): array
    {
        $keyAttribute = 'key';
        $valueAttribute = 'value';
        $operatorAttribute = 'operator';
        $withAttribute = 'with';
        $selectAttribute = 'select';

        return $this->handle([
            'key' => $request->get($keyAttribute),
            'value' => $request->get($valueAttribute),
            'operator' => $request->get($operatorAttribute, 'like'),
            'with' => $request->get($withAttribute, []),
            'select' => $request->get($selectAttribute, []),
        ]);
    }
}
