<?php

namespace App\DataFixtures;

use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CountryFixtures extends Fixture
{
    public const US_COUNTRY_REFERENCE = 'etats-unis';
    public const FR_COUNTRY_REFERENCE = 'france';

    public function load(ObjectManager $manager): void
    {
        $france = new Country();
        $france->setName("france");
        $manager->persist($france);

        $this->addReference(self::FR_COUNTRY_REFERENCE, $france);

        $etatsUnis = new Country();
        $etatsUnis->setName("etats-unis");
        $manager->persist($etatsUnis);

        $this->addReference(self::US_COUNTRY_REFERENCE, $etatsUnis);

        $manager->flush();
    }
}
