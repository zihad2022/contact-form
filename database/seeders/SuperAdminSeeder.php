<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

final class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Raziul Islam',
            'email' => config('larament.super_admin.email'),
            'password' => config('larament.super_admin.password', 'password'),
        ]);

        // $admin->assignRole('super_admin');
    }
}
