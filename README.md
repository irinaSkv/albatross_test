Укротитель ссылок на Yii
===========================================

Сервис укорачивания длинных ссылок.
Пользователь может ввести любой URL в поле ввода. По нажатию на кнопку "Укоротить", 
сервис вернет пользователю короткий урл вида http://albatross_test.local/wD, 
который будет перенаправлять на исходную ссылку. 

Требования
----------

 * PHP 5.4 +
 * Composer
 * Git
 * MySql

Установка и начало работы
-------------------------

 * Для установки склонируйте этот репозиторий или скачайте архив
 * Полученные файлы и папки разместите в web директории.
 * Выполните composer install для установки yii2 и ./init.
 * Файл index.php находится в /var/www/your_project/frontend/web/index.php
 * Настройте подключение к базе данных (/common/config/main-local.php)
 * Выполните необходимые миграции (./yii migrate).
