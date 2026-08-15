<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
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
    }
}
