<?php

declare(strict_types=1);

namespace Tests\Feature;

use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\AbstractTestCase;
use function route;

final class GetCurrentUserTest extends AbstractTestCase
{
    use RefreshDatabase;

    public function testGetCurrentUser(): void
    {
        $user = UserFactory::new()->createQuietly();

        $this
            ->actingAs($user)
            ->getJson(route('me.current_user'))
            ->assertOk()
            ->assertJsonIsObject()
            ->assertJson([
                'email' => $user->getAttribute('email'),
                'id' => $user->getAttribute('id'),
                'name' => $user->getAttribute('name'),
                'phone' => $user->getAttribute('phone'),
                'website' => $user->getAttribute('website'),
            ]);
    }

    public function testGetCurrentUserPublicly(): void
    {
        $this->getJson(route('me.current_user'))
            ->assertUnauthorized();
    }
}