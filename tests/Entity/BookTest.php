<?php
/**
 * Created by PhpStorm.
 * : nicolas
 * Date: 02/08/18
 * Time: 09:51
 */

namespace App\Tests\Entity;


use App\Entity\Author;
use App\Entity\Book;
use App\Entity\PBook;
use PHPUnit\Framework\TestCase;
#use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
#use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class BookTest extends TestCase
{

    public function __construct( ) {
        parent::__construct();
    }


    public function testBookCanBeCreated()
    {
        $book = new Book();
        $this->assertInstanceOf(Book::class, $book);
    }


    public function testBookIntegrity(  )
    {
        $book = new Book( );

        $author = new Author();

        $author->setFirstName('Alberto');
        $author->setLastName('Moravia');
        $author->setBiography('Ma vie sur france 2');
        $author->setBirthday(new \DateTime('2001-03-28'));


        /**
         * PBook[] $tableauDePBook
         */
        $tableauDePBook = [];
        for ($i=0;$i<=9;$i++)
        {
            //$pbook.${$i} = new PBook();
            $tableauDePBook[$i] = new PBook();
        }

        $book->setIsbn( '9782080705259' );
        $book->setTitle( 'Le Mépris' );
        $book->setResume( 'Ricardo Molteni aime passionnément sa femme, Emilia, qu’il a épousée deux ans auparavant. Endetté par l’appartement qu’il a acheté, il doit mettre de côté ses ambitions d’écrivain et travaille comme scénariste, métier qu’il n’aime pas et qui suffit à peine à les faire vivre. Le jour où Riccardo fait la connaissance du producteur Battista et se retrouve invité dans sa villa à Capri pour adapter L’Odyssée, leurs problèmes d’argent semblent réglés. Mais à la même période, Riccardo prend conscience du fait que sa femme a cessé de l’aimer. Pressée par ses questions, Emilia finit par lui avouer la cause de ce désamour : elle le méprise…' );
        $book->setpageNumber(246);
        $book->setAuthor($author);

        for ($i=0;$i<=9;$i++)
        {
            //$pbook.${$i} = new PBook();
            $book->addPBook($tableauDePBook[$i]);
        }

//        $this->assertSame( ['ROLE_SUPER_SuperAdmin'], $superAdmin->getRoles() );
        $this->assertSame( '9782080705259', $book->getIsbn() );
        $this->assertSame( 'Le Mépris', $book->getTitle() );
        $this->assertSame( 246, $book->getPageNumber() );
        $this->assertSame( $author, $book->getAuthor() );

    }
}
