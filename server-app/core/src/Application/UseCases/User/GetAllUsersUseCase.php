<?php
declare(strict_types=1);
namespace CoreKanban\Application\UseCases\User;

use CoreKanban\Application\Contracts\UseCases\User\GetAllUsersUseCaseInterface;
use CoreKanban\Application\DTO\Responses\User\UserDTO;
use CoreKanban\Domain\Contracts\Repositories\UserRepositoryInterface;

class GetAllUsersUseCase implements GetAllUsersUseCaseInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    public function execute() : array
    {
        return UserDTO::fromArray(
            $this->userRepository->getAllUsers()
        );
    }
}