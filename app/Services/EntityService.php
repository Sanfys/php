<?php

declare(strict_types=1);

/**
 * Сервісні функції предметної галузі «Система підтримки складання розкладу занять».
 * Функції реалізують операції класів Lesson, Classroom з UML-діаграми (лабораторна робота 2).
 */

/**
 * Операція Lesson::getDurationMinutes(): int.
 * Обчислює тривалість заняття у хвилинах за часом початку й завершення (формат ГГ:ХХ).
 *
 * @throws InvalidArgumentException якщо формат часу хибний або кінець не пізніше за початок
 */
function calculateLessonDuration(string $startTime, string $endTime): int
{
    $pattern = '/^([01]\d|2[0-3]):[0-5]\d$/';

    if (! preg_match($pattern, $startTime) || ! preg_match($pattern, $endTime)) {
        throw new InvalidArgumentException('Час має бути у форматі ГГ:ХХ.');
    }

    $toMinutes = static fn (string $time): int => (int) substr($time, 0, 2) * 60 + (int) substr($time, 3, 2);
    $duration = $toMinutes($endTime) - $toMinutes($startTime);

    if ($duration <= 0) {
        throw new InvalidArgumentException('Час завершення має бути пізнішим за час початку.');
    }

    return $duration;
}

/**
 * Операція Classroom::fitsGroup(group): bool.
 * Перевіряє, чи вміщує аудиторія студентську групу.
 */
function isRoomSuitable(int $capacity, int $groupSize): bool
{
    return $groupSize > 0 && $capacity >= $groupSize;
}

/**
 * Операція Classroom::getOccupancy(week): float.
 * Повертає завантаженість аудиторії у відсотках: зайняті слоти / усі слоти * 100.
 *
 * @throws Exception якщо кількість слотів виходить за допустимі межі
 */
function calculateRoomOccupancy(int $occupiedSlots, int $totalSlots): float
{
    if ($totalSlots <= 0 || $occupiedSlots < 0 || $occupiedSlots > $totalSlots) {
        throw new Exception('Неприпустима кількість занять!');
    }

    return $occupiedSlots / $totalSlots * 100;
}
