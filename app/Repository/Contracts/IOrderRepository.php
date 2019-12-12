<?php

namespace CleanPhp\Repository\Contracts;

interface IOrderRepository extends IRepository
{
  /**
   * @return mixed
   */
  public function getUnInvoicedOrders();
}
