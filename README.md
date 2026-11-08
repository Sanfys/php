Система підтримки складання розкладу занять: PHP CI/CD Lab
![PHP CI Application](https://github.com/YOUR_USERNAME/YOUR_REPOSITORY/actions/workflows/php-ci.yml/badge.svg)
Навчальний проєкт з дисципліни «Веб-програмування»: веб-система «Система підтримки складання розкладу занять» на PHP з автоматизованим CI/CD-пайплайном (GitHub Actions), лінтером Laravel Pint та юніт-тестами PHPUnit.
Функціонал
Складання розкладу — розподіл занять за групами, викладачами, аудиторіями та часовими слотами з перевіркою конфліктів
Керування навчальним навантаженням — призначення викладачів на дисципліни та групи
Перегляд розкладу — за групою, викладачем або аудиторією, експорт у PDF
CI-пайплайн — перевірка стилю коду (Pint) та запуск юніт-тестів (PHPUnit) при кожному push / Pull Request
Проєктування — Use Case та Class діаграми (UML) у каталозі `docs/`
Керування задачами — GitHub Issues + Kanban-дошка GitHub Projects
Структура проєкту
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
Встановлення та запуск
```bash
git clone https://github.com/YOUR_USERNAME/YOUR_REPOSITORY.git
cd YOUR_REPOSITORY
composer install
php -S localhost:8000     # відкрити http://localhost:8000
```
Запуск тестів та лінтера
```bash
./vendor/bin/phpunit tests/Unit   # юніт-тести
./vendor/bin/pint --test          # перевірка стилю коду (без змін)
./vendor/bin/pint                 # автоматичне виправлення стилю
```
Документація
Опис предметної галузі, Use Case та діаграми класів — у файлі `docs/architecture.md`.