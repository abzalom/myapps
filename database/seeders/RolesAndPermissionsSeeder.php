<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'delete']);
        Permission::create(['name' => 'update']);
        Permission::create(['name' => 'lock']);
        Permission::create(['name' => 'validation']);
        Permission::create(['name' => 'create user']);

        $role1 = Role::create(['name' => 'admin']);
        $role1->givePermissionTo(Permission::all());

        $role2 = Role::create(['name' => 'user']);

        $user1 = User::create([
            'username' => 'admin',
            'password' => Hash::make('admin'),
        ]);

        $user1->assignRole($role1);

        $user2 = User::create([
            'username' => 'user',
            'password' => Hash::make('password'),
        ]);

        $user2->assignRole($role2);
    }
}
