<?php

namespace CleanPhp\Domain\Entity;

class AbstractEntity
{
  /**
   * Entity identifier
   *
   * @var mixed
   */
  protected $id;

  /**
   * @return mixed
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param mixed $id
   * @return $this
   */
  public function setId($id)
  {
    $this->id = $id;
    return $this;
  }
}
