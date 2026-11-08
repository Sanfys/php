<?php

namespace App\Services;

class Calculator
{
    public function add($x, $y)
    {
        return $x + $y;
    }

    public function subtract($x, $y)
    {
        return $x - $y;
    }

    /**
     * Множення двох чисел.
     */
    public function multiply($x, $y)
    {
        return $x * $y;
    }
}
