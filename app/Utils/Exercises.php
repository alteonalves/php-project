<?php

namespace App\Utils;

class Exercises
{
    public static function bubbleSort(array $elements): array
    {

        $n = count($elements);

        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = 0; $j < $n - $i - 1; $j++) {
                if ($elements[$j] > $elements[$j + 1]) {
                    // troca de posição
                    $temp = $elements[$j];
                    $elements[$j] = $elements[$j + 1];
                    $elements[$j + 1] = $temp;
                }
            }
        }

        return $elements;
    }

    public static function factorial(int $n): int
    {
        if ($n <= 1) {
            return 1;
        }

        return $n * self::factorial($n - 1);
    }

    public static function sumMultiple3And5(int $maxLimit): int
    {
        $sum = 0;

        for ($i = 1; $i < $maxLimit; $i++) {
            if ($i % 3 === 0 || $i % 5 === 0) {
                $sum += $i;
            }
        }

        return $sum;
    }
}
