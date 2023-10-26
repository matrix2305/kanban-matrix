<?php
declare(strict_types=1);
namespace CoreKanban\Infrastructure\DataAccess\Seeds;

use Illuminate\Console\Command;

class SeedCommand extends Command
{
    protected $signature = 'kanban:seed';

    public function handle() : void
    {
        $seeds = [
            LabelSeed::class,
            UserSeed::class,
            TaskListSeed::class
        ];

        foreach ($seeds as $seedClass) {
            /** @var BaseSeed $seed */
            $seed = app()->make($seedClass);
            $seed->seed();
        }

        $this->info('Completed seeding!');
    }
}