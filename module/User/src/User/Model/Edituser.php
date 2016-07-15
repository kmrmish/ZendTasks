<?php 

namespace User\Model;



use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Edituser
{
	public $id;
	public $firstname;
	public $lastname;
	
	public $contact;
	public $gender;
	
	protected $inputFilter;
	
	public function exchangeArray($data)
	{
		$this->id = (!empty($data['id'])) ? $data['id'] : null;
		$this->firstname = (!empty($data['firstname'])) ? $data['firstname'] : null;
		$this->lastname = (!empty($data['lastname'])) ? $data['lastname'] : null;
		
		$this->contact = (!empty($data['contact'])) ? $data['contact'] : null;
		$this->gender = (!empty($data['gender'])) ? $data['gender'] : null;
	}
	
	
	
	
	
	public function getArrayCopy()
	{
		return get_object_vars($this);
	}
	
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception("Not used");
	}
	
	public function getInputFilter()
	{
		if (!$this->inputFilter) {
			$inputFilter = new InputFilter();
	
			$inputFilter->add(array(
					'name'     => 'firstname',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 1,
											'max'      => 100,
									),
							),
					),
			));
	
			$inputFilter->add(array(
					'name'     => 'lastname',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 1,
											'max'      => 100,
									),
							),
					),
			));
	
			
		
		$inputFilter->add(array(
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
		
		$inputFilter->add(array(
				'name' => 'gender',
				'required' => true,
				
		));
			 
			 
			
			
	
			$this->inputFilter = $inputFilter;
		}
	
		return $this->inputFilter;
	}
}