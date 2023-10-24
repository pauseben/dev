<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions 
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions (incomplete)
        Permission::create(['name' => 'users.edit']);
        Permission::create(['name' => 'my-orders']);
        Permission::create(['name' => 'home']);
        Permission::create(['name' => 'users.update']);
        Permission::create(['name' => 'order.store']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'user']);
        $role1->givePermissionTo('my-orders');
        $role1->givePermissionTo('home');
        $role1->givePermissionTo('users.edit');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('my-orders');
        $role2->givePermissionTo('home');
        $role2->givePermissionTo('users.edit');
        $role2->givePermissionTo('users.update');
        $role2->givePermissionTo('order.store');

        $role3 = Role::create(['name' => 'Super-Admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Felhasználó',
            'email' => 'teszt@teszt.hu',
            'password' => bcrypt('123456'),
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.hu',
            'password' => bcrypt('admin123'),
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => '	Super-Admin User',
            'email' => 'superadmin@superadmin.hu',
            'password' => bcrypt('Superadm!n123'),
        ]);
        $user->assignRole($role3);
    }
}
