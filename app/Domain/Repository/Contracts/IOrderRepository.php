<?php

namespace CleanPhp\Domain\Repository\Contracts;

interface IOrderRepository extends IRepository
{
  /**
   * @return array
   */
  public function getUnInvoicedOrders();
}
