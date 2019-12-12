<?php

namespace CleanPhp\Domain\Service;

use CleanPhp\Domain\Factory\InvoiceFactory;
use CleanPhp\Domain\Repository\Contracts\IOrderRepository;

class InvoicingService
{
  /**
   * @var IOrderRepository
   */
  protected $orderRepository;

  /**
   * @var InvoiceFactory
   */
  protected $invoicesFactory;

  public function __construct(IOrderRepository $orderRepository, InvoiceFactory $invoiceFactory)
  {
    $this->orderRepository = $orderRepository;
    $this->invoicesFactory = $invoiceFactory;
  }

  /**
   * @return array
   * @throws \Exception
   */
  public function generateInvoices(): array
  {
    $orders = $this->orderRepository->getUnInvoicedOrders();

    $invoices = [];
    foreach ($orders as $order) {
      $invoices[] = $this->invoicesFactory->createFromOrder($order);
    }

    return $invoices;
  }
}
