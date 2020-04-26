<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'cakeluxury' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '@[.{b2-;R]E9Hvh8P>@z]TV]@v)K60YK)x+:mx^Zn/2Q4(E^k^~*-wdI}Qf{KKRW' );
define( 'SECURE_AUTH_KEY',  'T:!Hi h02]W[1an## VV3Blv6s8RV7=8n(QhO1V@AW2_o3I]6fxb%lhY;/~:n*qP' );
define( 'LOGGED_IN_KEY',    'fc=bL!F!h:[kMZ|{@s_E7r<ri`(O}Dzsrd4`FqeGU*+T0|pVA6^Wk !=@?B|.&V%' );
define( 'NONCE_KEY',        'HObDIrS<_wo%Ls<jR](t8W*0)B[Z:pe &<RVmx%<>:sXp+$1Xd[U/I@oVXDW`3|3' );
define( 'AUTH_SALT',        '`.0$Wi1R!#HLiJ#hIjF|ZvqcCq!L[ X>m=tHMHM<9^(=%&[om$,>C6B9RGxGbw =' );
define( 'SECURE_AUTH_SALT', 'E_+R&GPtM:(Q@G]5U@J|AEP9]pYLx&nQHXWIJQLcB+#e>[4x,@ iBpAE+xKdI{+>' );
define( 'LOGGED_IN_SALT',   '0_|B+mapwIc],?>7$~~W)KR;pF[hC$i6<At7;}Qa?RulA*ur@uT8mS:hNQ*r(MI4' );
define( 'NONCE_SALT',       '4dg;zT>kC2$fGnlXHebQSnlH>~Zcy/VS[kbPTQ<zw??5r`%y^qA}E1x!.DbEk$:!' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
