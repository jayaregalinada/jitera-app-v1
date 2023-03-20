<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use function sprintf;

/**
 * This command will generate token for you to use in request
 */
final class MakeTokenCommand extends Command
{
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new token for random or certain user';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:token 
                            {userId? : The user ID} 
                            {--name= : Name of the Token}';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $user = $this->getUser();
        $token = $this->option('name') ?? 'api';

        $this->output->text(sprintf('Successfully created token to User ID: %s', $user->getAttribute('id')));
        $this->output->success($user->createToken($token)->plainTextToken);
    }

    /**
     * Get the user by its argument `userId`
     * If the `userId` is not provided, return any random User
     * Otherwise, use the provided `userId`
     */
    private function getUser(): User
    {
        return ($userId = $this->argument('userId')) === null
            ? User::query()->inRandomOrder()->first() // Or use User::inRandomOrder() directly
            : User::query()->find($userId); // Or use User::find() directly
    }
}
