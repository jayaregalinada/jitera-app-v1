<?php

declare(strict_types=1);

namespace Tests\Feature;

use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\AbstractTestCase;
use function route;

final class ListUserTest extends AbstractTestCase
{
    use RefreshDatabase;

    public function testListUserPublicly(): void
    {
        $this
            ->getJson(route('users.list'))
            ->assertOk();
    }

    public function testListUserWithPagination(): void
    {
        $this
            ->getJson(route('users.list'))
            ->assertOk()
            ->assertJsonIsArray('data')
            ->assertJsonCount(15, 'data');

        $this
            ->getJson(route('users.list', ['page' => 2]))
            ->assertOk()
            ->assertJsonCount(5, 'data');
    }

    protected function setUp(): void
    {
        parent::setUp();

        UserFactory::new()
            ->count(20)
            ->create();
    }
}