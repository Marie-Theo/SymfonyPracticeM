<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AuthorFixtures extends Fixture implements DependentFixtureInterface
{
    public const VH_COUNTRY_REFERENCE = 'victor-hugo';
    public const HM_COUNTRY_REFERENCE = 'herman-melvil';

    public function load(ObjectManager $manager): void
    {
        $author1 = new Author();
        $author1->setFirstname("Victor")
                ->setName("Hugo")
                ->setCountry($this->getReference(CountryFixtures::FR_COUNTRY_REFERENCE, Country::class));
        $manager->persist($author1);
                
        $this->addReference(self::VH_COUNTRY_REFERENCE, $author1);

        $author2 = new Author();
        $author2->setFirstname("Herman")
                ->setName("Melvil")
                ->setCountry($this->getReference(CountryFixtures::US_COUNTRY_REFERENCE, Country::class));
                
        $manager->persist($author2);
                
        $this->addReference(self::HM_COUNTRY_REFERENCE, $author2);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CountryFixtures::class,
        ];
    }
}
