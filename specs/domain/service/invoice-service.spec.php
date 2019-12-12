<?php

describe('InvoicingService', function () {
  describe('->generateInvoices()', function () {
    beforeEach(function () {
      $this->repository = $this->getProphet()->prophesize('CleanPhp\Domain\Repository\Contracts\IOrderRepository');
    });

    it('should query the repository for un-invoiced orders', function () {
      $this->repository->getUnInvoicedOrders()->shouldBeCalled();

    });

    it('should return an Invoice for each un-invoiced orders');
  });
});
