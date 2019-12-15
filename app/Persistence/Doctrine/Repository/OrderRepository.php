<?php

namespace CleanPhp\Persistence\Doctrine\Repository;

use CleanPhp\Domain\Repository\Contracts\IOrderRepository;
use Doctrine\ORM\Query\Expr\Join;

class OrderRepository extends AbstractDoctrineRepository
    implements IOrderRepository
{
    /**
     * @var string
     */
    protected $entityClass = 'CleanPhp\Domain\Entity\Order';

    /**
     * @return array|mixed
     */
    public function getUnInvoicedOrders()
    {
        $builder = $this->entityManager->createQueryBuilder()
            ->select('o')
            ->from($this->entityClass, 'o')
            ->leftJoin(
                'CleanPhp\Domain\Entity\Invoice',
                'i',
                Join::WITH,
                'i.order = o'
            )
            ->where('i.id IS NULL');
        return $builder->getQuery()->getResult();
    }

}
