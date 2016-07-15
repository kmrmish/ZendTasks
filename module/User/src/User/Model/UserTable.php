<?php 

namespace User\Model;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

class UserTable
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
	
	public function getUser($id)
	{
		$id = (int) $id;
		$rowset = $this->tableGateway->select(array('id' => $id));
	    $row = $rowset->current();
	    if(!$row){
	    	throw new \Exception("could not find row $id");
	    }
	    return $row;
	}
	
	public function getUserColumns($id)
	{
	    $select = new Select();
	    $select->columns(array('firstname', 'lastname','contact','gender'));
	    
		$id = (int) $id;
		
		
		$rowset = $this->tableGateway->select(array('id' => $id));
		
		$row = $rowset->current();
		if(!$row){
			throw new \Exception("could not find row $id");
		}
		return $row;
	}
	
	
	
	
	
	public function saveUser(User $user)
	{
		$data = array(
			'firstname' => $user->firstname,
			'lastname' => $user->lastname,
			'username' => $user->username,
			'password' => $user->password, 
			'contact' => $user->contact,
			'gender' => $user->gender
 		);
		
		$id = (int) $user->id;
		if($id == 0)
		{
			$this->tableGateway->insert($data);
		}
		else
		{
			if($this->getUser($id))
			{
				$this->tableGateway->update($data,array('id' => $id));
			}
			else 
			{
				throw new \Exception('user id does not exist');
			}
		}
	}
	
	
	
	
	
	public function deleteUser($id)
	{
		$this->tableGateway->delete(array('id'=>(int) $id));
	}
	
}