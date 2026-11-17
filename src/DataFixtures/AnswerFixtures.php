<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AnswerFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $answer1= new Answer()
            ->setText('Appuyer sur Entrer')
            ->setIsCorrect(false)
            ->setQuestion($this->getReference(QuestionFixtures::THEME_1_Q1_REFERENCE, Question::class))
            ;
        $manager->persist($answer1);

        $answer2= new Answer()
            ->setText('Rien, on se connecte tout seul')
            ->setIsCorrect(false)
            ->setQuestion($this->getReference(QuestionFixtures::THEME_1_Q1_REFERENCE, Question::class))
            ;
        $manager->persist($answer2);

        $answer3= new Answer()
            ->setText('Mettre son identifiant et son mot de passe')
            ->setIsCorrect(true)
            ->setQuestion($this->getReference(QuestionFixtures::THEME_1_Q1_REFERENCE, Question::class))
            ;
        $manager->persist($answer3);

        $answer4= new Answer()
            ->setText('Mettre son mot de passe')
            ->setIsCorrect(false)
            ->setQuestion($this->getReference(QuestionFixtures::THEME_1_Q1_REFERENCE, Question::class))
            ;
        $manager->persist($answer4);

        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            QuestionFixtures::class,
        ];
    }
}
