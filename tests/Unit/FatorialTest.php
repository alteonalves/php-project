<?php

namespace Tests\Unit;

use App\Utils\Exercises;
use PHPUnit\Framework\TestCase;

class FatorialTest extends TestCase
{
    /**
     * @dataProvider factorialProvider
     */
    public function test_factorial(int $input, int $expected): void
    {
        $this->assertEquals($expected, Exercises::factorial($input));
    }

    public static function factorialProvider(): array
    {
        return [
            [0, 1],
            [1, 1],
            [2, 2],
            [3, 6],
            [4, 24],
            [5, 120],
            [6, 720],
        ];
    }
}
