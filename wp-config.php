<?php
/**
 * WordPress基础配置文件。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以不使用网站，您需要手动复制这个文件，
 * 并重命名为“wp-config.php”，然后填入相关信息。
 *
 * 本文件包含以下配置选项：
 *
 * * MySQL设置
 * * 密钥
 * * 数据库表名前缀
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */
define( 'DB_NAME', 'wordpress' );

/** MySQL数据库用户名 */
define( 'DB_USER', 'root' );

/** MySQL数据库密码 */
define( 'DB_PASSWORD', '123456' );

/** MySQL主机 */
define( 'DB_HOST', 'localhost' );

/** 创建数据表时默认的文字编码 */
define( 'DB_CHARSET', 'utf8mb4' );

/** 数据库整理类型。如不确定请勿更改 */
define( 'DB_COLLATE', '' );

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '[OPrts^2qWu*5d2^H<?*~ap2Nohq1,8S8_cOn[TOMf8h~_JNUfM U}cnP*|>@?Bc' );
define( 'SECURE_AUTH_KEY',  'KLQ^RPe6*LgBeV:{Bl D(I#r[nWd`KH.|u=2lk1R|vmO2/j*(uYTl&1[{ 0^m$sF' );
define( 'LOGGED_IN_KEY',    'A?u6:o-?@rf}w$XQz0X7uJh^s=gO`>]#Q:*hnb@+FKcmO2>rtoG3Jjx6{(X 5{r$' );
define( 'NONCE_KEY',        'GbX:pZB%JGw2l}UV;xjg3xQ0w|bFo(AwxBkz#o^4;>AUa;PZ]:8GS5;qTjNVM{:f' );
define( 'AUTH_SALT',        '-35Ly1hPZtfNVO9y6*<Ggzml5zhe,UJ:U&N*,Oie9!oh2[?AhlwCmyE;=ayFA:J%' );
define( 'SECURE_AUTH_SALT', 'w_&vcHBSe9fcbL9_=$DgGQ5=EyD}j[<81K]}{>p5wa0s1:/F8rI7dOh(l^+#BX?U' );
define( 'LOGGED_IN_SALT',   'mJ$?TnP A2e!I>YCdok+vq,6n|GEN%F[(qvLO$VSk!?zt)@&yNL=O5Q?b<w2$[&v' );
define( 'NONCE_SALT',       '1A68l-gq>C?](OI[P7bqs/fe~G}8@&s?F`^p-,E fZsq<U2[$@gZ-KTXIM.gi6uM' );

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix = 'wp_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 *
 * 要获取其他能用于调试的信息，请访问Codex。
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** 设置WordPress变量和包含文件。 */
require_once( ABSPATH . 'wp-settings.php' );
