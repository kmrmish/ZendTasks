<?php


namespace Chess\Form;

use Zend\Form\Form;



class LoginForm extends Form 
{
	public function __construct($name = null)
	{
		parent::__construct('login');
		$this->url = $name;

		$this->add(array(
			'name' => 'playername',
			'type' => 'Text',
			'options' => array(
			    'label' => 'Player Name',
		    ),
		    'attributes' => array(
            	'class'=>'form-control',
               
            )		
		));

        $this->add(array(
			'name' => 'ip',
			'type' => 'hidden',
				
		));

        

		$this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
            	'class'=>'btn btn-default',
                'value' => 'Start Session',
                'id'    => 'submitbutton',
            )
        ));
	}



}

