<?php

namespace CleanPhp\Domain\Entity;

class Customer extends AbstractEntity
{
  /**
   * @var string
   */
  protected $name;

  /**
   * @var string
   */
  protected $email;

  /**
   * @return string
   */
  public function getName(): string
  {
    return $this->name;
  }

  /**
   * @param string $name
   * @return $this
   */
  public function setName(string $name)
  {
    $this->name = $name;
    return $this;
  }

  /**
   * @return string
   */
  public function getEmail(): string
  {
    return $this->email;
  }

  /**
   * @param string $email
   * @return $this
   */
  public function setEmail(string $email)
  {
    $this->email = $email;
    return $this;
  }
}
