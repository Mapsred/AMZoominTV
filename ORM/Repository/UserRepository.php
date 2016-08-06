<?php 

/**
 * Created by PhpStorm
 * User: Maps_red
 * Date: 5/08/16
 * Time: 23:01
 */

namespace ORM\Repository;

use ORM\Entity\User;
use Maps_red\ORM\Abstracts\MainRepository;

class UserRepository extends MainRepository
{
	/**
	 * UserRepository constructor.
	 */
	public function __construct()
	{
		$database = "user";
		parent::__construct($database, "ORM\\Entity\\User");
	}

	/**
	 * @return User|null.
	 */
	public function findOne()
	{
		return parent::findOne();
	}

	/**
	 * @param $id
	 * @return User|null
	 */
	public function findOneById($id)
	{
		return parent::findOneById($id);
	}

	/**
	 * @param array $array
	 * @param array $order
	 * @return User|null
	 */
	public function findOneBy(array $array, array $order = null)
	{
		return parent::findOneBy($array, $order);
	}

	/**
	 * @param User $user
	 * @return User|null.
	 */
	public function save($user)
	{
		return parent::save($user);
	}
}