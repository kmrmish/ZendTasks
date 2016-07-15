<?php 

namespace User\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;

class LoginTable
{
	protected $tableGateway;
	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	
	public function fetchAll()
	{
		$resultSet = $this->tableGateway->select();
		return $resultSet;
		
	}
	
// 	public function authenticate(Login $login)
// 	{
// 		$data = array(
// 			'username' => $login->username,
// 			'password' => $login->password,
//  		);
		
// 		$this->getAuthService()->getAdapter()->setIdentity($this->request->getPost('email'))->setCredential($this->request->getPost('password'));
// 		$result = $this->getAuthService()->authenticate();
// 		if ($result->isValid()) {
// 			$this->getAuthService()->getStorage()->write($this->request->getPost('email'));
// 			return $this->redirect()->toRoute(NULL , array(
// 					'controller' => 'login',
// 					'action' => 'confirm'
// 			));
// 		}	
// 	}	
}