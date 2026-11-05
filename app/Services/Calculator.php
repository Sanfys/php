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
     * Множення двох чисел (додано у межах задачі Issue #N, етап 6 лабораторної роботи 1).
     */
    public function multiply($x, $y)
    {
        return $x * $y;
    }
}
