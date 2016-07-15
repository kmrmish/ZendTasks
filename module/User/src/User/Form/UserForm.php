<?php

namespace User\Form;

use Zend\Form\Form;



class UserForm extends Form 
{
	public function __construct($name = null)
	{
		parent::__construct('user');
		$this->url = $name;

		$this->add(array(
				'name' => 'id',
				'type' => 'Hidden',
		));
		
		$this->add(array(
			'name' => 'firstname',
			'type' => 'Text',
			'options' => array(
			    'label' => 'firstname',
		    ),		
		));

        $this->add(array(
			'name' => 'lastname',
			'type' => 'Text',
			'options' => array(
			    'label' => 'lastname',
		    ),		
		));

        $this->add(array(
			'name' => 'username',
			'type' => 'Text',
			'options' => array(
			    'label' => 'usrname',
		    )		
		));
        
        $this->add(array(
        		'name' => 'password',
        		'type' => 'Text',
        		'options' => array(
        				'label' => 'password',
        		)
        ));

        $this->add(array(
        		'name' => 'contact',
        		'type' => 'Text',
        		'options' => array(
        				'label' => 'contact',
        		)
        ));
        
    
      
     $this->add(array(
     		'name' => 'gender',
     		'type' => 'Radio',
     		'options' => array(
     				
     				'value_options' => array(
     			               '1' =>'female',
     						   '2' => 'male',		
     		    ),	
     		)
     ));
     
     
     
		$this->add(array(
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => array(
                'value' => 'Go',
                'id'    => 'submitbutton',
            )
        ));
		
		
	}



}