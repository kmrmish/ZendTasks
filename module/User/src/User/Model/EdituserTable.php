<?php 

namespace User\Model;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

class EdituserTable
{
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	
	
	
	public function getEditUser($id)
	{
		$id = (int) $id;
		$rowset = $this->tableGateway->select(array('id' => $id));
	    $row = $rowset->current();
	    if(!$row){
	    	throw new \Exception("could not find row $id");
	    }
	    return $row;
	}
	
	
	
	
	public function saveEditUser(Edituser $user)
	{
		$data = array(
			'firstname' => $user->firstname,
			'lastname' => $user->lastname,
			
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
			if($this->getEditUser($id))
			{
				$this->tableGateway->update($data,array('id' => $id));
			}
			else 
			{
				throw new \Exception('user id does not exist');
			}
		}
	}
	
	
	
	
}