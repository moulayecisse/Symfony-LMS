<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 07/08/18
 * Time: 11:39.
 */

namespace App\Model\Source\Firebase;

class BookContrib
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
     * @return BookContrib
     */
    public function setName(String $name): BookContrib
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
     * @return BookContrib
     */
    public function setValue(String $value): BookContrib
    {
        $this->value = $value;

        return $this;
    }
}
