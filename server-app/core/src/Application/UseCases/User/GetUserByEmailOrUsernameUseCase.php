<?php
declare(strict_types=1);
namespace CoreKanban\Application\UseCases\User;

use CoreKanban\Application\Contracts\UseCases\User\GetUserByEmailOrUsernameUseCaseInterface;
use CoreKanban\Application\DTO\Responses\User\UserDTO;
use CoreKanban\Domain\Contracts\Repositories\UserRepositoryInterface;

class GetUserByEmailOrUsernameUseCase implements GetUserByEmailOrUsernameUseCaseInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    public function execute(string $input) : UserDTO
    {
        return UserDTO::fromEntity(
            $this->userRepository->getUserByEmailOrUsername($input)
        );
    }
}