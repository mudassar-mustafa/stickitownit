<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Helpers\AclHelper;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (AclHelper::$ROLES_ARRAY as $roleStr) {
            $role = Role::create(['name' => $roleStr]);
            $permissions = AclHelper::getPermissionsForRole($roleStr);
            $role->syncPermissions($permissions);
        }

        $user = User::findOrFail(1);
        $user->assignRole(Role::findById(1));

        $user = User::findOrFail(2);
        $user->assignRole(Role::findById(2));
    }
}
