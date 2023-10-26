<?php
declare(strict_types=1);
namespace CoreKanban\Domain\Contracts\Repositories;

use CoreKanban\Domain\Entities\User\User;

interface UserRepositoryInterface
{
    public function getAllUsers() : array;

    public function getUserById(int $id) : User;

    public function getUserByEmailOrUsername(string $input) : User;

    public function createOrUpdateUser(User $user) : void;
}