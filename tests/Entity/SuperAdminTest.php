<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 25/07/18
 * Time: 21:23
 */

namespace App\Tests\Entity;


use App\Entity\SuperAdmin;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SuperAdminTest extends TestCase
{
    /**
     * @var SuperAdminPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder ) {

        $this->encoder = $encoder;
    }

    public function testSuperAdminCanBeCreated()
    {
        $superAdmin = new SuperAdmin();
        $this->assertInstanceOf(SuperAdmin::class, $superAdmin);
    }

    public function testSuperAdminIntegrity(  )
    {
        $superAdmin = new SuperAdmin( );

        $encodePassword = $this->encoder->encodePassword($superAdmin, '123456789');

        $superAdmin->setFirstName( 'Moulaye' );
        $superAdmin->setLastName( 'Cissé' );
        $superAdmin->setEmail( 'moulaye.c@gmail.com' );
        $superAdmin->setPassword( $encodePassword );

        $this->assertSame( ['ROLE_SUPER_SuperAdmin'], $superAdmin->getRoles() );
        $this->assertSame( 'Moulaye', $superAdmin->getFirstName() );
        $this->assertSame( 'Cissé', $superAdmin->getLastName() );
        $this->assertSame( 'moulaye.c@gmail.com', $superAdmin->getEmail() );
        $this->assertSame( $encodePassword, $superAdmin->getPassword() );
    }
}