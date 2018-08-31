<?php

namespace App\Command;

use App\Service\Source\BookGiberSource;
use App\Model\Source\Firebase\Category;
use App\Service\Source\Firebase\Firebase;
use App\Model\Source\Firebase\Menu;
use App\Model\Source\Firebase\SubCategory;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SourceGiberCommand extends ContainerAwareCommand
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var BookGiberSource
     */
    private $bookGiberSource;

    /**
     * @var SymfonyStyle
     */
    private $io;

    /**
     * @var Firebase
     */
    private $firebase;

    public function __construct(
        EntityManagerInterface $entityManager,
        BookGiberSource $bookGiberSource,
        $name = null
    ) {
        parent::__construct($name);
        $this->bookGiberSource = $bookGiberSource;
        $this->entityManager = $entityManager;
        $this->firebase = new Firebase();
    }

    protected function configure()
    {
        $this
            ->setName('app:source-giber')
            ->setDescription('Create books from giber website')
            ->setHelp('Create books from giber website')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->io = new SymfonyStyle($input, $output);

        $this->io->title('Livres en provenance de Giber.com');

        $categories = [];
        $subCategories = [];
        $books = [];

        /**
         * @var Menu
         */
        $menu = $this->bookGiberSource->getMenu();

//        $this->io->text('SubCategories : ');
        $categoryProgressBar = $this->io->createProgressBar(count($menu->getCategories()));
        $categoryProgressBar->setMessage('Categories');
        $categoryProgressBar->display();
        $categoryProgressBar->start();
//        $this->io->text("\n\n");

        /*
         * @var BookCategory
         */
        foreach ($menu->getCategories() as $category) {
            /**
             * @var SubCategory
             */

//            $this->io->text('Categories : ');
            $subCategoryProgressBar = $this->io->createProgressBar(count($category->getSubCategories()));
            $subCategoryProgressBar->setMessage('SubCategories');
            $subCategoryProgressBar->display();
            $subCategoryProgressBar->start();

            foreach ($category->getSubCategories() as $subCategory) {
                $bookProgressBar = $this->io->createProgressBar(count($category->getSubCategories()));
                $bookProgressBar->setMessage('SubCategories');
                $bookProgressBar->display();
                $bookProgressBar->start();

                foreach ($this->bookGiberSource->getBooks($subCategory->getLink(), $subCategory) as $book) {
                    $books[] = $book;
                    $this->firebase->saveBook($book);

                    $bookProgressBar->advance(1);
                }

                $bookProgressBar->finish();

                $this->firebase->saveSubCategory($subCategory);

                $subCategoryProgressBar->advance(1);
            }

            $subCategoryProgressBar->finish();

            $this->firebase->saveCategory($category);

            $categoryProgressBar->advance(1);
        }

        $categoryProgressBar->finish();

        $this->io->success('Categories : '.count($categories).' - SubCategories : '.count($subCategories).' - Books : '.count($books));
    }
}
