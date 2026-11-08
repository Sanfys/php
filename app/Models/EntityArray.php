<?php

declare(strict_types=1);

// Індексний масив: п'ять навчальних дисциплін (навмисно в невпорядкованому вигляді)
$subjects = ['Математика', 'Веб-програмування', 'Алгоритми', 'Операційні системи', 'Бази даних'];
sort($subjects); // сортування за алфавітом

// Асоціативний масив: один об'єкт класу Lesson (заняття).
// Ключі повністю відповідають атрибутам класу Lesson з UML-діаграми (лаб. 2)
$lesson = [
    'id' => 1,
    'subject_id' => 3,
    'teacher_id' => 7,
    'group_id' => 12,
    'classroom_id' => 205,
    'time_slot_id' => 4,
    'lesson_type' => 'lecture',
    'is_confirmed' => true,
];

/** Форматує значення для виводу (bool -> true/false) */
$formatValue = static fn (mixed $value): string => is_bool($value) ? ($value ? 'true' : 'false') : (string) $value;
?>
<h3>Індексний масив: навчальні дисципліни (після sort())</h3>
<ol>
    <?php foreach ($subjects as $subject) { ?>
        <li><?= htmlspecialchars($subject) ?></li>
    <?php } ?>
</ol>

<h3>Асоціативний масив: об'єкт Lesson (заняття)</h3>
<ul>
    <?php foreach ($lesson as $key => $value) { ?>
        <li><strong><?= htmlspecialchars($key) ?></strong>: <?= htmlspecialchars($formatValue($value)) ?></li>
    <?php } ?>
</ul>
