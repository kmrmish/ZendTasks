<?php
/*
 *@author : Ashwani Singh
 *@date : 30-09-2013  
 */

namespace Mukesh;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

use Mukesh\Model\Mukesh;
use Mukesh\Model\MukeshTable;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;


class Module
{
    
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
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getServiceConfig()
    {
    	return array(
    		'factories' => array(
    		    'Mukesh\Model\MukeshTable' => function($sm) {
    		    	$tableGateway = $sm->get('MukeshTableGateway');
    		    	$table        = new MukeshTable($tableGateway);
    		    	return $table;
    		    },
    		    'MukeshTableGateway' => function($sm) {
    		    	$dbAdapter          = $sm->get('Zend\Db\Adapter\Adapter');
    		    	$resultSetPrototype = new ResultSet();
    		    	$resultSetPrototype->setArrayObjectPrototype(new Mukesh());
    		    	return new TableGateway('song', $dbAdapter, null, $resultSetPrototype);
    		    }, 
    	    ),
    	);
    	
    }


}
