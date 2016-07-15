<?php

namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Album\Model\Album;     // importing Album model
use Album\Form\AlbumForm;  // importing Album Form



class AlbumController extends AbstractActionController
{
    protected $albumTable;

    public function indexAction() 
    {
        return new ViewModel(array(
            'albums' => $this->getAlbumTable()->fetchAll(),
        ));
    }
    
    public function addAction()
    {
        $form = new AlbumForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();  // getting current request object
        if ($request->isPost()) {
            $album = new Album(); //form data goes into this object.....
            $form->setInputFilter($album->getInputFilter());//validating form data
            $form->setData($request->getPost());  // setting requested data to form object

            if ($form->isValid()) {//if validation is successful an form data is filled into album object
                $album->exchangeArray($form->getData());
                $this->getAlbumTable()->saveAlbum($album);//saving into database

                // Redirect to list of albums
                return $this->redirect()->toRoute('album'); //redirecting to album page
            }
        }
        return array('form' => $form); //if not data is posted then simply form is returned

    }
    
    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);//getting id of newly entered album
        if (!$id) {//if id is not in the database then simply new album is added into database 
            return $this->redirect()->toRoute('album', array(
                'action' => 'add'
            ));
        }

        // Get the Album with the specified id.  An exception is thrown
        // if it cannot be found, in which case go to the index page.
        try {
            $album = $this->getAlbumTable()->getAlbum($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('album', array(
                'action' => 'index'
            ));
        }

        $form  = new AlbumForm();
        $form->bind($album);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getAlbumTable()->saveAlbum($album);

                // Redirect to list of albums
                return $this->redirect()->toRoute('album');
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
            return $this->redirect()->toRoute('album');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getAlbumTable()->deleteAlbum($id);
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('album');
        }

        return array(
            'id'    => $id,
            'album' => $this->getAlbumTable()->getAlbum($id)
        );
    }

    /*
     * Return list of albums
     *
     */
    public function getAlbumTable()
    {
        if (!$this->albumTable) {
            $serviceManager   = $this->getServiceLocator();
            $this->albumTable = $serviceManager->get('Album\Model\AlbumTable');
        }
        return $this->albumTable;
    }
    

}
