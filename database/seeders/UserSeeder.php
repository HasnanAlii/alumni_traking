<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ---------------------------
        // 1. BUAT ROLES
        // ---------------------------
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $alumniRole = Role::firstOrCreate(['name' => 'alumni']);

        // ---------------------------
        // 2. BUAT PERMISSIONS (opsional)
        // ---------------------------
        Permission::firstOrCreate(['name' => 'manage loker']);
        Permission::firstOrCreate(['name' => 'manage alumni']);

        // Beri permission ke admin
        $adminRole->givePermissionTo([
            'manage loker',
            'manage alumni'
        ]);

        // ---------------------------
        // 3. BUAT USER ADMIN DEFAULT
        // ---------------------------
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'), // ganti di production
            ]
        );
        $admin->assignRole('admin');

        // ---------------------------
        // 4. BUAT USER ALUMNI DEFAULT
        // ---------------------------
        $alumni = User::firstOrCreate(
            ['email' => 'alumni@gmail.com'],
            [
                'name' => 'Alumni Default',
                'password' => Hash::make('password'), // ganti di production
            ]
        );
        $alumni->assignRole('alumni');
    }
}
