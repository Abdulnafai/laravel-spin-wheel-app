<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleAndUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create roles
        $adminRole = Role::create(['name' => 'Admin']);
        $wholesalerRole = Role::create(['name' => 'Wholesaler']);
        $retailerRole = Role::create(['name' => 'Retailer']);

        // Create users with these roles
        User::factory()->count(5)->create()->each(function ($user) use ($adminRole) {
            $user->assignRole($adminRole);
        });

        User::factory()->count(17)->create()->each(function ($user) use ($wholesalerRole) {
            $user->assignRole($wholesalerRole);
        });

        User::factory()->count(33)->create()->each(function ($user) use ($retailerRole) {
            $user->assignRole($retailerRole);
        });
    }
}
