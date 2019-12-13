<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

use CleanPhp\Persistence\Zend\TableGateway\TableGatewayFactory;
use CleanPhp\Persistence\Zend\DataTable\CustomerTable;
use CleanPhp\Domain\Entity\Customer;
use CleanPhp\Domain\Entity\Invoice;
use CleanPhp\Domain\Entity\Order;
use Zend\Hydrator\ClassMethods;

return [
    'service_manager' => [
      'factories' => [
        'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        'CustomerTable' => function ($sm) {
          /** @var \Zend\ServiceManager\ServiceManager $sm */
          $factory  = new TableGatewayFactory;
          $hydrator = new ClassMethods;

          return new CustomerTable(
            $factory->createGateway(
              $sm->get('Zend\Db\Adapter\Adapter'),
              $hydrator,
              new Customer,
              'customers'
            ),
            $hydrator
          );
        },
        'InvoiceTable' => function ($sm) {
          /** @var \Zend\ServiceManager\ServiceManager $sm */
          $factory  = new TableGatewayFactory;
          $hydrator = new ClassMethods;

          return new CustomerTable(
            $factory->createGateway(
              $sm->get('Zend\Db\Adapter\Adapter'),
              $hydrator,
              new Invoice,
              'invoices'
            ),
            $hydrator
          );
        },
        'OrderTable' => function ($sm) {
          /** @var \Zend\ServiceManager\ServiceManager $sm */
          $factory  = new TableGatewayFactory;
          $hydrator = new ClassMethods;

          return new CustomerTable(
            $factory->createGateway(
              $sm->get('Zend\Db\Adapter\Adapter'),
              $hydrator,
              new Order,
              'orders'
            ),
            $hydrator
          );
        },
      ],
    ],
];
