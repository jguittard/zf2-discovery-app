<?php

namespace Application\Entity;

use Zend\Stdlib\ArraySerializableInterface;

class Status implements ArraySerializableInterface
{
	/**
	 * 
	 * @var int
	 */
	protected $id;
	
	/**
	 * 
	 * @var string
	 */
	protected $user;
	
	/**
	 * 
	 * @var string
	 */
	protected $message;
	
	/**
	 * 
	 * @var string
	 */
	protected $created_at;
	
	/**
	 * 
	 * @var string
	 */
	protected $updated_at;
	
	/**
	 *
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	
	/**
	 *
	 * @return string
	 */
	public function getUser() {
		return $this->user;
	}
	
	/**
	 *
	 * @param string $user        	
	 */
	public function setUser($user) {
		$this->user = $user;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getMessage() {
		return $this->message;
	}
	
	/**
	 *
	 * @param string $message        	
	 */
	public function setMessage($message) {
		$this->message = $message;
		return $this;
	}
	
	/**
	 *
	 * @return string
	 */
	public function getCreatedAt() {
		return $this->created_at;
	}
	
	/**
	 *
	 * @param string $created_at        	
	 */
	public function setCreatedAt($created_at) {
		$this->created_at = $created_at;
		return $this;
	}
	
	/**
	 *
	 * @return string
	 */
	public function getUpdatedAt() {
		return $this->updated_at;
	}
	
	/**
	 *
	 * @param string $updated_at        	
	 */
	public function setUpdatedAt($updated_at) {
		$this->updated_at = $updated_at;
		return $this;
	}
		
	/**
	 * Exchange internal values from provided array
	 *
	 * @param  array $array
	 * @return void
	 */
	public function exchangeArray(array $array)
	{
		$this->id = isset($array['id']) ? $array['id'] : null;
		$this->user = isset($array['user']) ? $array['user'] : null;
		$this->message = isset($array['message']) ? $array['message'] : null;
		$this->created_at = isset($array['created_at']) ? $array['created_at'] : null;
		$this->updated_at = isset($array['updated_at']) ? $array['updated_at'] : null;
	}
	
	/**
	 * Return an array representation of the object
	 *
	 * @return array
	*/
	public function getArrayCopy()
	{
		return array(
			'id' => $this->id == 0 ? null : $this->id,
			'user' => $this->user,
			'message' => $this->message,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
		);
	}
}
