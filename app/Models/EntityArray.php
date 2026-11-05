<?php

declare(strict_types=1);

// Індексний масив: п'ять категорій товарів інтернет-магазину
$categories = ['Smartphone', 'Laptop', 'Tablet', 'Headphones', 'Smartwatch'];
sort($categories); // сортування за алфавітом

// Асоціативний масив: один об'єкт класу Product.
// Ключі повністю відповідають атрибутам класу Product з UML-діаграми (лаб. 2)
$product = [
    'id' => 1,
    'name' => 'Laptop Pro 15',
    'sku' => 'LP-15-2026',
    'price' => 1500.50,
    'stock_quantity' => 12,
    'description' => 'Ноутбук 15.6", 16 ГБ RAM, SSD 512 ГБ',
    'is_active' => true,
    'category_id' => 2,
];

/** Форматує значення для виводу (bool -> true/false) */
$formatValue = static fn (mixed $value): string => is_bool($value) ? ($value ? 'true' : 'false') : (string) $value;
?>
<h3>Індексний масив: категорії товарів (після sort())</h3>
<ol>
    <?php foreach ($categories as $category) { ?>
        <li><?= htmlspecialchars($category) ?></li>
    <?php } ?>
</ol>

<h3>Асоціативний масив: об'єкт Product</h3>
<ul>
    <?php foreach ($product as $key => $value) { ?>
        <li><strong><?= htmlspecialchars($key) ?></strong>: <?= htmlspecialchars($formatValue($value)) ?></li>
    <?php } ?>
</ul>
