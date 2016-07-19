<?php 

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use User\Model\User;     // importing User model
use User\Form\UserForm;  // importing User Form
use User\Model\Login;     // importing User model
use User\Form\LoginForm;  // importing User Form


use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;


use Zend\Mail\Transport\SmtpOptions;

class UserController extends AbstractActionController
{
	protected $userTable;
	
	public function registrationAction()
	{
		$form = new UserForm();
		$form->get('submit')->setValue('Add');
		
		$request = $this->getRequest();  // getting current request object
		if ($request->isPost()) {
			$user = new User();
			$form->setInputFilter($user->getInputFilter());
			$form->setData($request->getPost());  // setting requested data to form object
		
			if ($form->isValid()) {
				$user->exchangeArray($form->getData());
				$this->getUserTable()->saveUser($user);
				
		         //sending mail to the user's email id
				$message = new Message();
				$message->addTo('leena.chauhan@osscube.com')
				->addFrom('leena.chauhan@osscube.com')
				->setSubject('zend framework testing by mukesh')
				->setBody("hello this is a test mail......");
				
				// Setup SMTP transport using LOGIN authentication
				$serviceManager =  $this->getServiceLocator();
				$emailApp =$serviceManager->get('AppEmail');
				$emailApp->send($message);
				
				// Redirect to list of albums
				return $this->redirect()->toRoute('login');
			}
		}
		return array('form' => $form);
	}
	
	public function getUserTable()
	{
		if(!$this->userTable){
			$sm = $this->getServiceLocator();
			$this->userTable = $sm->get('User\Model\UserTable');
		}
		return $this->userTable;
	}
	
	public  function sendTestEmailAction()
	{
	    //sending mail to the user's email id
	    $message = new Message();
	    $message->addTo('leena.chauhan@osscube.com')
	    ->addFrom('leena.chauhan@osscube.com')
	    ->setSubject('zend framework testing by mukesh')
	    ->setBody("hello this is a test mail......");
	    // Setup SMTP transport using LOGIN authentication
	    $serviceManager =  $this->getServiceLocator();
	    $emailApp =$serviceManager->get('AppEmail');
	    //$emailApp->send($message);
	    
	    // TO STOP RENDERING VIEW TEMPLATE
	    $response = $this->getResponse();
            $response->setStatusCode(200);
            return $response; 
	    
	}
	
}

