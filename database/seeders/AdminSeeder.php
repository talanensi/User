<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->truncate();
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make("admin@123")
        ]);
    }
}
