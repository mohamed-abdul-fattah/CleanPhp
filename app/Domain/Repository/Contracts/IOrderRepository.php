<?php

namespace CleanPhp\Domain\Repository\Contracts;

interface IOrderRepository extends IRepository
{
  /**
   * @return mixed
   */
  public function getUnInvoicedOrders();
}
