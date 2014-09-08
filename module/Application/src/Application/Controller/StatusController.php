<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Http\PhpEnvironment\Response;

class StatusController extends AbstractActionController 
{
	/**
	 * 
	 * @var \Application\Model\StatusTable
	 */
	protected $statusTable;
	
	protected function getStatusTable()
	{
		if (null === $this->statusTable) {
			$this->statusTable = $this->getServiceLocator()->get('Application\Model\StatusTable');
		}
		
		return $this->statusTable;
	}
	
	public function indexAction()
	{
		if (($prg = $this->prg()) instanceof Response ) {
			return $prg;
		} 
		
		$statuses = $this->getStatusTable()->fetchAll();
		$form = $this->getServiceLocator()->get('FormElementManager')->get('form.status');
		
		if ( false !== $prg ) {
			$form->setData($prg);
			if ($form->isValid()) {
				$this->getStatusTable()->saveStatus($form->getData());
				$this->flashMessenger()->addSuccessMessage('User\'s status successfully created');
				$this->redirect()->toRoute('status')->setStatusCode(303);
			}
		}
		
		return compact('form', 'statuses');
	}
	
	public function updateAction()
	{
		if (($prg = $this->prg()) instanceof Response ) {
			return $prg;
		} 
		$form = $this->getServiceLocator()->get('FormElementManager')->get('form.status');
		$id = $this->params()->fromRoute('id');
		if (null === $id) {
			$this->flashMessenger()->addWarningMessage('Users\' status update needs an ID');
			$this->redirect()->toRoute('status');
		}
		if ($status = $this->getStatusTable()->getStatus($id)) {
			$form->bind($status);
		} else {
			$this->flashMessenger()->addWarningMessage('Unable to retrieve an user with ID #' . $id);
			$this->redirect()->toRoute('status');
		}
		if ( false !== $prg ) {
			$form->setData($prg);
			if ($form->isValid()) {
				$this->getStatusTable()->saveStatus($form->getData());
				$this->flashMessenger()->addSuccessMessage('Users\' statuses successfully updated');
				$this->redirect()->toRoute('status');
			}
		}
		
		return compact('form', 'id');
	}
	
	public function deleteAction()
	{
		$id = $this->params()->fromRoute('id');
		if ($this->getStatusTable()->deleteStatus($id)) {
			$this->flashMessenger()->addMessage('User\'s status successfully deleted');
		}
		$this->redirect()->toRoute('status');
	}
}
