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
define( 'DB_NAME', 'decenter' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '_gGFE@[jhPe^,LcA#Q)YeN8:ZqMNp4q0D!z,O)J)U^=ifW.X (,Y4@Hp5Xg$m.(:' );
define( 'SECURE_AUTH_KEY',  'dB2yzsw_)Hx s!1Dh+p@QTQI3aUua*Ffc2![HqG$+JEL`N4M,`Wp&Dw~}bT<s@D|' );
define( 'LOGGED_IN_KEY',    '[wB6B`CE4iEgK@Y47Z-P41*{T@R$#ams4B$re[}zlC[$0n3m7B0{L&aFa>3h@4,)' );
define( 'NONCE_KEY',        'h3%l)hakXgsm=e2E0u`ePjYPF-4i=V/}3Pw0Ui&I@?^J#[*Q!.dy{6D8f_fo|dLM' );
define( 'AUTH_SALT',        '2Jmgk!jfC,Wk?DkMyT{*hp /x`kFq&LikY#WpZ*v2HF^sh~;3Uw[mAj3B}6ms NX' );
define( 'SECURE_AUTH_SALT', 'hw%1FT[+_CNF)M1P)|2<xqXV1MIww%,9-uDY(s1)0Z q;`ZlEV@5xYDFe=RTqV1F' );
define( 'LOGGED_IN_SALT',   '`TH5l=E$nrE$t6z;-RHYqflGL(,iy)[oyf|1Y G#nh-%LB8%8%?K+(=3#FF8n%1S' );
define( 'NONCE_SALT',       '8>iUSzfZ jFKXu%+w1_Ahxg lQmY!48w[Tm3f`B,h.w[vLqPFqJ,5H:S8ag-bq%(' );

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
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );
