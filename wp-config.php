<?php
# Database Configuration
define( 'DB_NAME', 'wp_homebuyerdev1' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_HOST', '127.0.0.1:3306' );
define( 'DB_HOST_SLAVE', '127.0.0.1:3306' );
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');
$table_prefix = 'wp_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         '9!j,%t23D5kTIBiV@+!uO-PPx%2&TGY[:MRJ+#hbRRxJ(XFYa}2<aPVZdN$Cbl@*');
define('SECURE_AUTH_KEY',  'y1|J=B+xWY/Uxc<zaX)NM21(@9yvnGmgLL(3q?%B<Y~8R0A+fNi!-^ra1nO|!pD(');
define('LOGGED_IN_KEY',    'F0F]u]x#Nl!XSWb_(#zf:I~9NjDi[]5Pd35<5?-6 aX=Zd!;a~y0VT[Y-M|(hzs*');
define('NONCE_KEY',        'NC+|%Lc[xc5lD)Z}$AE2}@.yz+>~AywtoT::}V<?AZcnSsE3{K $gbP[69%|l;cj');
define('AUTH_SALT',        'wy7-/1?aqTy(cjC]B9GJ*a_/sbl> 3aw^3BxmjJS*;Q_2M)dq)-_:1vM;T[Srw(Q');
define('SECURE_AUTH_SALT', 'c%vHDWA gWB:TEP^c89kz)?)>*pzO5Y&gq+|JSKS?>t[0EIWsxF_CnnlRxgwfDG@');
define('LOGGED_IN_SALT',   '<uh1O[cLA]Q9FX7YNg(yha9V591x 9dnwmLQn:L@5eTmj%C.jZryJz-}xf9Hpy<w');
define('NONCE_SALT',       '>Z|yT~Goz()e8-;e6!!Trx:KvFtxeS5ss_:[V3=GX#&U#BCTy#5F!6qP4~P{y;qq');


# Localized Language Stuff


define( 'WP_AUTO_UPDATE_CORE', false );

define( 'PWP_NAME', 'homebuyerdev1' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

define( 'WPE_APIKEY', '6cf6a0811dbc664b887cc6cbf8aa75b107b4e0ac' );

define( 'WPE_CLUSTER_ID', '140213' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );

define( 'WPE_SFTP_PORT', 2222 );

define( 'WPE_SFTP_ENDPOINT', '' );

define( 'WPE_LBMASTER_IP', '' );

define( 'WPE_CDN_DISABLE_ALLOWED', true );

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

define('WP_MEMORY_LIMIT', '256M');

umask(0002);

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'homebuyerdev1.wpengine.com', 1 => 'homebuyerdev1.wpenginepowered.com', );

$wpe_varnish_servers=array ( 0 => 'pod-140213', );

$wpe_special_ips=array ( 0 => '35.203.160.159', );

$wpe_netdna_domains=array ( );

$wpe_netdna_domains_secure=array ( );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( 'default' =>  array ( 0 => 'unix:///tmp/memcached.sock', ), );


# WP Engine ID


# WP Engine Settings


//define( 'WP_DEBUG', true );
//define( 'WP_DEBUG_LOG', true );
//define( 'WP_DEBUG_DISPLAY', false );





# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', __DIR__ . '/');
require_once(ABSPATH . 'wp-settings.php');

if ( ! defined( 'WP_CACHE' ) ) {
	define( 'WP_CACHE', TRUE );
}
