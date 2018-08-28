<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 07/08/18
 * Time: 11:38.
 */

namespace App\Model\Source\Firebase;

class SubCategory
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
     * @var Category
     */
    private $category;

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     *
     * @return SubCategory
     */
    public function setCategory(Category $category): SubCategory
    {
        $this->category = $category;

        return $this;
    }

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
     * @return SubCategory
     */
    public function setName(string $name): SubCategory
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
     * @return SubCategory
     */
    public function setLink(string $link): SubCategory
    {
        $this->link = $link;

        return $this;
    }
}
