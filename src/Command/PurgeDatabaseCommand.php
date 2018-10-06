<?php
namespace App\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * This command truncates all data from Entry related tables
 */
class PurgeDatabaseCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:database:truncate')
            ->setDescription('Truncates all data from Entry related tables')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Starting database truncate...</info>');

        $em = $this->getContainer()->get('doctrine')->getManager();
        
        $sql = "
            set foreign_key_checks = 0;
            Truncate book;
            Truncate book_author;
            Truncate book_booking;
            Truncate book_category;
            Truncate book_editor;
            Truncate book_format;
            Truncate book_location;
            Truncate book_model;
            Truncate book_rent;
            Truncate ebook;
            Truncate file;
            Truncate library;
            Truncate member_user_ebook;
            Truncate member_user_subscription;
            Truncate member_user_subscription_type;
            Truncate member_user_testimonial;
            Truncate member_user_type;
            Truncate user;
            set foreign_key_checks = 1;
        ";

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();

        $output->writeln('<info>Database truncate complete.</info>');
    }
}
