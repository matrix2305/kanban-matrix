<?php
declare(strict_types=1);
namespace CoreKanban\Application\DTO\Responses\User;

use CoreKanban\Application\DTO\Responses\BaseDTO;
use CoreKanban\Domain\Entities\User\User;
use OpenApi\Attributes as OA;

#[
    OA\Schema(
        schema: 'UserDTO',
        properties: [
            new OA\Property(property: 'id', type: 'integer'),
            new OA\Property(property: 'name', type: 'string'),
            new OA\Property(property: 'username', type: 'string'),
            new OA\Property(property: 'email', type: 'string'),
            new OA\Property(property: 'avatarUrl', type: 'string'),
        ]
    )
]
class UserDTO extends BaseDTO
{
    public int $id;
    public string $name;
    public string $username;
    public string $email;
    public string $avatarUrl;


    public static function fromEntity(User $user) : self
    {
        return new self([
            'id' => $user->getId(),
            'name' => $user->getName(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'avatarUrl' => $user->getAvatarUrl()
        ]);
    }

    public static function fromArray(array $entities) : array
    {
        $dtos = [];
        if (!empty($entities)) {
            foreach ($entities as $entity) {
                if ($entity instanceof User) {
                    $dtos[] = self::fromEntity($entity);
                }
            }
        }

        return $dtos;
    }
}