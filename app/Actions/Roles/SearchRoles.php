<?php

namespace App\Actions\Roles;

use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\Permission\Models\Role;

class SearchRoles
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

        $roles = Role::query()->where($key, strtolower($operator), $value);

        if (! empty($select)) {
            $roles->select($select);
        }

        if (! empty($with)) {
            $roles->with($with);
        }

        return $roles->get()->toArray();
    }
}
