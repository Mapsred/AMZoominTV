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
		parent::__construct($database, "ORM\\Entity\\User", "ORM\\Repository\\UserRepository");
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
	 * @return User|null
	 */
	public function findOneBy(array $array)
	{
		return parent::findOneBy($array);
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