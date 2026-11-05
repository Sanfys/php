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
<p>Предметна галузь: <strong>Інтернет-магазин</strong> (головний клас — <code>Product</code>).</p>

<h2>Завдання 1. Масиви та структури даних</h2>
<?php require __DIR__.'/app/Models/EntityArray.php'; ?>

<h2>Завдання 2. Користувацькі функції та строга типізація</h2>
<?php
$price = 1500.50;
$quantity = 2;
?>
<div class="box">
    <code>calculateTotalPrice(<?= $h($price) ?>, <?= $h($quantity) ?>)</code>
    = <strong><?= $h(calculateTotalPrice($price, $quantity)) ?></strong> грн
</div>
<div class="box">
    <code>isAvailable(12, 5)</code> = <strong><?= isAvailable(12, 5) ? 'true' : 'false' ?></strong>;
    <code>isAvailable(3, 5)</code> = <strong><?= isAvailable(3, 5) ? 'true' : 'false' ?></strong>
</div>
<?php
// Демонстрація strict_types=1: передача рядка замість float спричиняє TypeError
try {
    echo '<div class="box error">'.$h(calculateTotalPrice('1500.50', 2)).'</div>';
} catch (TypeError $e) {
    echo '<div class="box error"><strong>TypeError</strong> (strict_types=1): '.$h($e->getMessage()).'</div>';
}
?>

<h2>Завдання 3. Анонімні функції (замикання) та Faker</h2>
<?php
$faker = Factory::create('uk_UA');
$faker->seed(2026); // фіксоване зерно: результат відтворюваний

$prices = [];
for ($i = 0; $i < 10; $i++) {
    $prices[] = $faker->randomFloat(2, 100, 5000); // ціни товарів, грн
}

$minPrice = 1000.0; // зовнішня змінна-критерій

$expensive = array_filter($prices, function (float $price) use ($minPrice): bool {
    return $price > $minPrice;
});
?>
<div class="box">Згенеровані ціни (10 шт.): <?= $h($list($prices)) ?></div>
<div class="box ok">
    Товари дорожчі за <?= $h($minPrice) ?> грн (<?= count($expensive) ?> шт.; ключі збережено array_filter):
    <?= $h($list(array_map(fn ($k, $v) => "[$k] => $v", array_keys($expensive), $expensive))) ?>
</div>

<h2>Завдання 4. Обробка винятків</h2>
<?php
try {
    echo '<div class="box ok">applyDiscount(1000, 15) = '.$h(applyDiscount(1000, 15)).' грн</div>';
    echo '<div class="box">Виклик applyDiscount(1000, <strong>150</strong>)...</div>';
    echo $h(applyDiscount(1000, 150)); // викличе виняток
    echo '<div class="box ok">Цей рядок не буде виконано</div>';
} catch (Exception $e) {
    echo '<div class="box error">Помилка: '.$h($e->getMessage()).'</div>';
} finally {
    echo '<div class="box">Завершення спроби розрахунку.</div>';
}
?>

<h2>Завдання 5. Індивідуальне алгоритмічне завдання (варіант 1)</h2>
<?php
$numbers = [5, -3, 8, 0, -1, 4];
$text = 'Онлайн магазин електроніки: купуйте ноутбуки, смартфони та аксесуари';
$numberString = '12 -5 3.5 100 42 -77 99.9';
?>
<h3>Табл. 3.2, задача 2: вставити 0 після кожного додатного елемента</h3>
<div class="box">Вхід: <?= $h($list($numbers)) ?><br>Результат: <strong><?= $h($list(insertZeroAfterPositive($numbers))) ?></strong></div>

<h3>Табл. 3.3, задача 6: кількість слів, що починаються з приголосної</h3>
<div class="box">Вхід: «<?= $h($text) ?>»<br>Результат: <strong><?= countWordsStartingWithConsonant($text) ?></strong></div>

<h3>Табл. 3.4, задача 1: максимальне число в рядку</h3>
<div class="box">Вхід: «<?= $h($numberString) ?>»<br>Результат: <strong><?= $h(findMaxNumberInString($numberString)) ?></strong></div>
</body>
</html>
