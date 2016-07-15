<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Mukesh\Controller\Mukesh' => 'Mukesh\Controller\MukeshController',

        ),
    ),
    'router' => array(
        'routes' => array(
            'mukesh' => array(
        		'type' => 'Segment',
        		'options' => array(
        			'route' => '/mukesh[/:action][/:id]',
        			'constraints' => array(
        				'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
        				'id' => '[0-9]+',
        			),
        			'defaults' => array(
        				'controller' => 'Mukesh\Controller\Mukesh',
        				'action' => 'index',
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
