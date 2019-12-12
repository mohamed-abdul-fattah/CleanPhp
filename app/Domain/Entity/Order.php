<?php

namespace CleanPhp\Domain\Entity;

class Order extends AbstractEntity
{
  /**
   * @var Customer
   */
  protected $customer;

  /**
   * @var int
   */
  protected $orderNumber;

  /**
   * @var string
   */
  protected $description;

  /**
   * @var float
   */
  protected $total;

  /**
   * @return Customer
   */
  public function getCustomer(): Customer
  {
    return $this->customer;
  }

  /**
   * @param Customer $customer
   * @return $this
   */
  public function setCustomer(Customer $customer)
  {
    $this->customer = $customer;
    return $this;
  }

  /**
   * @return int
   */
  public function getOrderNumber(): int
  {
    return $this->orderNumber;
  }

  /**
   * @param int $orderNumber
   * @return $this
   */
  public function setOrderNumber(int $orderNumber)
  {
    $this->orderNumber = $orderNumber;
    return $this;
  }

  /**
   * @return string
   */
  public function getDescription(): string
  {
    return $this->description;
  }

  /**
   * @param string $description
   * @return $this
   */
  public function setDescription(string $description)
  {
    $this->description = $description;
    return $this;
  }

  /**
   * @return float
   */
  public function getTotal(): float
  {
    return $this->total;
  }

  /**
   * @param float $total
   * @return $this
   */
  public function setTotal($total)
  {
    $this->total = $total;
    return $this;
  }
}
