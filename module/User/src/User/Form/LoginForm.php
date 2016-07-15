<?php

namespace User\Form;

use Zend\Form\Form;



class LoginForm extends Form 
{
	public function __construct($name = null)
	{
		parent::__construct('login');
		$this->url = $name;

		

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
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => array(
                'value' => 'Go',
                'id'    => 'submitbutton',
            )
        ));
		
		
	}



}