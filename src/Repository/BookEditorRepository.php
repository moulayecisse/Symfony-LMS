<?php

namespace App\Repository;

use App\Entity\BookEditor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BookEditor|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookEditor|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookEditor[]    findAll()
 * @method BookEditor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookEditorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BookEditor::class);
    }
}
