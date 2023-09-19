<?php

namespace Database\Seeders;

use App\Enums\Role as RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::query()->where('email','admin@admin.com' )->exists()){
            return;
        }

        $user = User::factory()->create([
           'email' => 'admin@admin.com',
           'password' => Hash::make("admin")
        ]);

        $roleAdmin = Role::query()->where('name', RoleEnum::ADMIN->name)->first();

        if (!$roleAdmin){
            $this->call(RoleSeeder::class);
        }

        $user->roles()->save($roleAdmin);
    }
}
