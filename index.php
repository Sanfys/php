<?php

declare(strict_types=1);

use Faker\Factory;

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/app/Services/EntityService.php';
require_once __DIR__.'/app/Services/DataProcessor.php';

$h = static fn (mixed $value): string => htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
$list = static fn (array $items): string => '['.implode(', ', array_map(static fn ($v) => (string) $v, $items)).']';
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Лабораторна робота 3 — Основи PHP</title>
    <style>
        body { font-family: system-ui, Arial, sans-serif; max-width: 860px; margin: 24px auto; padding: 0 16px; line-height: 1.5; color: #1f2933; }
        h1 { font-size: 1.5rem; } h2 { font-size: 1.15rem; border-bottom: 2px solid #d9e2ec; padding-bottom: 4px; margin-top: 32px; }
        h3 { font-size: 1rem; margin-bottom: 4px; }
        .box { background: #f5f7fa; border-left: 4px solid #3e7bfa; padding: 8px 14px; margin: 8px 0; }
        .error { background: #fdecea; border-left-color: #d93025; }
        .ok { background: #e8f5e9; border-left-color: #2e7d32; }
        code { background: #e4e7eb; padding: 1px 5px; border-radius: 3px; }
    </style>
</head>
<body>
<h1>Лабораторна робота №3. Основи PHP: структури даних, функції</h1>
<p>Предметна галузь: <strong>Система підтримки складання розкладу занять</strong> (головний клас — <code>Lesson</code>).</p>

<h2>Завдання 1. Масиви та структури даних</h2>
<?php require __DIR__.'/app/Models/EntityArray.php'; ?>

<h2>Завдання 2. Користувацькі функції та строга типізація</h2>
<div class="box">
    <code>calculateLessonDuration('08:30', '09:50')</code>
    = <strong><?= $h(calculateLessonDuration('08:30', '09:50')) ?></strong> хв
</div>
<div class="box">
    <code>isRoomSuitable(30, 25)</code> = <strong><?= isRoomSuitable(30, 25) ? 'true' : 'false' ?></strong>;
    <code>isRoomSuitable(20, 25)</code> = <strong><?= isRoomSuitable(20, 25) ? 'true' : 'false' ?></strong>
</div>
<?php
// Демонстрація strict_types=1: передача числа замість рядка спричиняє TypeError
try {
    echo '<div class="box error">'.$h(calculateLessonDuration(830, '09:50')).'</div>';
} catch (TypeError $e) {
    echo '<div class="box error"><strong>TypeError</strong> (strict_types=1): '.$h($e->getMessage()).'</div>';
}
?>

<h2>Завдання 3. Анонімні функції (замикання) та Faker</h2>
<?php
$faker = Factory::create('uk_UA');
$faker->seed(2026); // фіксоване зерно: результат відтворюваний

$groupSizes = [];
for ($i = 0; $i < 10; $i++) {
    $groupSizes[] = $faker->numberBetween(10, 40); // кількість студентів у групі
}

$minSize = 25; // зовнішня змінна-критерій

$largeGroups = array_filter($groupSizes, function (int $size) use ($minSize): bool {
    return $size > $minSize;
});
?>
<div class="box">Розміри 10 згенерованих груп: <?= $h($list($groupSizes)) ?></div>
<div class="box ok">
    Групи більші за <?= $h($minSize) ?> студентів (<?= count($largeGroups) ?> шт.; ключі збережено array_filter):
    <?= $h($list(array_map(fn ($k, $v) => "[$k] => $v", array_keys($largeGroups), $largeGroups))) ?>
</div>

<h2>Завдання 4. Обробка винятків</h2>
<?php
try {
    echo '<div class="box ok">calculateRoomOccupancy(30, 40) = '.$h(calculateRoomOccupancy(30, 40)).' %</div>';
    echo '<div class="box">Виклик calculateRoomOccupancy(<strong>45</strong>, 40)...</div>';
    echo $h(calculateRoomOccupancy(45, 40)); // викличе виняток
    echo '<div class="box ok">Цей рядок не буде виконано</div>';
} catch (Exception $e) {
    echo '<div class="box error">Помилка: '.$h($e->getMessage()).'</div>';
} finally {
    echo '<div class="box">Завершення розрахунку завантаженості аудиторії.</div>';
}
?>

<h2>Завдання 5. Індивідуальне алгоритмічне завдання (варіант 1)</h2>
<?php
$numbers = [5, -3, 8, 0, -1, 4];
$text = 'Автоматичне складання розкладу економить час викладачів і студентів';
$numberString = '30 45 120 60 25 90.5';
?>
<h3>Табл. 3.2, задача 2: вставити 0 після кожного додатного елемента</h3>
<div class="box">Вхід: <?= $h($list($numbers)) ?><br>Результат: <strong><?= $h($list(insertZeroAfterPositive($numbers))) ?></strong></div>

<h3>Табл. 3.3, задача 6: кількість слів, що починаються з приголосної</h3>
<div class="box">Вхід: «<?= $h($text) ?>»<br>Результат: <strong><?= countWordsStartingWithConsonant($text) ?></strong></div>

<h3>Табл. 3.4, задача 1: максимальне число в рядку (місткості аудиторій)</h3>
<div class="box">Вхід: «<?= $h($numberString) ?>»<br>Результат: <strong><?= $h(findMaxNumberInString($numberString)) ?></strong></div>
</body>
</html>
