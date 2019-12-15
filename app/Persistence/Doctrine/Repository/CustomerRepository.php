<?php

namespace CleanPhp\Persistence\Doctrine\Repository;

use CleanPhp\Domain\Repository\Contracts\ICustomerRepository;

class CustomerRepository extends AbstractDoctrineRepository
    implements ICustomerRepository
{
    /**
     * @var string
     */
    protected $entityClass = 'CleanPhp\Domain\Entity\Customer';
}
