<?php

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'MiniModule\Controller\Index',
                        'action' => 'index'
                    )
                )
            ),
            'default' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                  'route' => '/:action',
                    'constraints' => array(),
                    'defaults' => array(
                        'controller' => 'MiniModule\Controller\Index',
                        'action' => 'index'
                    ),
                ),
            ),
        )
    ),

    'view_manager' => array(
        'template_map' => array(
            '404' => __DIR__ . '/../view/404.phtml',
            'error' => __DIR__ . '/../view/error.phtml',
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'layout/form-auth' => __DIR__ . '/../view/layout/formAuth.phtml',
            'layout/info-auth' => __DIR__ . '/../view/layout/infoAuth.phtml',
         ),
        // voir zend-mvc/src/Service/ViewTemplatePathStack
        'template_path_stack' => array( __DIR__.'/../view/', ),

    ),

    'controllers' => array(
        'invokables' => array(
            'MiniModule\Controller\Index' => 'MiniModule\Controller\IndexController',
        )
    ),

    'service_manager' => array(
        'factories' => array(
            'MiniModule\Form\Authentification' => 'MiniModule\Form\AuthentificationFormFactory',
            'MiniModule\Form\NewUser' => 'MiniModule\Form\NewUserFormFactory',
        ),
        'services' => array(
            'session' => new \Zend\Session\Container('minimodule'),
            'mini-module\form\config' => include __DIR__.'/form.config.php',
        ),
    ),
);