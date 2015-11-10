<?php

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'MiniModule\Controller\IndexController',
                        'action' => 'index'
                    )
                )
            )
        )
    ),

    'view_manager' => array(
        'template_map' => array(
            '404' => __DIR__ . '/../view/404.phtml',
            'error' => __DIR__ . '/../view/error.phtml',
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',

            'mini-module/index/index' => __DIR__ . '/../view/index/index.phtml',
        ),
    ),

    'controllers' => array(
        'services' => array(
            'MiniModule\Controller\IndexController' => new MiniModule\IndexController(),
        )
    )
);