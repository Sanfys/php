<?php

declare(strict_types=1);

/**
 * Сервісні функції предметної галузі «Інтернет-магазин».
 * Функції реалізують операції класу Product з UML-діаграми (лабораторна робота 2).
 */

/**
 * Операція Product::calculateTotalPrice(quantity): float.
 * Обчислює загальну вартість позиції: ціна одиниці * кількість.
 */
function calculateTotalPrice(float $price, int $quantity): float
{
    if ($price < 0 || $quantity < 1) {
        throw new InvalidArgumentException('Ціна має бути невід’ємною, а кількість — не меншою за 1.');
    }

    return round($price * $quantity, 2);
}

/**
 * Операція Product::applyDiscount(percent): float.
 * Повертає ціну після застосування знижки у відсотках (0–100).
 *
 * @throws Exception якщо значення знижки виходить за межі діапазону
 */
function applyDiscount(float $price, float $discount): float
{
    if ($discount < 0 || $discount > 100) {
        throw new Exception('Неприпустиме значення знижки!');
    }

    return $price - ($price * ($discount / 100));
}

/**
 * Операція Product::isAvailable(quantity): bool.
 * Перевіряє, чи достатньо товару на складі для замовлення.
 */
function isAvailable(int $stockQuantity, int $requested): bool
{
    return $requested > 0 && $stockQuantity >= $requested;
}
