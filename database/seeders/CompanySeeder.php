<?php

declare(strict_types=1);

namespace Database\Seeders;

use Database\Factories\CompanyFactory;
use Illuminate\Database\Seeder;

final class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyFactory::new()
            ->count(10)
            ->createQuietly();
    }
}
