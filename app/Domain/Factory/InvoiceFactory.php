<?php

namespace CleanPhp\Domain\Factory;

use CleanPhp\Domain\Entity\Invoice;
use CleanPhp\Domain\Entity\Order;

class InvoiceFactory
{
  /**
   * @param Order $order
   * @return Invoice
   * @throws \Exception
   */
  public function createFromOrder(Order $order): Invoice
  {
    $invoice = new Invoice;
    $invoice->setOrder($order);
    $invoice->setInvoiceDate(new \DateTime);
    $invoice->setTotal($order->getTotal());

    return $invoice;
  }
}
