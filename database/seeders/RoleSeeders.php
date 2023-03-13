<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        
        Role::create([
            'name' => 'superadmin'
        ]);

        Role::create([
            'name' => 'mentor'
        ]);

        Role::create([
            'name' => 'mentee'
        ]);

        Role::create([
            'name' => 'user'
        ]);
    }
}
