<?php
/**
 *@author : Vikash
 *@date : 28-08-2014
 *@desc : Album Form class
 */

namespace Chess\Form;

use Zend\I18n\Translator\TranslatorAwareInterface;
use Zend\InputFilter\InputFilter;


class ChessFormFilter extends InputFilter
{
	public function __construct()
	{
        

        $this->add(array(
			'name' => 'playername',
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
			'name' => 'ip',
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
	
    }
}