<?php 

namespace Mukesh\Model;

use Zend\Db\TableGateway\TableGateway;

class MukeshTable
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
	
	public function getSong($id)
	{
		$id = (int) $id;
		$rowset = $this->tableGateway->select(array('id' => $id));
	    $row = $rowset->current();
	    if(!$row){
	    	throw new \Exception("could not find row $id");
	    }
	    return $row;
	}
	
	public function saveSong(Mukesh $song)
	{
		$data = array(
			'songName' => $song->songName,
			'singer'  => $song->singer
 		);
		
		$id = (int) $song->id;
		if($id == 0)
		{
			$this->tableGateway->insert($data);
		}
		else
		{
			if($this->getSong($id))
			{
				$this->tableGateway->update($data,array('id' => $id));
			}
			else 
			{
				throw new \Exception('song id does not exist');
			}
		}
	}
	
	
	
	public function deleteSong($id)
	{
		$this->tableGateway->delete(array('id'=>(int) $id));
	}
	
}