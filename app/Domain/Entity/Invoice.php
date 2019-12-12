<?php

namespace CleanPhp\Domain\Entity;

use DateTime;

class Invoice extends AbstractEntity
{
  /**
   * @var Order
   */
  protected $order;

  /**
   * @var DateTime
   */
  protected $invoiceDate;

  /**
   * @var float
   */
  protected $total;

  /**
   * @return Order
   */
  public function getOrder(): Order
  {
    return $this->order;
  }

  /**
   * @param Order $order
   * @return $this
   */
  public function setOrder(Order $order)
  {
    $this->order = $order;
    return $this;
  }

  /**
   * @return DateTime
   */
  public function getInvoiceDate(): DateTime
  {
    return $this->invoiceDate;
  }

  /**
   * @param DateTime $invoiceDate
   * @return $this
   */
  public function setInvoiceDate(DateTime $invoiceDate)
  {
    $this->invoiceDate = $invoiceDate;
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
  public function setTotal(float $total)
  {
    $this->total = $total;
    return $this;
  }
}
