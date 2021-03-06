# Используемые паттерны

## DDD

Доменная организация - как наиболее удачная для проекта, который будет расти. 
Также удобно работать в контексте бизнес-задач.

* `App\Domain\Article\Models` - модели
* `App\Domain\Article\Views` - представления
* `App\Domain\Article\Controllers` - контроллеры
* `App\Domain\Article\...` - события, статусы, транзакции, ...

[Концепция тут](https://stitcher.io/blog/laravel-beyond-crud-01-domain-oriented-laravel)

## MVC

MVC - используется **M** - "модель" для хранения данных - с целью отделение данных от логики приложения.

Надо стремиться сохранить модели как можно тоньше.

[Подробнее тут](https://stitcher.io/blog/laravel-beyond-crud-04-models)

## Фабрика `\App\ArticleFactory` 

Для создания статей от имени пользователя. SOLID - буква **S**, принцип единственной ответственности. 

Создание статей нельзя делегировать ни в одну модель. Поэтому - фабрика.

