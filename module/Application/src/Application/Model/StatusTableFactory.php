<?php

namespace Application\Model;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class StatusTableFactory implements FactoryInterface 
{
	public function createService(ServiceLocatorInterface $serviceLocator) 
	{
		$dbAdapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
		$resultSet = $serviceLocator->get('Application\Model\ResultSet');
		return new StatusTable($dbAdapter, $resultSet);
	}
}
