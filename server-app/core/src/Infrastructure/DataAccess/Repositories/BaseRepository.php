<?php
declare(strict_types=1);
namespace CoreKanban\Infrastructure\DataAccess\Repositories;

use CoreKanban\Infrastructure\DataAccess\Exceptions\EntityNotFoundException;
use CoreKanban\Infrastructure\DataAccess\Exceptions\RepositoryException;
use CoreKanban\Infrastructure\DataAccess\Exceptions\RowVersionException;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\PessimisticLockException;
use Exception;

abstract class BaseRepository
{
    protected string $entity;

    public function __construct(
        protected EntityManagerInterface $em
    ){}

    protected function getAll() : array
    {
        return $this->em->getRepository($this->entity)->findAll();
    }

    /**
     * @throws EntityNotFoundException
     */
    protected function findOne($id) : object
    {
        $entity = $this->em->find($this->entity, $id);
        if (!$entity) {
            throw new EntityNotFoundException($this->entity.' not found!');
        }

        return $entity;
    }

    /**
     * @throws OptimisticLockException
     * @throws RowVersionException
     * @throws PessimisticLockException
     */
    protected function createOrUpdate(object $object, ?int $rowVersion = null) : void
    {
        $this->em->beginTransaction();
        try {
            if ($rowVersion){
                $this->em->lock($object, LockMode::OPTIMISTIC, $rowVersion);
            }
            $this->em->persist($object);
            $this->em->flush();
            $this->em->commit();
        }catch (OptimisticLockException $exception){
            $this->em->rollback();
            throw new RowVersionException();
        }catch (Exception $exception){
            $this->em->rollback();
            throw $exception;
        }
    }

    /**
     * @throws RepositoryException
     */
    protected function remove(object $object) : void
    {
        $this->em->beginTransaction();
        try {
            $this->em->remove($object);
            $this->em->flush();
            $this->em->commit();
        }catch (Exception $exception){
            $this->em->rollback();
            throw new RepositoryException('error_deleting');
        }
    }
}