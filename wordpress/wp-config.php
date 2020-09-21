<?php
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
define( 'DB_NAME', 'dbwp_consors' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'root' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '+yDtcNS$=+-A8UY(#`?#M*/$5.Dc&^xas=7EyK3#6Fa}]ye^D`|FqzjN5=]1BqXl' );
define( 'SECURE_AUTH_KEY',  'b]vmm_CN-@mT1j|6)G Uzi,]6<#iy`V&P>W`6v#O6<-[[WI,0YNS5dh94,tb(M.s' );
define( 'LOGGED_IN_KEY',    '&Y>T&~QuB(|C9DeUGuU?F}Nmt8+6f1.4Fc.?TM*/ oz5i-`]fum52EKETiyh!d1B' );
define( 'NONCE_KEY',        'Cb,#^Az=Zf*q@$djScbKotM|=Dn)}*AaVyvI3TF*5pTnFw/ji-qpI$ #Nj ,|d,C' );
define( 'AUTH_SALT',        'D5>!-M^=n?_Z=9;-3Ravf#IA48CJxzB5a6n,&C)LV>) )pfbtK@A2qv,<G6zggRw' );
define( 'SECURE_AUTH_SALT', '/&HiXb$B=5Y(-i@T(.?N8K|(2;NWYE!-..wu<}>6:d[ZxAHY5|jB1X JY:%j?qYK' );
define( 'LOGGED_IN_SALT',   'OGADcK(DBookUr=8|9mZ5=MGuy)d,@@]6!MT9Qup:PM={wKf70@Ep+Tt8[=cync4' );
define( 'NONCE_SALT',       'PoyLui V,wG[{g@.Wmrvg+J+@&!UfV~R#k2KOMGV0/[Xyxu$>a_&cgDZZq/L#b<q' );

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
