<?php

namespace Checklist\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Checklist\Form\TaskForm;
use Checklist\Model\TaskEntity;

//for Event manger
Use Checklist\Event\Example;
use Zend\EventManager\EventManager;

class TaskController extends AbstractActionController
{

    public function indexAction()
    {
        $mapper = $this->getTaskMapper();
        
        return new ViewModel(array(
            'tasks' => $mapper->fetchAll()
        ));
    }

    public function addAction()
    {
        $form = new TaskForm();
        $task = new TaskEntity();
        $form->bind($task);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getTaskMapper()->saveTask($task);

                // Redirect to list of tasks
                return $this->redirect()->toRoute('task');
            }
        }

        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int)$this->params('id');
        if (!$id) {
            return $this->redirect()->toRoute('task', array('action'=>'add'));
        }
        $task = $this->getTaskMapper()->getTask($id);

        $form = new TaskForm();
        $form->bind($task);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getTaskMapper()->saveTask($task);

                return $this->redirect()->toRoute('task');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction()
    {
        $id = $this->params('id');
        $task = $this->getTaskMapper()->getTask($id);
        if (!$task) {
            return $this->redirect()->toRoute('task');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($request->getPost()->get('del') == 'Yes') {
                $this->getTaskMapper()->deleteTask($id);
            }

            return $this->redirect()->toRoute('task');
        }

        return array(
            'id' => $id,
            'task' => $task
        );
    }

    /*
     * This function returns instance of TaskMapper Class
     *
     */
    public function getTaskMapper()
    {
        $sm = $this->getServiceLocator();
        return $sm->get('TaskMapper');
    }

    public function eventAction()
    {
        /*
         * Simple Event manager
         * --------------------------------
        $events = new EventManager();
        //Attaching Event
        $events->attach('do', function ($e) {
            $event = $e->getName();
            $params = $e->getParams();
            printf(
                'Handled event "%s", with parameters %s',
                $event,
                json_encode($params)
            );
        });

        $params = array('foo' => 'bar', 'baz' => 'bat');
        $events->trigger('do', null, $params); //Triggering event
        --------------------------------------
        */


        $example = new Example();

        $example->getEventManager()->attach('exampleDo', function($e) {
            $event  = $e->getName();
            $target = get_class($e->getTarget()); // "Example"
            $params = $e->getParams();
            printf(
                'Handled event "%s" on target "%s", with parameters %s',
                $event,
                $target,
                json_encode($params)
            );
        });

        $example->exampleDo('bar', 'bat'); // call to do method will trigger the do event
        die("Event Manager Exercise");
    }

}

