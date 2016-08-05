<?php 

/**
 * Created by PhpStorm
 * User: Maps_red
 * Date: 5/08/16
 * Time: 18:48
 */

namespace ORM\Entity;

use Maps_red\ORM\Abstracts\MainEntity;
use ORM\Repository\TypeRepository;

class Project extends MainEntity
{
	/** @var integer $id */
	private $id;
	/** @var string $title */
	private $title;
	/** @var string $description */
	private $description;
	/** @var string $image */
	private $image;
	/** @var integer $type */
	private $type;
	/** @var string $slug */
	private $slug;
	/** @var \DateTime $updated_at */
	private $updated_at;
	/** @var \DateTime $created_at */
	private $created_at;
	/** @var \DateTime $deleted_at */
	private $deleted_at;

	/**
	 * @return int
	 */
	 public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 * @return Project
	 */
	 public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * @return string
	 */
	 public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @param string $title
	 * @return Project
	 */
	 public function setTitle($title)
	{
		$this->title = $title;

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
	 * @return Project
	 */
	 public function setDescription($description)
	{
		$this->description = $description;

		return $this;
	}

	/**
	 * @return string
	 */
	 public function getImage()
	{
		return $this->image;
	}

	/**
	 * @param string $image
	 * @return Project
	 */
	 public function setImage($image)
	{
		$this->image = $image;

		return $this;
	}

    /**
     * @return int|Type
     */
    public function getType()
    {
        $repo = new TypeRepository();
        if (!is_object($this->type)) {
            return $repo->findOneById($this->type);
        }

        return $this->type;
    }

    /**
     * @param int|Type $type
     * @return Project
     */
    public function setType($type)
    {
        if ($type instanceof Type) {
            $this->type = $type->getId();
        } else {
            $this->type = $type;
        }

        return $this;
    }

	/**
	 * @return string
	 */
	 public function getSlug()
	{
		return $this->slug;
	}

	/**
	 * @param string $slug
	 * @return Project
	 */
	 public function setSlug($slug)
	{
		$this->slug = $slug;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	 public function getUpdated_at()
	{
		return $this->updated_at;
	}

	/**
	 * @param \DateTime $updated_at
	 * @return Project
	 */
	 public function setUpdated_at($updated_at)
	{
		$this->updated_at = $updated_at;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	 public function getCreated_at()
	{
		return $this->created_at;
	}

	/**
	 * @param \DateTime $created_at
	 * @return Project
	 */
	 public function setCreated_at($created_at)
	{
		$this->created_at = $created_at;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	 public function getDeleted_at()
	{
		return $this->deleted_at;
	}

	/**
	 * @param \DateTime $deleted_at
	 * @return Project
	 */
	 public function setDeleted_at($deleted_at)
	{
		$this->deleted_at = $deleted_at;

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