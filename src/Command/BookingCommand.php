<?php

namespace App\Command;

use App\Entity\Booking;
use App\Entity\Library;
use App\Entity\Member;
use App\Entity\PBook;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Workflow\Registry;

/**
 * Class BookingCommand.
 */
class BookingCommand extends ContainerAwareCommand
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
     * BookingCommand constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param null                   $name
     */
    public function __construct( EntityManagerInterface $entityManager, $name = null )
    {
        parent::__construct($name);
        $this->entityManager = $entityManager;
    }

    /**
     * Commande configurations
     */
    protected function configure()
    {
        $this
            ->setName('app:booking')
            ->setDescription('Create booking from specified date to now')
            ->setHelp('Create booking from specified date to now')
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

        $this->io->title('Create booking');

        $purge = $this->io->choice('Purger la table booking?', ['Oui', 'Non']);

        if ('Oui' === $purge) {
            $this->entityManager->getRepository(Booking::class)->truncate();
        }

        $libraryNames = array_map(function ($library) {
            return $library->getName();
        }, $libraries);
        array_unshift($libraryNames, 'Tous');

        $libraryName = $this->io->choice('Librairie', $libraryNames);

        $pbooks = ('Tous' === $libraryName)
            ? $this->entityManager->getRepository(PBook::class)->findAll()
            : $this->entityManager->getRepository(PBook::class)
                ->findBy(['library' => $this->entityManager->getRepository(Library::class)->findOneBy(['name' => $libraryName])])
        ;
        $members = $this->entityManager->getRepository(Member::class)->findAll();

        $days = intval($this->io->ask('From how many day(s) ?'));

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

        foreach ($pbooks as &$pbook) {
            $pbook->setStatus([PBook::STATUS_INSIDE => 1]);
            $this->entityManager->persist($pbook);
        }

        $this->entityManager->flush();

        for ($i = 0; $i < $days; ++$i) {
            $date->modify('-1 day');

            foreach ($members as $member) {
                $bookingCount = $this->entityManager->getRepository(Booking::class)->countBooking(false, $member->getId(), true, false, $date);

                if ($bookingCount >= 3) {
                    $memberBookings = $this->entityManager->getRepository(Booking::class)->findBooking(false, $member->getId(), true, false, $date);

                    /*
                     * @var Booking
                     */
                    foreach ($memberBookings as $memberBooking) {
                        if (1 === mt_rand(0, 5)) {
                            $memberBooking->setReturnDate($date);
                            $memberBooking->getPBook()->setStatus([PBook::STATUS_INSIDE => 1]);

                            $this->entityManager->persist($memberBooking);
                            $this->entityManager->flush();
                        }
                    }
                } else {
                    foreach ($pbooks as $pbook) {
//                        $workflow = $this->registry->get($pbook);
                        $bookingCount = $this->entityManager->getRepository(Booking::class)->countBooking(false, $member->getId(), true, false, $date);

                        if ($bookingCount < 3 && 1 === mt_rand(0, 5) && $pbook->getStatus() === [PBook::STATUS_INSIDE => 1]) {
                            $booking = new Booking();
                            $endDate = clone $date;
                            $endDate->modify('+15 day');
                            $booking->setStartDate($date);
                            $booking->setEndDate($endDate);
                            $booking->setPBook($pbook);
                            $booking->setMember($member);

                            $pbook->setStatus([PBook::STATUS_OUTSIDE => 1]);

                            $this->entityManager->persist($pbook);
                            $this->entityManager->persist($booking);
                            $this->entityManager->flush();

//                            $workflow = $this->registry->get($pbook, 'pbook_status');

//                            $this->io->text($pbook->getBook()->getTitle().' - '.$date->format('Y-m-d'));
//                            $this->io->text($workflow->getEnabledTransitions($pbook));
                        }
                    }
                }
            }
            $daysProgressBar->advance(1);
        }

//        $daysProgressBar->finish();

        $this->io->newLine(2);
        $this->io->success('Days : '.$days);
//        $this->io->success( 'Categories : ' . count($categories) . ' - SubCategories : '  . count($subCategories) . ' - Books : ' . count($books) );
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
