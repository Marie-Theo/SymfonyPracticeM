<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BookFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $book1 = new Book();
        $book1->setTitle("Moby-dick")
              ->setNbrpages(635)
              ->addAuthor($this->getReference(AuthorFixtures::HM_COUNTRY_REFERENCE, Author::class));
        $manager->persist($book1);

        $book2 = new Book();
        $book2->setTitle("Les misérables")
              ->setNbrpages(1232)
              ->addAuthor($this->getReference(AuthorFixtures::VH_COUNTRY_REFERENCE, Author::class));
        $manager->persist($book2);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            AuthorFixtures::class,
        ];
    }
}
