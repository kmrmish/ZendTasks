<?php 

namespace Mukesh\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Mukesh\Model\Mukesh;     // importing Album model
use Mukesh\Form\MukeshForm;  // importing Album Form


class MukeshController extends AbstractActionController
{
	protected $mukeshTable;
	
	public function indexAction()
	{
		return new ViewModel(array(
			'song'=> $this->getMukeshTable()->fetchAll(),
		));
	}
	
	public function addAction()
	{
		
	}
	
	public function editAction()
	{
		
	}
	
    public function deleteAction()
	{
		
	}
	
	public function getMukeshTable()
	{
		if(!$this->mukeshTable){
			$sm = $this->getServiceLocator();
			$this->mukeshTable = $sm->get('Mukesh\Model\MukeshTable');
		}
		return $this->mukeshTable;
	}
	
	
	
}

