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

        // create demo users
        $user = Factory(App\User::class)->create([
            'name' => 'Example asesor user',
            'image' => 'resources/users/user-default.svg',
            'email' => 'asesor@example.com',
            'password' => Hash::make('asesor213'),
        ]);
        $user->assignRole($role1);

         $user = Factory(App\User::class)->create([
            'name' => 'Example2 asesor2 user2',
            'image' => 'resources/users/user-default.svg',
            'email' => 'asesor2@example.com',
            'password' => Hash::make('asesor2213'),
        ]);
        $user->assignRole($role1);

        $user = Factory(App\User::class)->create([
            'name' => 'Example estudiante User',
            'image' => 'resources/users/user-default.svg',
            'email' => 'estudiante@example.com',
            'password' => Hash::make('estudiante213'),
        ]);
        $user->assignRole($role2);

        $user = Factory(App\User::class)->create([
            'name' => 'Example2 estudiante2 User2',
            'image' => 'resources/users/user-default.svg',
            'email' => 'estudiante2@example.com',
            'password' => Hash::make('estudiante2213'),
        ]);
        $user->assignRole($role2);

        $user = Factory(App\User::class)->create([
            'name' => 'Example Coornidador User',
            'image' => 'resources/users/user-default.svg',
            'email' => 'coordinador@example.com',
            'password' => Hash::make('coordinador213'),
        ]);
        $user->assignRole($role3);

        $user = Factory(App\User::class)->create([
            'name' => 'Example Super-Admin User',
            'image' => 'resources/users/user-default.svg',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('superadmin213'),
        ]);
        $user->assignRole($role4);

         Factory(App\Models\Asesor::class)->create([
              'user_id'=> 1,
            'name' => Str::random(10),
            'bio' => Str::random(10).'--bio',
            'institute' => 'Instituto Tecnologico de Oaxaca',
            'department' => 'Maestria en construccion',
            'telephone' => '9511782851'
        ]);

        Factory(App\Models\Asesor::class)->create([
                        'user_id'=> 2,
            'name' => Str::random(10),
            'bio' => Str::random(10).'--bio',
            'institute' => 'Instituto Tecnologico de Oaxaca',
            'department' => 'Maestria en construccion',
            'telephone' => '9511782852'
        ]);

        Factory(App\Models\Estudiante::class)->create([
           'user_id'=> 3,
            'name' => Str::random(10),
            'bio' => Str::random(10).'--bio',
            'institute' => 'Instituto Tecnologico de Oaxaca',
            'department' => 'Maestria en construccion',
            'telephone' => '9511782833'
        ]);

        Factory(App\Models\Estudiante::class)->create([
            'user_id'=> 4,
            'name' => Str::random(10),
            'bio' => Str::random(10).'--bio',
            'institute' => 'Instituto Tecnologico de Oaxaca',
            'department' => 'Maestria en construccion',
            'telephone' => '9511782854'
        ]);

        Factory(App\Models\Asesor::class)->create([
           'user_id'=> 5,
            'name' => Str::random(10),
            'bio' => Str::random(10).'--bio',
            'institute' => 'Instituto Tecnologico de Oaxaca',
            'department' => 'Maestria en Diseño',
            'telephone' => '9521782833'
        ]);

        Factory(App\Models\Asesor::class)->create([
            'user_id'=> 6,
            'name' => Str::random(10),
            'bio' => Str::random(10).'--bio',
            'institute' => 'Instituto Tecnologico de Oaxaca',
            'department' => 'Maestria en diseño',
            'telephone' => '9512782854'
        ]);    }
}
