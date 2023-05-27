<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'woocommerce');

/** Имя пользователя базы данных */
define('DB_USER', 'root');

/** Пароль к базе данных */
define('DB_PASSWORD', '');

/** Имя сервера базы данных */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', ')Gjn%CElC,n)V3b1{x)?UN12lf@^Y:8X(OcVe62%2:1RtR^#`&A6+3cS?BWJSkaS');
define('SECURE_AUTH_KEY', 'N:O#Tr?x/:f3|I2y*L[^;2;-&<l}2hS2_zTi  oM=uMii5qz{E1]yfk09%RSyi]{');
define('LOGGED_IN_KEY', '8otEuZMQ=ePp@qb4}Y{A)muz?M+1Su$5;{D:Kq/RxSgtQzwRA>[pH$xhzu<aKAJj');
define('NONCE_KEY', '#P*#I:JO`qGou#6u75  N snZ$^NlH+:@&;P{f6P^gmDrm..7FBb&.b(W2]nkB=0');
define('AUTH_SALT', '5{rVJYf[U^uevo1FFuLLGj$1bOUv]:Rm5rdo18e]^O{,C)CDjz.`K4[cY];a9O|>');
define('SECURE_AUTH_SALT', '^gmpCVwC 9Vp ucm7>{M]7}$6;lQSitP4$|ok03~3:0ZVwV[YB;|^8FRYShv;?MM');
define('LOGGED_IN_SALT', '5Pf&jWzb[{47E/s^2+TsH;L_MO11ErpBr]f]Yi8a@VJeYonL]q)&P.r9Xh`5xrif');
define('NONCE_SALT', 'sJc/>O8-WD8ZZG7b}7Kui<S5al5J%oAZWz%^:vW_Slv2){3VNbKfhKpRzf:{]V(4');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', true);

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */


/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
