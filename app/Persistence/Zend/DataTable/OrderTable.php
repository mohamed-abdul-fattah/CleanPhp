<?php

namespace CleanPhp\Persistence\Zend\DataTable;

use CleanPhp\Domain\Repository\Contracts\IOrderRepository;

class OrderTable extends AbstractDataTable implements IOrderRepository
{
  /**
   * @return array
   */
  public function getUnInvoicedOrders()
  {
    return [];
  }
}
