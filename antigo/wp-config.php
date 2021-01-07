<?php
define('WP_AUTO_UPDATE_CORE', 'minor');// This setting is required to make sure that WordPress updates can be properly managed in WordPress Toolkit. Remove this line if this WordPress website is not managed by WordPress Toolkit anymore.
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'wwwconsorscom_wp' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'wwwconsorscom_wp' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '7F&9oman$8wp' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '?P@Q_C<`TcF:[upSO_Zc`Ur5R}]5Zw[6Gy60TgQUFCW/4#NIB%;o9wSWr^OBhDH#' );
define( 'SECURE_AUTH_KEY',  'r,Cad00HC](H,+f8C.qA$eRQpDU.`%eNc%E E6]&W6BJ*A(}d(%zz[[0+;Q4+gi@' );
define( 'LOGGED_IN_KEY',    '#x2ln-/<S}^8BJ0!XY1rBi76${2HJ9_c8^a&HFh<2?C;I/ZcSPE;|-[n3T2fn( =' );
define( 'NONCE_KEY',        'd3B(b2_@egn4Qn=gvpo=GRj4bn]fM>H02O IXoFGUXtSze:2IOpfbC)W|2.+FeIc' );
define( 'AUTH_SALT',        'x|A0IG0ae|)_;VMO@?:nR2I!Z@[1,#fJDkC~bid0pjF7H~EnjDqf5_ioLvsS?Av>' );
define( 'SECURE_AUTH_SALT', ']i;lQ$WWM<}pU7mSP_jQE[wD{#uVEi0F2H|s*Oo7t~ylyM)waBamHYMSt}RPKkM?' );
define( 'LOGGED_IN_SALT',   'EyAEcS~w3p@qyK5:&3eIW{iY=Nf[BshCKf|h{zzlA~c#Sc[)Yp7<NJUXA|^zRxgR' );
define( 'NONCE_SALT',       '1rX0^qe_JlHt o4w!*=d/iC0qAzG2n@t03~A41mnx-Lsb%a7E+4#rGIIr0=gjz&g' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
