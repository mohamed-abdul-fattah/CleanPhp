<?php

namespace CleanPhp\Domain\Repository\Contracts;

use CleanPhp\Domain\Entity\AbstractEntity;

interface IRepository
{
  /**
   * @param int $id
   * @return AbstractEntity
   */
  public function getById(int $id);

  /**
   * @return mixed
   */
  public function getAll();

  /**
   * @param AbstractEntity $entity
   */
  public function persist($entity);

  /**
   * Begin DB transaction
   */
  public function begin();

  /**
   * Commit DB transaction
   */
  public function commit();
}
