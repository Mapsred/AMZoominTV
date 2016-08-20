<?php 

/**
 * Created by PhpStorm
 * User: Maps_red
 * Date: 19/08/16
 * Time: 21:43
 */

namespace ORM\Repository;

use ORM\Entity\Detail;
use Maps_red\ORM\Abstracts\MainRepository;
use ORM\Entity\Project;

/**
 * Class DetailRepository
 * @package ORM\Repository
 */
class DetailRepository extends MainRepository
{
	/**
	 * DetailRepository constructor.
	 */
	public function __construct()
	{
		$database = "detail";
		parent::__construct($database, "ORM\\Entity\\Detail", "ORM\\Repository\\DetailRepository");
	}

	/**
	 * @return Detail|null.
	 */
	public function findOne()
	{
		return parent::findOne();
	}

	/**
	 * @param $id
	 * @return Detail|null
	 */
	public function findOneById($id)
	{
		return parent::findOneById($id);
	}

	/**
	 * @param array $array
	 * @return Detail|null
	 */
	public function findOneBy(array $array)
	{
		return parent::findOneBy($array);
	}

	/**
	 * @param Detail $detail
	 * @return Detail|null.
	 */
	public function save($detail)
	{
		return parent::save($detail);
	}

    /**
     * @param \Maps_red\ORM\Abstracts\MainEntity $object
     * @param array $data
     * @return object
     */
    public static function hydrate($object, array $data)
    {
        return self::customHydrate($object, $data, ["project"], ["ProjectRepository"]);
    }

    /**
     * @param Project $project
     * @return null|Detail
     */
    public function findOneByProject(Project $project)
    {
        return $this->findOneBy(['project' => $project->getId()]);
    }

}