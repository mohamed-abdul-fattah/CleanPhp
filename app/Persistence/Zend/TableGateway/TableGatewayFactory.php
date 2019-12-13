<?php

namespace CleanPhp\Persistence\Zend\TableGateway;

use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Hydrator\HydratorInterface;
use Zend\Db\Adapter\Adapter;

class TableGatewayFactory
{
  /**
   * @param Adapter $adapter
   * @param HydratorInterface $hydrator
   * @param $object
   * @param $table
   * @return TableGateway
   */
  public function createGateway(Adapter $adapter, HydratorInterface $hydrator, $object, $table)
  {
    $resultSet = new HydratingResultSet($hydrator, $object);
    return new TableGateway($table, $adapter, null, $resultSet);
  }
}
