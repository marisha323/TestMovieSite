Кроки для налаштування проєкту
Налаштування файлу .env:

Скопіюйте файл .env.example і перейменуйте його на .env.
Відредагуйте .env файл відповідно до вашого середовища:
Встановіть параметри підключення до бази даних, наприклад:


DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

Запуск міграцій:
Виконайте команду для створення таблиць у базі даних:

php artisan migrate

Це створить всі необхідні таблиці згідно з вашими міграціями.



php artisan migrate

Запуск сідерів:
Якщо ви хочете додати початкові дані до бази даних, виконайте команду для запуску сідерів:

php artisan db:seed

Це додасть дані, визначені у ваших сідерах, у таблиці бази даних.
Перевірка:

Після виконання вищезгаданих кроків перевірте, чи все працює належним чином.
Переконайтесь, що дані з'явилися у вашій базі даних і проєкт працює коректно.
