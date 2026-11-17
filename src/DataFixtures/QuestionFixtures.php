<?php

namespace App\DataFixtures;

use App\Entity\Question;
use App\Entity\Theme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class QuestionFixtures extends Fixture implements DependentFixtureInterface
{
    public const THEME_1_Q1_REFERENCE = 't1-q1';
    public const THEME_1_Q2_REFERENCE = 't1-q2';
    public const THEME_1_Q3_REFERENCE = 't1-q3';
    public const THEME_1_Q4_REFERENCE = 't1-q4';
    public const THEME_1_Q5_REFERENCE = 't1-q5';

    public function load(ObjectManager $manager): void
    {
        $Question1 = new Question()
            ->setText('Comment se connecter au domaine ?')
            ->setExplication('')
            ->setTheme($this->getReference(ThemeFixtures::USE_COMPUTER_REFERENCE, Theme::class))
        ;
        $manager->persist($Question1);
        $this->addReference(self::THEME_1_Q1_REFERENCE, $Question1);

        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            ThemeFixtures::class,
        ];
    }
}
