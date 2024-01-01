<?php

namespace App\Http\Middleware;

use App\Models\MessageType;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Spatie\Permission\Models\Permission;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     */
    public function share(Request $request): array
    {
        $props = array_merge(parent::share($request), [
            'app' => [
                'title' => config('app.name', 'Glorious Code'),
            ],
            'flash' => [
                'message' => fn () => $request->session()->get('message'),
                'message_type' => fn () => $request->session()->has('message_type') ? $request->session()->get('message_type') : MessageType::INFO->value,
            ],
            'urlPrevious' => url()->previous(),
        ]);

        if ($request->user()) {
            $props = array_merge($props, [
                'auth.user.permissions' => function () use ($request) {
                    if ($request->user() == null) {
                        return null;
                    }

                    $permissions = [];
                    foreach (Permission::all() as $permission) {
                        if ($request->user()->can($permission->name)) {
                            $permissions[$permission->name] = true;
                        } else {
                            $permissions[$permission->name] = false;
                        }
                    }

                    return $permissions;
                },
                'auth.user.roles' => function () use ($request) {
                    return $request->user() != null ? $request->user()->roles()->pluck('name') : null;
                },
            ]);
        }

        return $props;
    }
}
