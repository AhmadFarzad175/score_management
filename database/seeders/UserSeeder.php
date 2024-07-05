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

        $user = User::factory()->create([
            'name' => 'admin',
            'password' => Hash::make('12345678'),
        ]);

        // Create roles
        $admin = Role::create(['name' => 'admin']);
        $teacher = Role::create(['name' => 'teacher']);
        
        // Create permissions
        $manageAllData = Permission::create(['name' => 'manage all data']);
        $manageOwnData = Permission::create(['name' => 'manage own data']);
        
        // Assign permissions to roles
        $admin->givePermissionTo($manageAllData);
        $teacher->givePermissionTo($manageOwnData);

        $user->assignRole('admin');
    }
}
