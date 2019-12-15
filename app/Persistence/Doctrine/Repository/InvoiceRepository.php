<?php

namespace CleanPhp\Persistence\Doctrine\Repository;

use CleanPhp\Domain\Repository\Contracts\IInvoiceRepository;

class InvoiceRepository extends AbstractDoctrineRepository
    implements IInvoiceRepository
{
    /**
     * @var string
     */
    protected $entityClass = 'CleanPhp\Domain\Entity\Invoice';
}
