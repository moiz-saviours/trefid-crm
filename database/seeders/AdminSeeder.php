<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->truncate();
        Admin::create([
            'name' => 'Syed Moiz Athar',
            'email' => 'moiz@saviours.co',
            'password' => Hash::make('12345678'),
            'type' => 'super-admin',
        ]);
    }
}
