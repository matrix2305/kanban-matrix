<?php
declare(strict_types=1);
namespace CoreKanban\ServiceProvider;

use CoreKanban\Infrastructure\DataAccess\Seeds\SeedCommand;
use Illuminate\Support\ServiceProvider;

class CoreKanbanServiceProvider extends ServiceProvider
{
    public function register() : void
    {
        $repositories = include __DIR__.'/dependencyInjection/repositories.php';
        $useCases = include __DIR__.'/dependencyInjection/useCases.php';

        foreach ([...$repositories, ...$useCases] as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }

        $this->commands([SeedCommand::class]);
    }
}