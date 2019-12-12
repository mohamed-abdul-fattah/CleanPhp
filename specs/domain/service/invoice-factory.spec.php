<?php

use CleanPhp\Domain\Entity\Order;
use CleanPhp\Domain\Factory\InvoiceFactory;

describe('InvoiceFactory', function () {
  describe('->createFromOrder', function () {
    beforeEach(function () {
      $this->order   = new Order;
      $this->factory = new InvoiceFactory;
      $this->order->setTotal(500);
      $this->invoice = $this->factory->createFromOrder($this->order);
    });

    it('should return an Invoice object', function () {
      expect($this->invoice)->to->be->instanceof('CleanPhp\Domain\Entity\Invoice');
    });

    it('should set the total of the invoice', function () {
      expect($this->invoice->getTotal())->to->equal(500.0);
    });

    it('should associate the order to the invoice', function () {
      expect($this->invoice->getOrder())->to->equal($this->order);
    });

    it('should set the date of the invoice', function () {
      expect($this->invoice->getInvoiceDate())->to->be->instanceof('DateTime');
    });
  });
});
