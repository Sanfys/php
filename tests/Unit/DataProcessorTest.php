<?php

namespace Tests\Unit;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class DataProcessorTest extends TestCase
{
    public function test_insert_zero_after_positive()
    {
        $this->assertSame(
            [5, 0, -3, 8, 0, 0, -1, 4, 0],
            insertZeroAfterPositive([5, -3, 8, 0, -1, 4])
        );
    }

    public function test_insert_zero_after_positive_handles_edge_cases()
    {
        $this->assertSame([], insertZeroAfterPositive([]));
        $this->assertSame([-1, -2, 0], insertZeroAfterPositive([-1, -2, 0]));
        $this->assertSame([7, 0], insertZeroAfterPositive([7]));
    }

    public function test_count_words_starting_with_consonant()
    {
        $text = 'Онлайн магазин електроніки: купуйте ноутбуки, смартфони та аксесуари';

        $this->assertSame(5, countWordsStartingWithConsonant($text));
    }

    public function test_count_words_supports_latin_and_ignores_case()
    {
        $this->assertSame(3, countWordsStartingWithConsonant('Laptop apple Tablet orange Phone'));
        $this->assertSame(0, countWordsStartingWithConsonant(''));
        $this->assertSame(0, countWordsStartingWithConsonant('Яблуко Іграшка 2024 ... 3d'));
    }

    public function test_find_max_number_in_string()
    {
        $this->assertEquals(100, findMaxNumberInString('12 -5 3.5 100 42 -77 99.9'));
        $this->assertEquals(-1, findMaxNumberInString('-10 -5 -1 -7'));
        $this->assertEquals(7.5, findMaxNumberInString('  7.5   3 '));
    }

    public function test_find_max_number_throws_for_empty_string()
    {
        $this->expectException(InvalidArgumentException::class);

        findMaxNumberInString('   ');
    }

    public function test_find_max_number_throws_for_non_numeric_value()
    {
        $this->expectException(InvalidArgumentException::class);

        findMaxNumberInString('10 abc 20');
    }
}
