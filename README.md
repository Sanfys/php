# Система підтримки складання розкладу занять

[![PHP CI Application](https://github.com/YOUR_USERNAME/YOUR_REPOSITORY/actions/workflows/php-ci.yml/badge.svg)](https://github.com/YOUR_USERNAME/YOUR_REPOSITORY/actions/workflows/php-ci.yml)

Навчальний репозиторій для лабораторної роботи №1 з дисципліни **«Веб-програмування»**: мінімальний PHP-проєкт з автоматизованим CI-пайплайном (GitHub Actions), лінтером Laravel Pint та юніт-тестами PHPUnit.

## Функціонал

- **Керування версіями** — Git + GitHub, Pull Request-и з шаблоном і рецензуванням, захист гілки `main`
- **CI-пайплайн** — перевірка стилю коду (Pint) та запуск юніт-тестів (PHPUnit) при кожному push / Pull Request
- **Керування задачами** — GitHub Issues + Kanban-дошка GitHub Projects

## Структура проєкту

```text
.
├── .github/
│   ├── PULL_REQUEST_TEMPLATE.md
│   └── workflows/php-ci.yml
├── app/Services/Calculator.php
├── tests/Unit/CalculatorTest.php
└── composer.json
```

## Запуск тестів та лінтера

```bash
composer install
./vendor/bin/phpunit tests/Unit   # юніт-тести
./vendor/bin/pint --test          # перевірка стилю коду
```
