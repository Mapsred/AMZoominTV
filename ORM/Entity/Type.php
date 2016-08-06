<?php 

/**
 * Created by PhpStorm
 * User: Maps_red
 * Date: 5/08/16
 * Time: 19:14
 */

namespace ORM\Entity;

use Maps_red\ORM\Abstracts\MainEntity;

class Type extends MainEntity
{
	/** @var integer $id */
	private $id;
	/** @var string $name */
	private $name;
	/** @var string $img */
	private $img;
	/** @var string $slug */
	private $slug;

	/**
	 * @return int
	 */
	 public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 * @return Type
	 */
	 public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * @return string
	 */
	 public function getName()
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 * @return Type
	 */
	 public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * @return string
	 */
	 public function getImg()
	{
		return $this->img;
	}

	/**
	 * @param string $img
	 * @return Type
	 */
	 public function setImg($img)
	{
		$this->img = $img;

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
	 * @return Type
	 */
	 public function setSlug($slug)
	{
		$this->slug = $slug;

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