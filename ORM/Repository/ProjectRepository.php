<?php 

/**
 * Created by PhpStorm
 * User: Maps_red
 * Date: 6/08/16
 * Time: 09:05
 */

namespace ORM\Repository;

use Maps_red\ORM\Builder\QueryBuilder;
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
		parent::__construct($database, "ORM\\Entity\\Project", "ORM\\Repository\\ProjectRepository" );
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
	 * @return Project|null
	 */
	public function findOneBy(array $array)
	{
		return parent::findOneBy($array);
	}

	/**
	 * @param Project $project
	 * @return Project|null.
	 */
	public function save($project)
	{
		return parent::save($project);
	}

    /**
     * @param object $object
     * @param array $data
     * @return Project
     */
    public static function hydrate($object, array $data)
    {
        return self::customHydrate($object, $data, ["type"], ["TypeRepository"]);
    }

    /**
     * @param $name
     * @return array
     */
    public function findByTypeName($name)
    {
        return $this->createQueryBuilder()
            ->leftJoin("type")
            ->where("type.name = $name")
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $name
     * @return Project
     */
    public function findOneByTypeName($name)
    {
        return $this->createQueryBuilder()
            ->leftJoin("type")
            ->where("type.name = $name")
            ->getQuery()
            ->getResult(QueryBuilder::QUERY_UNIQUE);
    }

    /**
     * @param $slug
     * @return array
     */
    public function findByTypeSlug($slug)
    {
        return $this->createQueryBuilder()
            ->leftJoin("type")
            ->where("type.slug = $slug")
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $string
     * @return array
     */
    public function findByString($string)
    {
        $string = "%$string%";
        return $this->createQueryBuilder()
            ->leftJoin("type")
            ->where("type.name LIKE  $string")
            ->orWhere("type.img LIKE $string ")
            ->orWhere("type.slug LIKE  $string")
            ->orWhere("project.title LIKE  $string")
            ->orWhere("project.description LIKE  $string")
            ->orWhere("project.image LIKE  $string")
            ->orWhere("project.slug LIKE  $string")
            ->getQuery()
            ->getResult();
    }

    /**
     * @return array
     */
    public function findAllNotDeleted()
    {
        return $this->createQueryBuilder()
            ->where("deleted_at IS NULL")
            ->getQuery()
            ->getResult();
    }


}