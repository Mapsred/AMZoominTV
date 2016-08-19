<?php 

/**
 * Created by PhpStorm
 * User: Maps_red
 * Date: 19/08/16
 * Time: 21:42
 */

namespace ORM\Entity;

use Maps_red\ORM\Abstracts\MainEntity;
use ORM\Repository\ProjectRepository;

/**
 * Class Detail
 * @package ORM\Entity
 */
class Detail extends MainEntity
{
	/** @var integer $id */
	private $id;
	/** @var integer $project */
	private $project;
	/** @var string $description */
	private $description;
	/** @var string $image1 */
	private $image1;
	/** @var string $image2 */
	private $image2;
	/** @var string $image3 */
	private $image3;
	/** @var string $image4 */
	private $image4;
	/** @var string $youtube */
	private $youtube;

	/**
	 * @return int
	 */
	 public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 * @return Detail
	 */
	 public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * @return int|Project
	 */
	 public function getProject()
	{
        $repo = new ProjectRepository();
        if (!is_object($this->project)) {
            return $repo->findOneById($this->project);
        }

        return $this->project;
	}

	/**
	 * @param int $project
     * @param boolean $object
     * @return Detail
	 */
	 public function setProject($project, $object = false)
	{
        if ($project instanceof Type  && !$object) {
            $this->project = $project->getId();
        } else {
            $this->project = $project;
        }

        return $this;
    }

	/**
	 * @return string
	 */
	 public function getDescription()
	{
		return $this->description;
	}

	/**
	 * @param string $description
	 * @return Detail
	 */
	 public function setDescription($description)
	{
		$this->description = $description;

		return $this;
	}

	/**
	 * @return string
	 */
	 public function getImage1()
	{
		return $this->image1;
	}

	/**
	 * @param string $image1
	 * @return Detail
	 */
	 public function setImage1($image1)
	{
		$this->image1 = $image1;

		return $this;
	}

	/**
	 * @return string
	 */
	 public function getImage2()
	{
		return $this->image2;
	}

	/**
	 * @param string $image2
	 * @return Detail
	 */
	 public function setImage2($image2)
	{
		$this->image2 = $image2;

		return $this;
	}

	/**
	 * @return string
	 */
	 public function getImage3()
	{
		return $this->image3;
	}

	/**
	 * @param string $image3
	 * @return Detail
	 */
	 public function setImage3($image3)
	{
		$this->image3 = $image3;

		return $this;
	}

	/**
	 * @return string
	 */
	 public function getImage4()
	{
		return $this->image4;
	}

	/**
	 * @param string $image4
	 * @return Detail
	 */
	 public function setImage4($image4)
	{
		$this->image4 = $image4;

		return $this;
	}

	/**
	 * @return string
	 */
	 public function getYoutube()
	{
		return $this->youtube;
	}

	/**
	 * @param string $youtube
	 * @return Detail
	 */
	 public function setYoutube($youtube)
	{
		$this->youtube = $youtube;

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