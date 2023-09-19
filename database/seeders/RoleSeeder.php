<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Enums\Role as RoleEnum;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (RoleEnum::cases() as $role) {

            $existRole = Role::query()->where('name', $role->name)->exists();
            if ($existRole) {
                continue;
            }


            DB::transaction(function () use ($role) {

                $newRole = new Role(['name' => $role->name]);
                $newRole->save();

                $permissions = RoleEnum::getPermission($role);
                $this->createRolePermission($newRole, $permissions);

            }, 3);


        }
    }

    /**
     * @param Role $role
     * @param array $permissions
     * @return void
     */
    public function createRolePermission(Role $role, array $permissions): void
    {
        foreach ($permissions as $permission) {
            $per = Permission::query()->firstOrCreate(['name' => $permission->name]);
            $per->assignRole($role);
        }
    }
}
