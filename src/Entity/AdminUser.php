<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdminUser User Class.
 *
 * @author  Moulaye Cissé <moulaye.c@gmail.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @ORM\MappedSuperclass()
 * @ORM\Entity(repositoryClass="App\Repository\AdminRepository")
 */
class AdminUser extends User
{
    /**
     * AdminUser constructor.
     */
    public function __construct()
    {
        $this->roles = [self::ROLE_ADMIN];
    }
}
