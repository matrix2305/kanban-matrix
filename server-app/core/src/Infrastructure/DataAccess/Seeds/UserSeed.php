<?php
declare(strict_types=1);
namespace CoreKanban\Infrastructure\DataAccess\Seeds;

use CoreKanban\Domain\Contracts\Repositories\UserRepositoryInterface;
use CoreKanban\Domain\Entities\User\User;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class UserSeed extends BaseSeed
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    /**
     * @throws \JsonException
     */
    public function seed(): void
    {
        $data = json_decode('[
            {
              "id": 1,
              "name": "John Smith",
              "email": "test123@yopmail.com",
              "avatar_url": "https://i.pravatar.cc/150?u=1"
            },
            {
              "id": 2,
              "name": "Emma Watson",
              "email": "test1234@yopmail.com",
              "avatar_url": "https://i.pravatar.cc/150?u=2"
            },
            {
              "id": 3,
              "name": "Michael Johnson",
              "email": "test12345@yopmail.com",
              "avatar_url": "https://i.pravatar.cc/150?u=3"
            },
            {
              "id": 4,
              "name": "Emily Brown",
              "email": "test123456@yopmail.com",
              "avatar_url": "https://i.pravatar.cc/150?u=4"
            }
        ]
        ', true, 512, JSON_THROW_ON_ERROR);

        foreach ($data as $item) {
            $user = new User();
            $user->setName($item['name']);
            $user->setEmail($item['email']);
            $user->setUsername(str_replace(' ', '_', strtolower($item['name'])));
            $user->setAvatarUrl($item['avatar_url']);
            $user->setPassword(Hash::make('matrix12345!'));
            $user->setRememberToken(bin2hex(Uuid::uuid4()->toString()));
            $this->userRepository->createOrUpdateUser($user);
        }
    }
}