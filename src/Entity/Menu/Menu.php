<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 07/10/2018
 * Time: 12:13
 */

namespace App\Entity\Menu;


use Cisse\Traits\Entity\IdTrait;
use Cisse\Traits\Entity\NameTrait;
use Cisse\Traits\Entity\SlugTrait;
use Cisse\Traits\Entity\TitleTrait;

/**
 * Class Menu
 * @package App\Entity\Menu
 *
 * @ORM\Entity(repositoryClass="App\Repository\Menu")
 */
class Menu
{
    use IdTrait;
    use NameTrait;
    use TitleTrait;
    use SlugTrait;
}