<?php

namespace App\Actions\Users;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Lorisleiva\Actions\Concerns\AsAction;

class GetUsers
{
    use AsAction;

    public function authorize(Request $request): bool
    {
        return $request->user()->can('users.read');
    }

    private int $per_page = 15;

    public function handle(array $data): LengthAwarePaginator
    {
        $emailAttribute = 'email';
        $perPageAttribute = 'per_page';
        $nameAttribute = 'name';

        $users = User::with(['roles']);

        $email = '';
        $name = '';
        $perPage = $this->per_page;

        if (array_key_exists($emailAttribute, $data)) {
            $email = $data[$emailAttribute];

            $users->where($emailAttribute, 'LIKE', "%{$email}%");
        }

        if (array_key_exists($nameAttribute, $data)) {
            $name = $data[$nameAttribute];

            $users->where($nameAttribute, 'LIKE', "%{$name}%");
        }

        if (array_key_exists($perPageAttribute, $data)) {
            $perPage = $data[$perPageAttribute];
        }

        return $users->paginate($perPage);
    }

    public function asController(Request $request): Response
    {
        $per_page = $this->per_page;
        $name = $request->get('name', '');
        $email = $request->get('email', '');

        $users = $this->handle([
            'per_page' => $request->get('per_page', $per_page),
            'name' => $name,
            'email' => $email,
        ]);

        return Inertia::render('Admin/Users/Index', [
            'users' => $users,
            'name' => $name,
            'email' => $email,
        ]);
    }
}
