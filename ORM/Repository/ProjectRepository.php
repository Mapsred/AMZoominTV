<?php 

/**
 * Created by PhpStorm
 * User: Maps_red
 * Date: 5/08/16
 * Time: 18:48
 */

namespace ORM\Repository;

use ORM\Entity\Project;
use Maps_red\ORM\Abstracts\MainRepository;

class ProjectRepository extends MainRepository
{
	/**
	 * ProjectRepository constructor.
	 */
	public function __construct()
	{
		$database = "project";
		parent::__construct($database, "ORM\\Entity\\Project");
	}

	/**
	 * @return Project|null.
	 */
	public function findOne()
	{
		return parent::findOne();
	}

	/**
	 * @param $id
	 * @return Project|null
	 */
	public function findOneById($id)
	{
		return parent::findOneById($id);
	}

	/**
	 * @param array $array
	 * @param array $order
	 * @return Project|null
	 */
	public function findOneBy(array $array, array $order = null)
	{
		return parent::findOneBy($array, $order);
	}

	/**
	 * @param Project $project
	 * @return Project|null.
	 */
	public function save($project)
	{
		return parent::save($project);
	}
}