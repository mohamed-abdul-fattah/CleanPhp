<?php

namespace CleanPhp\Persistence\Doctrine\Repository;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

abstract class RepositoryFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $sl
     * @return mixed
     * @throws \RuntimeException
     */
    public function createService(ServiceLocatorInterface $sl)
    {
        $class = func_get_arg(2);
        $class = 'CleanPhp\Persistence\Doctrine\Repository\\' . $class;
        if (class_exists($class, true)) {
            return new $class(
                $sl->get('Doctrine\ORM\EntityManager')
            );
        }

        throw new \RuntimeException('Unknown Repository requested: ' . $class);
    }

}
