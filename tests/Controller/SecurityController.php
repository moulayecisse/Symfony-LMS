<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 23/08/2018
 * Time: 18:35
 */
namespace App\tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class SecurityController extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testBackendSecurity()
    {
        $this->logIn();
        $crawler = $this->client->request('GET', '/');

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertSame('Lorem Connexion', $crawler->filter('#user_login_submit')->text());
    }

    private function logIn()
    {
        $session = $this->client->getContainer()->get('session');

        $firewallName = 'backend';
        $firewallContext = 'backend';

        $token = new UsernamePasswordToken('librarian', null, $firewallName, array('ROLE_LIBRARIAN'));
        $session->set('_security_'.$firewallContext, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }
}