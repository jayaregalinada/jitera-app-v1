<?php

declare(strict_types=1);

namespace Tests\Feature;

use Closure;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\AbstractTestCase;
use function route;

final class FollowUserTest extends AbstractTestCase
{
    use RefreshDatabase;

    public function providesFollowUser(): iterable
    {
        yield 'When normal user try to follow user' => [
            fn () => UserFactory::new()->createQuietly(),
            1,
            201,
        ];

        yield 'When normal user try to follow non-existing user' => [
            fn () => UserFactory::new()->createQuietly(),
            123123,
            404,
        ];
    }

    public function testFollowTheSameUser(): void
    {
        $user = UserFactory::new()->createQuietly();

        $this
            ->actingAs($user)
            ->postJson(route('user.follow', ['user' => 1]))
            ->assertStatus(201);

        $this
            ->actingAs($user)
            ->postJson(route('user.follow', ['user' => 1]))
            ->assertStatus(403);
    }

    /**
     * @param \Closure<\App\Models\User> $user
     *
     * @dataProvider providesFollowUser
     */
    public function testFollowUser(Closure $user, int $userId, int $statusCode): void
    {
        $this
            ->actingAs($user())
            ->postJson(route('user.follow', ['user' => $userId]))
            ->assertStatus($statusCode);
    }

    protected function setUp(): void
    {
        parent::setUp();

        UserFactory::new()
            ->count(20)
            ->createQuietly();
    }
}