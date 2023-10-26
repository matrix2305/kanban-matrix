<?php
declare(strict_types=1);
namespace CoreKanban\Application\Contracts\UseCases\User;

interface GetAllUsersUseCaseInterface
{
    public function execute() : array;
}