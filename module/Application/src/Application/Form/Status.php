<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Zend\InputFilter\InputFilterProviderInterface;

class Status extends Form implements InputFilterProviderInterface
{
	public function __construct()
	{
		parent::__construct('status');
		$this->setHydrator(new ClassMethodsHydrator())
		     ->setObject(new \Application\Entity\Status());
		$this->setAttribute('role', 'form');
		
		$this->add(array(
			'name' => 'id',
			'type' => 'hidden',
		));
		
		$this->add(array(
			'name' => 'user',
			'type' => 'text',
			'options' => array(
				'label' => 'User',
				'label_attributes' => array('class' => 'control-label col-sm-2'),
			),
			'attributes' => array(
				'class' => 'form-control',
				'placeholder' => 'User pseudo',
			),
		));
		$this->add(array(
			'name' => 'message',
			'type' => 'text',
			'options' => array(
				'label' => 'Message',
				'label_attributes' => array('class' => 'control-label col-sm-2'),
			),
			'attributes' => array(
				'class' => 'form-control',
				'placeholder' => 'User message',
			),
		));
		
		$this->add(array(
			'name' => 'csrf',
			'type' => 'csrf',
		));
		
		$this->add(array(
			'name' => 'submit',
			'type' => 'submit',
			'attributes' => array(
				'value' => 'Save status',
				'class' => 'btn btn-success',
			)
		));
	}
	
	public function getInputFilterSpecification()
	{
		return array(
			'user' => array(
				'required' => true,
				'validators' => array(
					array(
						'name' => 'InArray',
						'options' => array(
							'haystack' => array('jguittard', 'jdoe'),
						),
					),
				),
			),
			'message' => array(
				'required' => true,
				'filters' => array(
                    			array(
						'name' => 'StringTrim'
					),
                    			array(
						'name' => 'StripTags'
					),
                		),
				'validators' => array(
					array(
						'name' => 'StringLength',
						'options' => array(
							'min' => 3,
							'max' => 140,
						),
					),
				),
			),
		);
	}
}
