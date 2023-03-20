<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\AbstractTestCase;

final class UnfollowUserTest extends AbstractTestCase
{
    use RefreshDatabase;

    private User $currentUser;

    public static function providesUnfollowUser(): iterable
    {
        yield 'When normal user try to unfollow user' => [
            1,
            200,
        ];

        yield 'When normal user try to unfollow non-existing user' => [
            123123,
            404,
        ];

        yield 'When normal user try to unfollow a non-yet followed user' => [
            5,
            403,
        ];
    }

    /**
     * @dataProvider providesUnfollowUser
     */
    public function testUnfollowUser(int $userId, int $statusCode): void
    {
        $this
            ->actingAs($this->currentUser)
            ->deleteJson(route('user.unfollow', ['user' => $userId]))
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