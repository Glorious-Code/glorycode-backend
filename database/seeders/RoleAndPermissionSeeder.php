<?php

namespace Database\Seeders;

use App\Models\ERole;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    private array $permissions = [
        "users" => [
            "create",
            "read",
            "update",
            "delete"
        ],
        "roles" => [
            "create",
            "read",
            "update",
            "delete"
        ],
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createRoles();
        $this->createPermissions();
        $this->syncRolePermissions();
    }

    private function createRoles(): void
    {
        foreach (ERole::cases() as $role) {
            Role::findOrCreate($role->value);
        }
    }

    private function createPermissions(): void
    {
        foreach ($this->permissions as $subject => $subjectActions) {
            foreach ($subjectActions as $action) {
                Permission::findOrCreate("{$subject}.{$action}");
            }
        }
    }

    private function syncRolePermissions(): void {
        Role::findByName(ERole::ADMIN->value)->syncPermissions(Permission::all());

        $moderator = Role::findByName(ERole::MODERATOR->value);
        $moderator->syncPermissions(
            Permission::query()
                    ->where('name', 'LIKE', "users%")
                    ->whereNot('name', 'LIKE', '%delete')
                    ->orWhere('name', 'LIKE', "roles.read")
                    ->get()
        );
    }
}
