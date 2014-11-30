<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur 
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'cxo2zffc');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'cxo2zffc');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '4msupcqal4cadtjsc');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', '127.0.0.1');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

/** Type de collation de la base de données. 
  * N'y touchez que si vous savez ce que vous faites. 
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant 
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'qZC(T*Vl1 2^^SUnE~j*8GAB8Q-O|qCj^O])Q#xGm-<(5~](:Xa/W}R)}jyN<u-E');
define('SECURE_AUTH_KEY',  'c~&Q+rEf1ZTViVrF+5s5g|;uePgp|Z%Y,SWxer|.a1I6A0+QCQjvA_I&I;iDwzd6');
define('LOGGED_IN_KEY',    '4=_UTIa#x~H5[EA-0+6CU+thv$-~/FA}X-LNx{2%7+?`qunPvpK/-H+`{D$^T};Q');
define('NONCE_KEY',        'qI}-Bp-kcO7dP2R*H.2]lmeztgc|3>jsTGM|gdBIDW&x1n4t|j%})~+|RU$& `V6');
define('AUTH_SALT',        '&p%mU`)vm-+4o![3O8xln/AwaPr<eG~h]dPqjs+.wN:9tln?.Qc52m~lEL}RwuD6');
define('SECURE_AUTH_SALT', 'k?|0*ZPT/Z]Ka}7q{{*/fT92V-N|Pe|m.}Vrk^)iWBE29~eV+X-~zXpBX8%iK1XC');
define('LOGGED_IN_SALT',   '2z+1s;_3N5|3o3xRnxFGNkk.8FRq #q-<?j-6e/V^D-JFq-(}6N(|$+sD{C{F/&K');
define('NONCE_SALT',       ')d!%]7ZDEYq6Vt2)z.{xcu`XAg(Ei>1qO$i&)dOSG5gyE)+VBy_0XSJM$8%-5C;)');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique. 
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_';

/** 
 * Pour les développeurs : le mode deboguage de WordPress.
 * 
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant votre essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de 
 * développement.
 */ 
define('WP_DEBUG', false); 

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');