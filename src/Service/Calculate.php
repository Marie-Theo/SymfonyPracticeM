<?php

namespace App\Service;

class Calculate {

    public function sum(int|float $a, int|float $b): int|float {
        return $a + $b;
    }
}