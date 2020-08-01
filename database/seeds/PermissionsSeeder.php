<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit anuncios']);
        Permission::create(['name' => 'edit cursos']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'Asesor']);
        $role1->givePermissionTo('edit cursos');

        $role2 = Role::create(['name' => 'Estudiante']);

        $role3 = Role::create(['name' => 'Coordinador']);
        $role3->givePermissionTo('edit anuncios');
        $role3->givePermissionTo('edit cursos');

        $role4 = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // // create demo users
        // $user = Factory(App\User::class)->create([
        //     'name' => 'Example asesor user',
        //     'image' => 'photos/wFU44hEDR9jc5l7ynUOH3VQOlYD0jrjVtObpiI2R.png',
        //     'email' => 'asesor@example.com',
        //     'password' => Hash::make('asesor213'),
        // ]);
        // $user->assignRole($role1);

        //  $user = Factory(App\User::class)->create([
        //     'name' => 'Example2 asesor2 user2',
        //     'image' => 'photos/wFU44hEDR9jc5l7ynUOH3VQOlYD0jrjVtObpiI2R.png',
        //     'email' => 'asesor2@example.com',
        //     'password' => Hash::make('asesor2213'),
        // ]);
        // $user->assignRole($role1);

        // $user = Factory(App\User::class)->create([
        //     'name' => 'Example estudiante User',
        //     'image' => 'photos/wFU44hEDR9jc5l7ynUOH3VQOlYD0jrjVtObpiI2R.png',
        //     'email' => 'estudiante@example.com',
        //     'password' => Hash::make('estudiante213'),
        // ]);
        // $user->assignRole($role2);

        // $user = Factory(App\User::class)->create([
        //     'name' => 'Example2 estudiante2 User2',
        //     'image' => 'photos/wFU44hEDR9jc5l7ynUOH3VQOlYD0jrjVtObpiI2R.png',
        //     'email' => 'estudiante2@example.com',
        //     'password' => Hash::make('estudiante2213'),
        // ]);
        // $user->assignRole($role2);

        // $user = Factory(App\User::class)->create([
        //     'name' => 'Example Coornidador User',
        //     'image' => 'photos/wFU44hEDR9jc5l7ynUOH3VQOlYD0jrjVtObpiI2R.png',
        //     'email' => 'coordinador@example.com',
        //     'password' => Hash::make('coordinador213'),
        // ]);
        // $user->assignRole($role3);

        // $user = Factory(App\User::class)->create([
        //     'name' => 'Example Super-Admin User',
        //     'image' => 'photos/wFU44hEDR9jc5l7ynUOH3VQOlYD0jrjVtObpiI2R.png',
        //     'email' => 'superadmin@example.com',
        //     'password' => Hash::make('superadmin213'),
        // ]);
        // $user->assignRole($role4);
    }
}
