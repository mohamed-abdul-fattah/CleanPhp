<?php

namespace CleanPhp\Persistence\Doctrine\Repository;

use CleanPhp\Domain\Repository\Contracts\IRepository;
use CleanPhp\Domain\Entity\AbstractEntity;
use Doctrine\ORM\EntityManager;

class AbstractDoctrineRepository implements IRepository
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var AbstractEntity
     */
    protected $entityClass;

    public function __construct(EntityManager $entityManager)
    {
        if (empty($this->entityClass)) {
            throw new \RuntimeException(get_class($this) . '::$entityClass is not defined');
        }

        $this->entityManager = $entityManager;
    }

    /**
     * @param int $id
     * @return bool|AbstractEntity|object|null
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function getById(int $id)
    {
        return $this->entityManager->find($this->entityClass, $id);
    }

    /**
     * @return array|mixed|object[]
     */
    public function getAll()
    {
        return $this->entityManager->getRepository($this->entityClass)
            ->findAll();
    }

    /**
     * @param array $conditions
     * @param array $order
     * @param int|null $limit
     * @param int|null $offset
     * @return array|object[]
     */
    public function getBy(
        $conditions = [],
        $order = [],
        $limit = null,
        $offset = null
    ) {
        $repository = $this->entityManager->getRepository($this->entityClass);
        return $repository->findBy(
            $conditions,
            $order,
            $limit,
            $offset
        );
    }

    /**
     * @param AbstractEntity $entity
     * @return $this
     * @throws \Doctrine\ORM\ORMException
     */
    public function persist(AbstractEntity $entity)
    {
        $this->entityManager->persist($entity);
        return $this;
    }

    /**
     * @return $this
     */
    public function begin()
    {
        $this->entityManager->beginTransaction();
        return $this;
    }

    /**
     * @return $this
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function commit()
    {
        $this->entityManager->flush();
        $this->entityManager->commit();
        return $this;
    }
}
