<?php
/**
 * OpenCAD Version
 *
 * Contains version information for the current OpenCAD release.
 *
 * @package OpenCAD
 * @since 0.3.1
 */

/**
 * The OpenCAD version string
 *
 * @global string $oc_version
 */
define('OC_VERSION', '1.0.0');

/**
 * Holds the OpenCAD DB revision, increments when changes are made to the OpenCAD DB schema.
 *
 * @global int $oc_db_version
 */
define('OC_DB_VERSION', '1.0.0');

/**
 * Holds the required PHP version
 *
 * @global string $required_php_version
 */
define('MINIMUM_PHP_VERSION', '7.3');
define('RECOMENDED_PHP_VERSION', '7.4');

/**
 * Holds the required MySQL version
 *
 * @global string $required_mysql_version
 */
define('REQUIRED_MYSQL_VERSION', '8.0');