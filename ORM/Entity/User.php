<?php 

/**
 * Created by PhpStorm
 * User: Maps_red
 * Date: 5/08/16
 * Time: 23:01
 */

namespace ORM\Entity;

use Maps_red\ORM\Abstracts\MainEntity;

class User extends MainEntity
{
	/** @var integer $id */
	private $id;
	/** @var string $username */
	private $username;
	/** @var string $password */
	private $password;
	/** @var \DateTime $last_seen */
	private $last_seen;

	/**
	 * @return int
	 */
	 public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 * @return User
	 */
	 public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * @return string
	 */
	 public function getUsername()
	{
		return $this->username;
	}

	/**
	 * @param string $username
	 * @return User
	 */
	 public function setUsername($username)
	{
		$this->username = $username;

		return $this;
	}

	/**
	 * @return string
	 */
	 public function getPassword()
	{
		return $this->password;
	}

	/**
	 * @param string $password
	 * @return User
	 */
	 public function setPassword($password)
	{
		$this->password = $password;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	 public function getLastSeen()
	{
		return $this->last_seen;
	}

	/**
	 * @param \DateTime $last_seen
	 * @return User
	 */
	 public function setLastSeen($last_seen)
	{
		$this->last_seen = $last_seen;

		return $this;
	}

	/**
	 * @param bool $set
	 * @return array
	 */
	 public function getFields($set = false)
	{
		return self::_getFields(__CLASS__, $set);
	}
}