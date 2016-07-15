
<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Chess\Controller\Chess' => 'Chess\Controller\ChessController',

        ),
    ),

    'router' => array(
        'routes' => array(
            'chess' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/chess[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                       '__NAMESPACE__' => 'Chess\Controller',
                       'controller'    => 'Chess',
                        'action'        => 'index',
                        
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