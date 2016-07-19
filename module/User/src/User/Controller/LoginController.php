<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Model\Login;     // importing User model
use User\Form\LoginForm;  // importing User Form
use Zend\Db\Adapter\Adapter;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;

class LoginController extends AbstractActionController {

    protected $loginTable;
    protected $authservice;

    public function indexAction() {
        $form = new LoginForm();
        $form->get('submit')->setValue('Add');
        return array('form' => $form);
    }

    public function getLoginTable() {
        if (!$this->loginTable) {
            $sm = $this->getServiceLocator();
            $this->loginTable = $sm->get('User\Model\LoginTable');
        }
        return $this->loginTable;
    }

    public function getAuthService() {

        if (!$this->authservice) {
            $sm = $this->getServiceLocator();
            $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
            $dbTableAuthAdapter = new DbTableAuthAdapter($dbAdapter, 'user', 'username', 'password');
            $authService = new AuthenticationService();
            $authService->setAdapter($dbTableAuthAdapter);
            $this->authservice = $authService;
        }
        return $this->authservice;
    }

    public function processAction() {
        $this->getAuthService()->getAdapter()
                ->setIdentity($this->request->getPost('username'))
                ->setCredential($this->request->getPost('password'));
        $result = $this->getAuthService()->authenticate();
        if ($result->isValid()) {
            $this->getAuthService()->getStorage()->write($this->request->getPost('username'));
            //rendering confirmation page...........
            $view = new ViewModel();
            $view->setTemplate('user/login/confirm.phtml');

            return $view;
        } else {
            return $this->redirect()->toRoute(NULL, array(
                        'controller' => 'User',
                        'action' => 'index'
            ));
        }
    }

    public function confirmAction() {
        $user_email = $this->getAuthService()->getStorage()->read();
        $viewModel = new ViewModel(array(
            'username' => $user_email
        ));
        return $viewModel;
    }

}
