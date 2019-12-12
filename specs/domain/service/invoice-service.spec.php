<?php

use CleanPhp\Domain\Service\InvoicingService;
use CleanPhp\Domain\Entity\Invoice;
use CleanPhp\Domain\Entity\Order;

describe('InvoicingService', function () {
  describe('->generateInvoices()', function () {
    beforeEach(function () {
      $this->repository = $this->getProphet()->prophesize('CleanPhp\Domain\Repository\Contracts\IOrderRepository');
      $this->factory    = $this->getProphet()->prophesize('CleanPhp\Domain\Factory\InvoiceFactory');
    });

    afterEach(function () {
      $this->getProphet()->checkPredictions();
    });

    it('should query the repository for un-invoiced orders', function () {

      $this->repository->getUnInvoicedOrders()->shouldBeCalled();
      $this->repository->getUnInvoicedOrders()->willReturn([]);

      $service = new InvoicingService($this->repository->reveal(), $this->factory->reveal());
      $service->generateInvoices();
    });

    it('should return an Invoice for each un-invoiced orders', function () {
      $orders   = [(new Order)->setTotal(400)];
      $invoices = [(new Invoice)->setTotal(400)];

      $this->repository->getUnInvoicedOrders()->willReturn($orders);
      $this->factory->createFromOrder($orders[0])->willReturn($invoices[0]);

      $service = new InvoicingService($this->repository->reveal(), $this->factory->reveal());
      $results = $service->generateInvoices();

      expect($results)->to->be->an('array');
      expect($results)->to->have->length(1);
    });
  });
});
