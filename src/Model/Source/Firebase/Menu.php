<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 07/08/18
 * Time: 11:37.
 */

namespace App\Model\Source\Firebase;

class Menu
{
    /**
     * @var array
     */
    private $categories = [];

    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @param array $categories
     *
     * @return Menu
     */
    public function setCategories(array $categories): Menu
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @param mixed $category
     *
     * @return Menu
     */
    public function addCategory($category): Menu
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * @param mixed $category
     *
     * @return Menu
     */
    public function removeCategory($category): Menu
    {
        if (false !== $key = array_search($category, $this->categories, true)) {
            array_splice($this->categories, $key, 1);
        }

        return $this;
    }
}
