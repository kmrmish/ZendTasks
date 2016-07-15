<?php
namespace Chess;


use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

use Chess\Model\Chess;
use Chess\Model\ChessTable;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;


class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Chess\Model\ChessTable' => function($sm) {
                    $tableGateway = $sm->get('ChessTableGateway');
                    $table        = new ChessTable($tableGateway);
                    return $table;
                },
                'ChessTableGateway' => function($sm) {
                    $dbAdapter          = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Chess());
                    return new TableGateway('chess', $dbAdapter, null, $resultSetPrototype);
                }, 
            ),
        );
        
    }
}
