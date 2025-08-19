<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'manage category' ,
            'manage lessons' ,
            'manage questions',
            'view category',
            'view lessons',
            'view questions',
        ];
        foreach ($permissions as $permission)
        {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $user = Role :: firstOrCreate(['name' => 'user']);

        $admin -> givePermissionTo(['manage category', 'manage lessons' , 'manage questions' , 'view category' , 'view lessons' , 'view questions']);
        $user -> givePermissionTo (['view lessons' , 'view category', 'view questions']);
        $superAdmin -> givePermissionTo(Permission::all());
    }
}
