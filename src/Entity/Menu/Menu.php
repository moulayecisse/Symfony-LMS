<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 07/10/2018
 * Time: 12:13
 */

namespace App\Entity\Menu;


use Cisse\Traits\Entity\IdTrait;

/**
 * Class Menu
 * @package App\Entity\Menu
 *
 * @ORM\Entity(repositoryClass="App\Repository\Menu")
 */
class Menu
{
    use IdTrait;
}