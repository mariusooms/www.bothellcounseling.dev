<?php
/*
 * This file holds the db credentials for this site
 * You should RENAME this file as follows:
 * 
 * =================IMPORTANT========================
 * == Local enviroment: local-config.php           ==
 * == Stable enviroment: stabe-config.php          ==
 * == Production enviroment: production-config.php ==
 * ==================================================
 *
 */
 
/* WordPress Environment DB credentials */
 
define('DB_NAME', 'db-name');
define('DB_USER', 'username');
define('DB_PASSWORD', 'password');
define('DB_HOST', 'localhost');
 
/* Keys & Salts https://api.wordpress.org/secret-key/1.1/salt/ */
 
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
define('LOGGED_IN_KEY',    'put your unique phrase here');
define('NONCE_KEY',        'put your unique phrase here');
define('AUTH_SALT',        'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT',   'put your unique phrase here');
define('NONCE_SALT',       'put your unique phrase here');