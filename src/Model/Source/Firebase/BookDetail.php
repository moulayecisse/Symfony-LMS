<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 07/08/18
 * Time: 11:39.
 */

namespace App\Model\Source\Firebase;

class BookDetail
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $value;

    /**
     * @return string
     */
    public function getName(): String
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return BookDetail
     */
    public function setName(String $name): BookDetail
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue(): String
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return BookDetail
     */
    public function setValue(String $value): BookDetail
    {
        $this->value = $value;

        return $this;
    }
}
