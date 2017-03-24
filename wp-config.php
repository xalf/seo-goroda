<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'seo-goroda');

/** Имя пользователя MySQL */
define('DB_USER', 'galya');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'password');

/** Имя сервера MySQL */
define('DB_HOST', '127.0.0.1');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '-h<]}nQ{S%FVX,qYpZIRXMPlLD{4VxY9ow]prZ*b?T[ZZcZ4@M_uf,=)J%v^KqJ(');
define('SECURE_AUTH_KEY',  'TCqZx5jHYA||)&F8UTVhbQnu*>_3unK>+t{Ydza){ jC~47x^w>B:}|{6[z(ni[f');
define('LOGGED_IN_KEY',    'bwlfNA$=p6kafD}ot!,v:R}PdX3+fg/fTT}SuE5:g1lt=qP+3gTl+-dzJd<8~4=i');
define('NONCE_KEY',        '1bCDpf.31Y^E+%ePPnyeswVCZOeT)B8 oZG}PbdJ@Wq=>keig`zrgXZMVTEqvk})');
define('AUTH_SALT',        '3n$qO{F1#3pX?XItkc,<(Ja#RW^(5HVIqJz4-2x?4;7OU4n0j__DORz>8m2:,8wm');
define('SECURE_AUTH_SALT', '`bzA!aX faceND3/]gm^sa6l x[c=B0.caF(MTm_BNmv 3Ea/gG[Z&zTj*lZl0S ');
define('LOGGED_IN_SALT',   '`V9tH#&8<K7Labl1yYeQ}{^u,Bt-c86 IWO6>+<7|]q(&>+r{g~V]Ab:)&VWW^3j');
define('NONCE_SALT',       ';F48IKN%<NnK_W?dvWV*WLV))wgLHarW-3n8!xaR$ya:iAm*Iy&aT3~I0.*tL-gd');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 * 
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
