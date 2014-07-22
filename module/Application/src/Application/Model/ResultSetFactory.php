<?php

namespace Application\Model;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Zend\Db\ResultSet\HydratingResultSet;

class ResultSetFactory implements FactoryInterface 
{
	public function createService(ServiceLocatorInterface $serviceLocator) 
	{
		$rowObject = new \Application\Entity\Status();
		return new HydratingResultSet(new ClassMethodsHydrator(), $rowObject);
	}
}
