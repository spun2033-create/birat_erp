<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $adminId = DB::table('users')->insertGetId([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('companies')->insert([
            'name' => 'Sample Hardware Pasal',
            'address' => 'Biratnagar, Nepal',
            'default_currency' => 'NPR',
            'timezone' => 'Asia/Kathmandu',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Default settings
        Setting::updateOrCreate(
            ['key' => 'modules'],
            ['value' => [
                'inventory' => true,
                'sales' => true,
                'purchases' => true,
                'attendance' => true,
                'payroll' => true,
                'reports' => true,
            ]]
        );

        Setting::updateOrCreate(['key' => 'language'], ['value' => 'ne']);
        Setting::updateOrCreate(['key' => 'date_system'], ['value' => 'bs']);
        Setting::updateOrCreate(['key' => 'invoice_paper_size'], ['value' => 'A4']);

        // Roles
        $roles = [
            ['name' => 'Administrator', 'slug' => 'admin'],
            ['name' => 'Cashier', 'slug' => 'cashier'],
            ['name' => 'Inventory Manager', 'slug' => 'inventory'],
            ['name' => 'HR', 'slug' => 'hr'],
            ['name' => 'Accountant', 'slug' => 'accountant'],
        ];

        foreach ($roles as $r) {
            Role::updateOrCreate(['slug' => $r['slug']], ['name' => $r['name']]);
        }

        // Attach admin role to admin user
        $adminRole = Role::where('slug', 'admin')->first();
        if ($adminRole) {
            DB::table('role_user')->insert([
                'role_id' => $adminRole->id,
                'user_id' => $adminId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
