<?php

namespace App\Entity;


class Category
{
    private $id;

    private $name;

    private $slug;

    /**
     * Category constructor.
     *
     * @param $id
     * @param $name
     * @param $slug
     */
    public function __construct($id, $name, $slug)
    {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
    }

    /**
     * @param mixed $id
     *
     * @return Category
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param mixed $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param mixed $slug
     *
     * @return Category
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

}
