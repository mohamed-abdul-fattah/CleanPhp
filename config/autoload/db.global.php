<?php

return [
    'doctrine' => [
        'driver' => [
            'orm_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\YamlDriver',
                'cache' => 'array',
                'paths' => [
                    realpath(__DIR__ . '/../../app/Domain/Entity'),
                    realpath(__DIR__ . '/../../app/Persistence/Doctrine/Mapping')
                ],
            ],
            'orm_default' => [
                'drivers' => ['CleanPhp\Domain\Entity' => 'orm_driver']
            ]
        ],
    ],
];
