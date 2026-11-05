<?php

declare(strict_types=1);

/**
 * Індивідуальне алгоритмічне завдання (варіант 1):
 *  - табл. 3.2, задача 2  -> insertZeroAfterPositive()
 *  - табл. 3.3, задача 6  -> countWordsStartingWithConsonant()
 *  - табл. 3.4, задача 1  -> findMaxNumberInString()
 */

/**
 * Табл. 3.2, задача 2.
 * Вставляє нульовий елемент після кожного ДОДАТНОГО елемента масиву.
 *
 * @param  int[]  $numbers
 * @return int[]
 */
function insertZeroAfterPositive(array $numbers): array
{
    return array_merge(...array_map(
        fn (int $number): array => $number > 0 ? [$number, 0] : [$number],
        array_values($numbers)
    ));
}

/**
 * Табл. 3.3, задача 6.
 * Підраховує кількість слів, які починаються з приголосної літери
 * (українська та латинська абетки, регістр не враховується).
 */
function countWordsStartingWithConsonant(string $text): int
{
    $consonants = 'бвгґджзйклмнпрстфхцчшщbcdfghjklmnpqrstvwxyz';

    // Слово — послідовність літер/цифр/апострофів/дефісів, що починається з літери
    preg_match_all('/(?<![\p{L}\p{N}])\p{L}[\p{L}\p{N}\'’ʼ-]*/u', $text, $matches);

    $words = array_filter(
        $matches[0],
        function (string $word) use ($consonants): bool {
            return mb_strpos($consonants, mb_strtolower(mb_substr($word, 0, 1))) !== false;
        }
    );

    return count($words);
}

/**
 * Табл. 3.4, задача 1.
 * Знаходить максимальне число у рядку, де числа розділені пробілами.
 *
 * @throws InvalidArgumentException якщо рядок порожній або містить не число
 */
function findMaxNumberInString(string $input): int|float
{
    $parts = preg_split('/\s+/', trim($input), -1, PREG_SPLIT_NO_EMPTY);

    if ($parts === false || $parts === []) {
        throw new InvalidArgumentException('Рядок не містить жодного числа.');
    }

    foreach ($parts as $part) {
        if (! is_numeric($part)) {
            throw new InvalidArgumentException("Значення «{$part}» не є числом.");
        }
    }

    return max(array_map(fn (string $part): int|float => $part + 0, $parts));
}
