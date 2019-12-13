<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\ServiceManager\Factory\InvokableFactory;
use CleanPhp\Domain\Service\CustomerInputFilter;
use Application\Controller\CustomersController;
use Zend\ServiceManager\ServiceManager;
use Zend\Hydrator\ClassMethods;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'customers' => [
                'may_terminate' => true,
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/customers',
                    'defaults' => [
                        'controller' => Controller\CustomersController::class,
                        'action'     => 'index',
                    ],
                ],
                'child_routes' => [
                    'create' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/new',
                            'defaults' => [
                                'action' => 'new',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            Controller\CustomersController::class => function($sm) {
              /** @var ServiceManager $sm */
              return new CustomersController(
                  $sm->get('CustomerTable'),
                  new CustomerInputFilter(),
                  new ClassMethods()
              );
            }
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'view_helpers' => [
        'invokables'   => [
            'validationErrors' => View\Helper\ValidationErrors::class,
        ]
    ]
];
