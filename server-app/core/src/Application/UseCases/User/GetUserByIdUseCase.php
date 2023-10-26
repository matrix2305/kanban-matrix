<?php
declare(strict_types=1);
namespace CoreKanban\Application\UseCases\User;

use CoreKanban\Application\Contracts\UseCases\User\GetUserByIdUseCaseInterface;
use CoreKanban\Application\DTO\Responses\User\UserDTO;
use CoreKanban\Domain\Contracts\Repositories\UserRepositoryInterface;

class GetUserByIdUseCase implements GetUserByIdUseCaseInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    public function execute(int $id) : UserDTO
    {
        return UserDTO::fromEntity(
            $this->userRepository->getUserById($id)
        );
    }
}