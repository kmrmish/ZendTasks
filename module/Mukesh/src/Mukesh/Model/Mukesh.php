<?php 

namespace Mukesh\Model;

class Mukesh
{
	public $id;
	public $songName;
	public $singer;
	
	public function exchangeArray($data)
	{
		$this->id = (!empty($data['id'])) ? $data['id'] : null;
		$this->songName = (!empty($data['songName'])) ? $data['songName'] : null;
		$this->singer = (!empty($data['singer'])) ? $data['singer'] : null;
	}
}