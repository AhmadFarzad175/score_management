<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    public function run(): void
    {

        $admin = User::factory()->create([
            'name' => 'Maiwand',
            'password' => Hash::make('12345678'),
        ]);

        $teacher = User::factory()->create([
            'name' => 'Farzad',
            'password' => Hash::make('12345678'),
        ]);

        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $teacherRole = Role::create(['name' => 'teacher']);

        // Create permissions
        $manageAllData = Permission::create(['name' => 'manage all data']);
        $manageOwnData = Permission::create(['name' => 'manage own data']);

        // Assign permissions to roles
        $adminRole->givePermissionTo($manageAllData);
        $teacherRole->givePermissionTo($manageOwnData);

        $admin->assignRole($adminRole);
        $teacher->assignRole($teacherRole);
    }
}
