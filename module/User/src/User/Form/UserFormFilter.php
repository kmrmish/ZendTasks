<?php

namespace User\Form;

use Zend\I18n\Translator\TranslatorAwareInterface;
use Zend\InputFilter\InputFilter;


class UserFormFilter extends InputFilter
{
	public function __construct()
	{
		
		$this->add(array(
				'name' => 'id',
				'required' => true,
				'filters' => array(
						array('name' => 'Int'),
				),
		));
		
         $this->add(array(
			'name' => 'firstname',
			'required' => true,
			'filters' => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
			),
			'validators' => array(
				array(
					'name' => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min' => 1,
						'max' =>10,
					),
				),
			),
		));

        $this->add(array(
			'name' => 'lastname',
			'required' => true,
			'filters' => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
			),
			'validators' => array(
				array(
					'name' => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min' => 1,
						'max' =>100,
					),
				),
			),
		));

		$this->add(array(
			'name' => 'username',
			'required' => true,
			'filters' => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
			),
			'validators' => array(
				array(
					'name' => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min' => 1,
						'max' =>100,
					),
				),
			),
		));
		
		$this->add(array(
				'name' => 'password',
				'required' => true,
				'filters' => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim'),
				),
				'validators' => array(
						array(
								'name' => 'StringLength',
								'options' => array(
										'encoding' => 'UTF-8',
										'min' => 1,
										'max' =>100,
								),
						),
				),
		));
		
		$this->add(array(
				'name' => 'contact',
				'required' => true,
				'filters' => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim'),
				),
				'validators' => array(
						array(
								'name' => 'StringLength',
								'options' => array(
										'encoding' => 'UTF-8',
										'min' => 1,
										'max' =>100,
								),
						),
				),
		));
		
		$this->add(array(
				'name' => 'gender',
				'required' => true,
				
		));
		
	
    }
}