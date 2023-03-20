<?php

declare(strict_types=1);

namespace Database\Seeders;

use Database\Factories\AddressFactory;
use Illuminate\Database\Seeder;

final class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AddressFactory::new()
            ->count(10)
            ->createQuietly();
    }
}
