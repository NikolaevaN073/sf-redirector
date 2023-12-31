# Проект: Итоговая работа на курсе "Приложение SF-AdTech"

Разработан в качестве практического итогового задания на курсе.

## Описание проекта

Приложение SF-AdTech — это трекер трафика, созданный для организации взаимодействия компаний (рекламодателей), которые хотят привлечь к себе на сайт посетителей и покупателей (клиентов), и владельцев сайтов (веб-мастеров), на которые люди приходят, например, чтобы почитать новости или пообщаться на форуме.

## В проекте реализованы следующие задачи: 

* Реализована возможность регистрации и авторизации пользователей
* Разработан интерфейс рекламодателя
* Создана возможность добавлять предложения в систему
* Создана возможность просмотра всех своих предложений рекламодателем
* Добавлена возможноть активировать и деактивировать рекламные предложения
* Добавлена возможность просмотра статистики рекламодателем по офферу за день, или месяц, или год
* Разработан интерфейс веб-мастера
* Создана возможность подписаться на предложение
* Создана возможность просмотра всех предложений, на которые подписан веб-мастер
* Добавлена возможноть отписаться от предложения
* При подписке на оффер веб-мастер получает ссылку от системы 
* Переход по ссылке реализует возможность учесть в системе этот переход 
* Добавлена возможность просмотра статистики веб-мастером по переходам за день, или месяц, или год
* Разработан интерфейс администратора
* Создана возможность подключать и отключать пользователей
* Реализована возможность подсчета системой количества выданных ссылок, переходов по ссылкам, отказов
* Добавлена возможность рассчета общего дохода системы 

## Используемые технологии

* HTML5
* CSS3 
* JavaScript
* bootstrap-5.3.0
* PHP 8.1.9
* Сервер: Apache/2.4.52 (Win64) PHP/8.1.9

## Для корректной работы приложения необходимо:

* Импортировать дамп БД из файла "data/sf-adtech.sql"
* Установить composer командой composer install
* В файле "config/config.php" подставить данные для подключения БД, значение переменной APP_URL
* Тестовые данные для пользователя с правами admin: Login: admin@test.com Password: 11111
* Тестовые данные для пользователя customer: Login: test1@test.com Password: 11111
* Тестовые данные для пользователя webmaster: Login: web1@test.com Password: 11111