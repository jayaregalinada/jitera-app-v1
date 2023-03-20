<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\AbstractTestCase;
use function compact;
use function route;

final class ListUserFollowersTest extends AbstractTestCase
{
    use RefreshDatabase;

    private User $currentUser;

    public function providesQuery(): iterable
    {
        yield 'Show all followers' => [
            3,
        ];

        yield 'Filter followers with name, John' => [
            1,
            ['name' => 'John'],
        ];

        yield 'Filter non-followers' => [
            0,
            ['name' => 'Peter'],
        ];
    }

    /**
     * @dataProvider providesQuery
     */
    public function testListUserFollowers(int $expectedCount, ?array $filterParameters = null): void
    {
        $this
            ->actingAs($this->currentUser)
            ->getJson(route('me.followers', $filterParameters ?? []))
            ->assertOk()
            ->assertJsonIsArray('data')
            ->assertJsonCount($expectedCount, 'data');
    }

    protected function setUp(): void
    {
        parent::setUp();

        foreach (['John', 'Bob', 'Frida', 'Thor', 'Maurine'] as $name) {
            UserFactory::new(compact('name'))
                ->createQuietly();
        }

        $this->currentUser = UserFactory::new()->createQuietly();
        $this->currentUser->followers()->attach([1, 2, 4]); // Add 'John' and 'Bob', 'Thor'
    }
}