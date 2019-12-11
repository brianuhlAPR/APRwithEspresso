<?php
# Database Configuration
define( 'DB_NAME', 'wp_aprtesttheme' );
define( 'DB_USER', 'aprtesttheme' );
define( 'DB_PASSWORD', 'QK6friI-1mzhWx_30jxR' );
define( 'DB_HOST', '127.0.0.1' );
define( 'DB_HOST_SLAVE', '127.0.0.1' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'wp_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         'A:qHUW-ZCk2iqj:<|82?=GS&Qvt>-5dbg5($o%REX+{m# F6%I=V+P4*EG?lvz+|');
define('SECURE_AUTH_KEY',  '5K+cz+G%(,`!vz7_n25j^]USi;.rffq_j+?7*(%&CwvplBa+`^E-^hT8@9Vo-xeX');
define('LOGGED_IN_KEY',    '+(z_|-U5Ca9C#</`Q7T=y-fN__3HRO1X[c+qqDU~p=^N+*@#u<#+N:5:WInMZk#n');
define('NONCE_KEY',        '0tbC9Pb+GRB2sW8ayKW(3[ ]5q+%_+o=1Skwt)8XmGnH-.KZ@.`?m~8K$4;l!BDd');
define('AUTH_SALT',        '9kn9|4@vo(G[,>&o2euHw{?$4SBx2<oMOQ8Iu]7)+Gcez,?Eeq+`~5n[W40G|f}l');
define('SECURE_AUTH_SALT', 'S5 IX{I;W.=X>l2KL:&Plj`8#1ustNk2X<yjh,4sr1[TVhaiRoG<Vfa}<Z=uXt44');
define('LOGGED_IN_SALT',   ']imu6smZ|Q%pFPQ rDhS;d4EkG/,KVM<4F{0UjPlldO-7^wSh2f>t;Rchcn#3a;8');
define('NONCE_SALT',       'pO_V~{=tspa!fI r]0fmCWMh4[+{)?d~=8X!o2itBfDF_o*8[5PQ/@+IC|8)Z}A+');


# Localized Language Stuff

define( 'WP_CACHE', TRUE );

define( 'WP_AUTO_UPDATE_CORE', false );

define( 'PWP_NAME', 'aprtesttheme' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

define( 'PWP_ROOT_DIR', '/nas/wp' );

define( 'WPE_APIKEY', '4379df61c0f1d5ce206e1cdd27f77799a756915e' );

define( 'WPE_CLUSTER_ID', '100442' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );

define( 'WPE_SFTP_PORT', 2222 );

define( 'WPE_LBMASTER_IP', '' );

define( 'WPE_CDN_DISABLE_ALLOWED', false );

define( 'DISALLOW_FILE_MODS', FALSE );

define( 'DISALLOW_FILE_EDIT', FALSE );

define( 'DISABLE_WP_CRON', false );

define( 'WPE_FORCE_SSL_LOGIN', false );

define( 'FORCE_SSL_LOGIN', false );

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define( 'WPE_EXTERNAL_URL', false );

define( 'WP_POST_REVISIONS', FALSE );

define( 'WPE_WHITELABEL', 'wpengine' );

define( 'WP_TURN_OFF_ADMIN_BAR', false );

define( 'WPE_BETA_TESTER', false );

umask(0002);

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'aprtesttheme.wpengine.com', );

$wpe_varnish_servers=array ( 0 => 'pod-100442', );

$wpe_special_ips=array ( 0 => '104.196.173.197', );

$wpe_netdna_domains=array ( );

$wpe_netdna_domains_secure=array ( );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( );
define('WPLANG','');

# WP Engine ID


# WP Engine Settings






# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', __DIR__ . '/');
require_once(ABSPATH . 'wp-settings.php');








