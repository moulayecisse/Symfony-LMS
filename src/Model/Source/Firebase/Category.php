<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 07/08/18
 * Time: 11:38.
 */

namespace App\Model\Source\Firebase;

class Category
{
    /**
     * @var string
     */
    private $name = '';

    /**
     * @var string
     */
    private $link = '';

    /**
     * @var array
     */
    private $subCategories = [];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Category
     */
    public function setName(string $name): Category
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     *
     * @return Category
     */
    public function setLink(string $link): Category
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return array
     */
    public function getSubCategories(): array
    {
        return $this->subCategories;
    }

    /**
     * @param array $subCategories
     *
     * @return Category
     */
    public function setSubCategories(array $subCategories): Category
    {
        $this->subCategories = $subCategories;

        return $this;
    }

    /**
     * @param mixed $subCategory
     *
     * @return Category
     */
    public function addSubCategory($subCategory): Category
    {
        $this->subCategories[] = $subCategory;

        return $this;
    }

    /**
     * @param mixed $subCategory
     *
     * @return Category
     */
    public function removeSubCategory($subCategory): Category
    {
        if (false !== $key = array_search($subCategory, $this->subCategories, true)) {
            array_splice($this->subCategories, $key, 1);
        }

        return $this;
    }
}
