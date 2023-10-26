<?php
declare(strict_types=1);
namespace CoreKanban\Infrastructure\DataAccess\Repositories\User;

use CoreKanban\Domain\Contracts\Repositories\UserRepositoryInterface;
use CoreKanban\Domain\Entities\User\User;
use CoreKanban\Infrastructure\DataAccess\Exceptions\EntityNotFoundException;
use CoreKanban\Infrastructure\DataAccess\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected string $entity = User::class;

    public function getAllUsers() : array
    {
        return $this->getAll();
    }

    public function getUserById(int $id) : User
    {
        return $this->findOne($id);
    }

    /**
     * @throws EntityNotFoundException
     */
    public function getUserByEmailOrUsername(string $input) : User
    {
        $field = filter_var($input, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $entity = $this->em->getRepository($this->entity)->findOneBy([$field => $input]);
        if (!$entity) {
            throw new EntityNotFoundException("User not found!");
        }

        return $entity;
    }

    public function createOrUpdateUser(User $user) : void
    {
        $this->createOrUpdate($user);
    }
}