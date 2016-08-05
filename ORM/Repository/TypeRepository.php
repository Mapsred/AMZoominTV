<?php 

/**
 * Created by PhpStorm
 * User: Maps_red
 * Date: 5/08/16
 * Time: 18:54
 */

namespace ORM\Repository;

use ORM\Entity\Type;
use Maps_red\ORM\Abstracts\MainRepository;

class TypeRepository extends MainRepository
{
	/**
	 * TypeRepository constructor.
	 */
	public function __construct()
	{
		$database = "type";
		parent::__construct($database, "ORM\\Entity\\Type");
	}

	/**
	 * @return Type|null.
	 */
	public function findOne()
	{
		return parent::findOne();
	}

	/**
	 * @param $id
	 * @return Type|null
	 */
	public function findOneById($id)
	{
		return parent::findOneById($id);
	}

	/**
	 * @param array $array
	 * @param array $order
	 * @return Type|null
	 */
	public function findOneBy(array $array, array $order = null)
	{
		return parent::findOneBy($array, $order);
	}

	/**
	 * @param Type $type
	 * @return Type|null.
	 */
	public function save($type)
	{
		return parent::save($type);
	}
}