<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'User\Controller\User' => 'User\Controller\UserController',
            'User\Controller\Login' => 'User\Controller\LoginController',
            'User\Controller\Admin' => 'User\Controller\AdminController',

        ),
    ),
    'router' => array(
        'routes' => array(
            'user' => array(
        		'type' => 'Segment',
        		'options' => array(
        			'route' => '/user[/:action][/:id]',
        			'constraints' => array(
        				'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
        				'id' => '[0-9]+',
        			),
        			'defaults' => array(
        				'controller' => 'User\Controller\User',
        				'action' => 'index',
        			),
        		),
        	),
            
            'login' => array(
            		'type' => 'Segment',
            		'options' => array(
            				'route' => '/login[/:action][/:id]',
            				'constraints' => array(
            						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            						'id' => '[0-9]+',
            				),
            				'defaults' => array(
            						'controller' => 'User\Controller\Login',
            						'action' => 'index',
            				),
            		),
            ),
            
            'admin' => array(
            		'type' => 'Segment',
            		'options' => array(
            				'route' => '/admin[/:action][/:id]',
            				'constraints' => array(
            						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            						'id' => '[0-9]+',
            				),
            				'defaults' => array(
            						'controller' => 'User\Controller\Admin',
            						'action' => 'admin',
            				),
            		),
            ),
            
           
        ),
    ),
    
    
    
   'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
