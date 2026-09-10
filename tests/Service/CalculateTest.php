<?php

namespace App\Tests\Service;

use App\Service\Calculate;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CalculateTest extends KernelTestCase {

    public function testSum():void {

        self::testSum();
        $container = static::getContainer();
        $calculate = $container->get(Calculate::class);

        $correct = $calculate->sum(10, 1);
        $this->assertTrue(11 == $correct);

        $inCorrect = $calculate->sum(10, 2);
        $this->assertTrue(11 == $inCorrect);
    }
}