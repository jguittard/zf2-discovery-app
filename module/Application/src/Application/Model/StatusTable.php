<?php

namespace Application\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSetInterface;

class StatusTable extends AbstractTableGateway 
{
	protected $table = 'status';
	
	public function __construct(Adapter $adapter, ResultSetInterface $resultSet)
	{
		$this->adapter = $adapter;
		$this->resultSetPrototype = $resultSet;
	}
	
	public function fetchAll($params = array())
	{
		$resultSet = $this->select($params);
		
		return $resultSet;
	}
	
	public function getStatus($id)
	{
		$row = $this->select(array('id' => (int) $id))->current();
		if (!$row)
			return false;
		return $row;
	}
	
	public function saveStatus(\Application\Entity\Status $status) 
	{
		$id = (int)$status->getId();
		
		if ($id == 0) {
			$status->setCreatedAt(date('Y-m-d H:i:s'));
			if (!$this->insert($status->getArrayCopy()))
				return false;
			return $this->getLastInsertValue();
		} else {
			$status->setUpdatedAt(date('Y-m-d H:i:s'));
			if (!$this->update($status->getArrayCopy(), array('id' => $id)))
				return false;
			return $id;
		}
	}
	
	public function deleteStatus($id)
	{
		return $this->delete(array('id' => (int)$id));
	}
}
