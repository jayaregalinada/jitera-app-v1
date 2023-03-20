<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Closure;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\AbstractTestCase;
use function route;

final class FollowUserTest extends AbstractTestCase
{
    use RefreshDatabase;

    private User $currentUser;

    public static function providesFollowUser(): iterable
    {
        yield 'When user try to follow user' => [
            2,
            201,
        ];

        yield 'When user try to follow non-existing user' => [
            123123,
            404,
        ];

        yield 'When user try to follow already followed user' => [
            1,
            403,
        ];
    }

    /**
     * @dataProvider providesFollowUser
     */
    public function testFollowUser(int $userId, int $statusCode): void
    {
        $this
            ->actingAs($this->currentUser)
            ->postJson(route('user.follow', ['user' => $userId]))
            ->assertStatus($statusCode);
    }

    protected function setUp(): void
    {
        parent::setUp();

        UserFactory::new()
            ->count(20)
            ->createQuietly();

        $this->currentUser = UserFactory::new()->createQuietly();
        $this->currentUser->followings()->attach(1);
    }
}