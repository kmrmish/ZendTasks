<?php
/**
 *@author : Ashwani Singh
 *@date : 01-10-2013
 *@desc : Album Form class
 */

namespace Album\Form;

use Zend\I18n\Translator\TranslatorAwareInterface;
use Zend\InputFilter\InputFilter;


class AlbumFormFilter extends InputFilter
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
			'name' => 'artist',
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
			'name' => 'title',
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