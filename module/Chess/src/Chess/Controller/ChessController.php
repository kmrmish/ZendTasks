<?php


namespace Chess\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
//use User\Model\Login;     // importing User model
use Chess\Form\LoginForm;  // importing User Form
use Zend\Db\Adapter\Adapter;

class ChessController extends AbstractActionController
{
    public function indexAction()
    {
    	$form = new LoginForm();
		
		return array('form' => $form);
        
    }

    public function boardAction()
    {
    	return new ViewModel();
    }
}