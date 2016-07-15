<?php 

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use User\Model\User;     // importing User model
use User\Form\UserForm;  // importing User Form
use User\Model\Login;     // importing User model
use User\Form\LoginForm;  // importing User Form
use User\Model\Edituser;
use User\Form\EdituserForm;


class AdminController extends AbstractActionController
{
	protected $userTable;
	protected $edituserTable;
	
    public function adminAction()
	{
	    
	    $view = new ViewModel(array(
            'users' => $this->getUserTable()->fetchAll(),  
        ));
	    
	    $view->setTemplate('user/admin/admin.phtml');
	    
	    return $view;
	    
		
	}
	
	public function getUserTable()
	{
		if(!$this->userTable){
			$sm = $this->getServiceLocator();
			$this->userTable = $sm->get('User\Model\UserTable');
		}
		return $this->userTable;
	}
	
	public function getEditUserTable()
	{
		if(!$this->edituserTable){
			$sm = $this->getServiceLocator();
			$this->edituserTable = $sm->get('User\Model\EdituserTable');
		}
		return $this->edituserTable;
	}
	
	public function editAction()
	{
		$id = (int) $this->params()->fromRoute('id', 0);

		try {
			$user = $this->getEditUserTable()->getEditUser($id);
		}
		catch (\Exception $ex) {
			return $this->redirect()->toRoute('admin', array(
					'action' => 'admin'
			));
		}
	
		$form  = new EdituserForm();
		
		
		
		$form->bind($user);
		$form->get('submit')->setAttribute('value', 'Edit');
	
		$request = $this->getRequest();
		if ($request->isPost()) {
			$form->setInputFilter($user->getInputFilter());
			$form->setData($request->getPost());
			
			if ($form->isValid()) {
			    
				$this->getEditUserTable()->saveEditUser($user);
	
				// Redirect to list of albums
				return $this->redirect()->toRoute('admin');
			}
		}
		
		return array(
				'id' => $id,
				'form' => $form,
		);
	}
	
	
	
	
	public function deleteAction()
	{
		$id = (int) $this->params()->fromRoute('id', 0);
		if (!$id) {
			return $this->redirect()->toRoute('admin');
		}
	
		$request = $this->getRequest();
		if ($request->isPost()) {
			$del = $request->getPost('del', 'No');
	
			if ($del == 'Yes') {
				$id = (int) $request->getPost('id');
				$this->getUserTable()->deleteUser($id);
			}
	
			// Redirect to list of albums
			return $this->redirect()->toRoute('admin', array(
				'action' => 'admin'
		    ));
		}
	
		return array(
		    'id'    => $id,
		    'user' => $this->getUserTable()->getUser($id)
		);
		
		
	}
	
	
}

