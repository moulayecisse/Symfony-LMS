<?php

namespace App\Command;

use App\Entity\Book\BookRent;
use App\Entity\Library;
use App\Entity\MemberUser;
use App\Entity\Book\Book;
use DateTime;
//use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Workflow\Registry;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;
/**
 * Class BookRentCommand.
 */
class BookRentCommand extends ContainerAwareCommand
{
    /**
     * EntityManagerInterface
     *
     * @var EntityManager
     */
    private $entityManager;

    /**
     * SymfonyStyle
     *
     * @var SymfonyStyle
     */
    private $io;

    /**
     * Workflow registry
     *
     * @var Registry
     */
    private $registry;
    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * BookRentCommand constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param null $name
     */
    public function __construct( EntityManagerInterface $entityManager, $name = null )
    {
        parent::__construct($name);
        $this->entityManager = $entityManager;

//        $translator = new Translator('fr_FR');
//        $translator->addLoader('array', new ArrayLoader());
//        $translator->addResource('array', array(
//            'Symfony is great!' => 'Symfony est super !',
//        ), 'fr_FR');
//
//        $this->translator = $translator;
    }

    /**
     * Commande configurations
     */
    protected function configure()
    {
        $translator = new Translator('fr_FR');
        $translator->addLoader('array', new ArrayLoader());
        $translator->addResource('array', array(
            'Symfony is great!' => 'Symfony est super !',
        ), 'fr_FR');

        $this->translator = $translator;

        $this
            ->setName('app:book:rent')
            ->setDescription($this->translator->trans('command.book.rent.description'))
            ->setHelp($this->translator->trans('command.book.rent.help'))
        ;
    }

    /**
     * Commande execution
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $libraries = $this->entityManager->getRepository(Library::class)->findAll();

        $this->io = new SymfonyStyle($input, $output);

        $this->io->title($this->translator->trans('command.book.rent.title'));

        $truncate = $this->io->choice($this->translator->trans('command.book.rent.choice.truncate'), [$this->translator->trans('yes'), $this->translator->trans('no')]);

        if ($this->translator->trans('yes') === $truncate) {
            $this->entityManager->getRepository(BookRent::class)->truncate();
        }

        $libraryNames = array_map(function ($library) {
            return $library->getName();
        }, $libraries);
        array_unshift($libraryNames, $this->translator->trans('all'));

        $libraryName = $this->io->choice($this->translator->trans('Library'), $libraryNames);

        $books = ($this->translator->trans('all') === $libraryName)
            ? $this->entityManager->getRepository(Book::class)->findAll()
            : $this->entityManager->getRepository(Book::class)
                ->findBy(['library' => $this->entityManager->getRepository(Library::class)->findOneBy(['name' => $libraryName])])
        ;
        $memberUsers = $this->entityManager->getRepository(MemberUser::class)->findAll();

        $days = intval($this->io->ask($this->translator->trans('command.book.rent.ask.days')));

        $daysProgressBar = $this->io->createProgressBar($days);

        $this->io->newLine(2);

        $today = new DateTime();
        $date = clone $today;
        $startDate = clone $today;

        $today->format('Y-m-d');
        $date->format('Y-m-d');
        $startDate->format('Y-m-d');

        $startDate->modify('-'.$days.' day');
        $date->modify('-'.$days.' day');

        foreach ($books as &$book) {
            $book->setStatus([Book::STATUS_INSIDE => 1]);
            $this->entityManager->persist($book);
        }

        $this->entityManager->flush();

        for ($i = 0; $i < $days; ++$i) {
            $date->modify('-1 day');

            foreach ($memberUsers as $memberUser) {
                $bookRentCount = $this->entityManager->getRepository(BookRent::class)->countBooking(false, $memberUser->getId(), true, false, $date);

                if ($bookRentCount >= 3) {
                    $bookRents = $this->entityManager->getRepository(BookRent::class)->findBooking(false, $memberUser->getId(), true, false, $date);

                    /*
                     * @var BookRent
                     */
                    foreach ($bookRents as $bookRent) {
                        if (1 === mt_rand(0, 5)) {
                            $memberBooking->setReturnDate($date);
                            $memberBooking->getPBook()->setStatus([Book::STATUS_INSIDE => 1]);

                            $this->entityManager->persist($memberBooking);
                            $this->entityManager->flush();
                        }
                    }
                } else {
                    foreach ($books as $book) {
//                        $workflow = $this->registry->get($pbook);
                        $bookRentCount = $this->entityManager->getRepository(BookRent::class)->countBooking(false, $memberUser->getId(), true, false, $date);

                        if ($bookRentCount < 3 && 1 === mt_rand(0, 5) && $book->getStatus() === [Book::STATUS_INSIDE => 1]) {
                            $bookRent = new BookRent();
                            $endDate = clone $date;
                            $endDate->modify('+15 day');
                            $bookRent->setStartDate($date);
                            $bookRent->setEndDate($endDate);
                            $bookRent->setPBook($book);
                            $bookRent->setMemberUser($memberUser);

                            $book->setStatus([Book::STATUS_OUTSIDE => 1]);

                            $this->entityManager->persist($book);
                            $this->entityManager->persist($bookRent);
                            $this->entityManager->flush();
                        }
                    }
                }
            }
            $daysProgressBar->advance(1);
        }

        $this->io->newLine(2);
        $this->io->success('Days : '.$days);
    }

    /**
     * @param $percent
     *
     * @return bool
     */
    public function chance($percent)
    {
        return mt_rand(0, 99) < $percent;
    }
}
