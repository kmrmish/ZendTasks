<?php
/*
 *@author : Ashwani Singh
 *@date : 30-09-2013  
 */

namespace User;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

use User\Model\User;
use User\Model\UserTable;
use User\Model\Edituser;
use User\Model\EdituserTable;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;

use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

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
    		    'User\Model\UserTable' => function($sm) {
    		    	$tableGateway = $sm->get('UserTableGateway');
    		    	$table        = new UserTable($tableGateway);
    		    	return $table;
    		    },
    		    
    		    
    		    'UserTableGateway' => function($sm) {
    		    	$dbAdapter          = $sm->get('Zend\Db\Adapter\Adapter');
    		    	$resultSetPrototype = new ResultSet();
    		    	$resultSetPrototype->setArrayObjectPrototype(new User());
    		    	return new TableGateway('user', $dbAdapter, null, $resultSetPrototype);
    		    }, 
    		    
    		    'User\Model\EdituserTable' => function($sm) {
    		    	$tableGateway = $sm->get('EdituserTableGateway');
    		    	$table        = new EdituserTable($tableGateway);
    		    	return $table;
    		    },
    		    
    		    
    		    'EdituserTableGateway' => function($sm) {
    		    	$dbAdapter          = $sm->get('Zend\Db\Adapter\Adapter');
    		    	$resultSetPrototype = new ResultSet();
    		    	$resultSetPrototype->setArrayObjectPrototype(new Edituser());
    		    	return new TableGateway('user', $dbAdapter, null, $resultSetPrototype);
    		    },
    		    
    		  
    		    'AppEmail' => function($sm) { 
    		        $appConfig = $sm->get('config');
    		    	$transport = new SmtpTransport();
				    $options = new SmtpOptions($appConfig['email_setting']);
				    $transport->setOptions($options);
				return $transport;
    		    },
    	    ),
    	);
    	
    }


}
