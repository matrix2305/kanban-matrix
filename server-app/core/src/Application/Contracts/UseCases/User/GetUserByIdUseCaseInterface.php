<?php
declare(strict_types=1);
namespace CoreKanban\Application\Contracts\UseCases\User;

use CoreKanban\Application\DTO\Responses\User\UserDTO;

interface GetUserByIdUseCaseInterface
{
    public function execute(int $id) : UserDTO;
}