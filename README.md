# Інтернет-магазин: PHP CI/CD Lab

[![PHP CI Application](https://github.com/YOUR_USERNAME/YOUR_REPOSITORY/actions/workflows/php-ci.yml/badge.svg)](https://github.com/YOUR_USERNAME/YOUR_REPOSITORY/actions/workflows/php-ci.yml)

Навчальний проєкт з дисципліни **«Веб-програмування»**: веб-система **«Інтернет-магазин»** на PHP з автоматизованим CI/CD-пайплайном (GitHub Actions), лінтером Laravel Pint та юніт-тестами PHPUnit.

## Функціонал

- **Керування версіями** — Git + GitHub, Pull Request-и з шаблоном і рецензуванням, захист гілки `main`
- **CI-пайплайн** — перевірка стилю коду (Pint) та запуск юніт-тестів (PHPUnit) при кожному push / Pull Request
- **Проєктування** — Use Case та Class діаграми (UML) у каталозі [`docs/`](docs/architecture.md)
- **Основи PHP** — масиви, функції зі строгою типізацією, замикання, генерація даних (Faker), обробка винятків
- **Керування задачами** — GitHub Issues + Kanban-дошка GitHub Projects

## Структура проєкту

```text
.
├── .github/
│   ├── PULL_REQUEST_TEMPLATE.md
│   └── workflows/php-ci.yml
├── app/
│   ├── Models/EntityArray.php
│   └── Services/ (Calculator, EntityService, DataProcessor)
├── docs/                 # UML-діаграми та architecture.md
├── tests/Unit/           # PHPUnit-тести
├── composer.json
├── phpunit.xml
└── index.php
```

## Встановлення та запуск

```bash
git clone https://github.com/YOUR_USERNAME/YOUR_REPOSITORY.git
cd YOUR_REPOSITORY
composer install
php -S localhost:8000     # відкрити http://localhost:8000
```

## Запуск тестів та лінтера

```bash
./vendor/bin/phpunit tests/Unit   # юніт-тести
./vendor/bin/pint --test          # перевірка стилю коду (без змін)
./vendor/bin/pint                 # автоматичне виправлення стилю
```

## Документація

Опис предметної галузі, Use Case та діаграми класів — у файлі [`docs/architecture.md`](docs/architecture.md).
