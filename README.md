![logo](./logo.png)

<div id="start" hidden></div>

<h1 align=center>Ticket CRM</h1>

<div align="center">
	<img src="https://img.shields.io/badge/Laravel-darkred">
	<img src="https://img.shields.io/badge/Tailwind-indigo">
	<img src="https://img.shields.io/badge/Spatie-Permission-pink">
	<img src="https://img.shields.io/badge/Spatie-Medialibrary-pink">
</div>

<div align="center" style="margin-top: 10px;">
	<img src="https://img.shields.io/badge/Status-Improving-yellow">
</div>

## Навигация

- <a href="#описание"><u>Описание</u></a>
- <a href="#превью"><u>Превью сайта</u></a>
- <a href="#использование"><u>Использование</u></a>

## Описание

#### Про сайт

Мини CRM для просмотра и обработки заявок с сайта через универсальный виджет

## Структура

#### Админ панель
- Стандартная аутентификация `Laravel` с защитой посредников `auth` | `guest`;
- Маршруты админ панели защищены посредником ролью `manager` присвоенной пакетом `spatie/laravel-Permission`;
- Список всех заявок и возможность отфильтровать получаемые данные с помощью `Query Scopes`;
- Статистика по количеству заявок за сутки, неделю, месяц и общей сумме + сравнение активности относительно вчера используя `Carbon` и `Eloquent Scopes`;
- Возможность просматривать/скачивать приложенные через `spatie/laravel-multimedia` к заявке файлы.

#### Виджет
- Адаптивный для вставки в `<iframe>` дизайн;
- Стили `Tailwind CSS`;
- Запрос выполняется асинхронно через `JS`;
- Показ ошибок валидации и сервера;

#### API Эндпоинты
**Создание заявки из виджета**
- _POST_ `/api/tickets` - Создать заявку
	- требуется json с полями `name`, `email`, `number`, `subject`, `text`
	- (необязательно) к заявке прикрепляются файлы `attachments`

**Получение статистики для админ панели**
- _GET_ `/api/tickets/statistics` - Получить статистику

#### API Ответы

<p style="color: lime; text-decoration: underline; font-weight: bold;">Успешные</p>

##### Cоздание заявки:
Код ответа -  `200`
```json
{
    "message": "Заявка создана успешно"
}
```

##### Получение статистики:
Код ответа -  `200`
```json
{
    "message": "Статистика получена успешно",
    "stats": {
        "today": 2,
        "yesterday": 1,
        "this_week": 188,
        "this_month": 190,
        "total": 194
    }
}
```

<p style="color: red; text-decoration: underline; font-weight: bold;">Неудачные</p>

##### Cоздание заявки:
Код ответа -  `422`
```json
{
    "message": "Ошибка валидации",
    "errors": {
        "name": [
            "Максимальное значение 64 символов"
        ],
        "email": [
            "Невалидный адрес"
        ],
        "phone": [
            "Невалидный номер телефона"
        ],
        "subject": [
            "Минимальное значение 3 символа"
        ],
        "text": [
            "Поле обязательно для заполнения"
        ]
    }
}
```

##### Невалидный URL
Код ответа -  `404`
```json
{
    "message": "Ресурс не найден"
}
```

##### Ошибка более 1 запроса в сутки
Код ответа -  `429`
```json
{
    "message": "Доступно лишь 1 заявку в сутки"
}
```

##### Остальные возможные ошибки
Код ответа -  `500`
```json
{
    "message": "Ошибка сервера"
}
```

#### Правила валидации

##### Создание заявки:
Все поля кроме файлов `обязательны` для заполнения:
- Поле `name` от 3 до 64 символов
- Поле `email` должно быть валидным адресом эл.почты
- Поле `phone` до 15 символов
- Поле `subject` от 3 до 255 символов
- Файлы `attachments` могут быть:
	- изображения *[jpeg, jpg, png, gif, webp]*
	- аудио *[mpeg, wav, ogg, mp3]*
	- видео *[mp4, quicktime, x-msvideo]*
	- документы *[pdf, msword, plain, docx]*

## Превью
**Главная страница**


## Использование

> Убедитесь что у вас уже установлен PHP, Composer, Node.js, (Git)

**После скачивания или клонирования проекта нужно установить backend зависимости:**
```bash
composer install
```
**Установить frontend зависимости:**
```bash
npm install
```

**Скопировать данные из файла .env.example в .env и сгенерировать новый ключ приложения и вставить в APP_KEY:**
```bash
php artisan key:generate
```

**Далее укажите свой конфиг для настройки БД**

```bash
DB_CONNECTION=sqlite
```

**Или если MySQL:**

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Db_Name
DB_USERNAME=Your_Username
DB_PASSWORD=Your_Password
```


**Запустить миграции для БД:**
```bash
php artisan migrate
```

**(Опционально) Засеять тестовыми данными БД из фабрик `Laravel`:**
```bash
php artisan db:seed
```

**Для локальной разработки нужно запустить frontend и backend сервера:**
```bash
php artisan serve
```
```bash
npm run dev
```

#### <a href="#start">⬆ Наверх</a>