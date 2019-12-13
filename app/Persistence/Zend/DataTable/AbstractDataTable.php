<?php

namespace CleanPhp\Persistence\Zend\DataTable;

use CleanPhp\Domain\Entity\AbstractEntity;
use CleanPhp\Domain\Repository\Contracts\IRepository;
use Zend\Db\TableGateway\TableGateway;
use Zend\Hydrator\HydratorInterface;

abstract class AbstractDataTable implements IRepository
{
  /**
   * @var TableGateway
   */
  protected $gateway;

  /**
   * @var HydratorInterface
   */
  protected $hydrator;

  public function __construct(TableGateway $gateway, HydratorInterface $hydrator) {
    $this->gateway  = $gateway;
    $this->hydrator = $hydrator;
  }

  /**
   * @param int $id
   * @return bool|AbstractEntity
   */
  public function getById(int $id)
  {
    $result = $this->gateway->select(['id' => $id])->current();
    return $result ? $result : false;
  }

  /**
   * @return \Zend\Db\ResultSet\ResultSetInterface
   */
  public function getAll()
  {
    return $this->gateway->select();
  }

  /**
   * @param AbstractEntity $entity
   * @return $this
   */
  public function persist(AbstractEntity $entity)
  {
    $data = $this->hydrator->extract($entity);

    if ($this->hasIdentity($entity)) {
      $this->gateway->update($data, ['id' => $entity->getId()]);
    } else {
      $this->gateway->insert($data);
      $entity->setId($this->gateway->getLastInsertValue());
    }

    return $this;
  }

  /**
   * Begin DB transaction
   *
   * @return $this
   */
  public function begin()
  {
    $this->gateway
      ->getAdapter()
      ->getDriver()
      ->getConnection()
      ->beginTransaction();
    return $this;
  }

  /**
   * Commit DB transaction
   *
   * @return $this
   */
  public function commit()
  {
    $this->gateway
      ->getAdapter()
      ->getDriver()
      ->getConnection()
      ->commit();
    return $this;
  }

  /**
   * Determines whether an entity has an identifier or not
   *
   * @param AbstractEntity $entity
   * @return bool
   */
  protected function hasIdentity(AbstractEntity $entity)
  {
    return ! empty($entity->getId());
  }
}
