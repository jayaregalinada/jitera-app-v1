<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Company;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

final class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserFactory::new()
            ->count(20)
            ->state(new Sequence(
                fn () => [
                    'address_id' => Address::all()->random(),
                    'company_id' => Company::all()->random(),
                ],
            ))
            ->createQuietly();
    }
}
