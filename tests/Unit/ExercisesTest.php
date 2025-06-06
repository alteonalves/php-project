<?php

namespace Tests\Unit;

use App\Utils\Exercises;
use PHPUnit\Framework\TestCase;

class ExercisesTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_bubble_sort(): void
    {
        $elements = [10, 30, 20, 50, 22, 5];
        $elements_ordered = Exercises::bubbleSort($elements);
        $this->assertEquals([5, 10, 20, 22,30, 50], $elements_ordered);
    }

    public function test_sum_multiple_input_10(): void
    {
        $result = Exercises::sumMultiple3And5(10);
        $this->assertEquals(23, $result);
    }

    public function test_sum_multiple_input_20(): void
    {
        $result = Exercises::sumMultiple3And5(20);
        $this->assertEquals(78, $result);
    }

    public function test_sum_multiple_input_100(): void
    {
        $result = Exercises::sumMultiple3And5(100);
        $this->assertEquals(2318, $result);
    }
}
