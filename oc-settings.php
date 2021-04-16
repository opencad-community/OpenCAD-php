<?php

/**
 * Used to set up and fix common variables and include
 * the OpenCAD procedural and class library.
 *
 * Allows for some configuration in oc-config.php (see default-constants.php)
 *
 * @package OpenCAD
 */
/**
 * Stores the location of the OpenCAD directory of functions, classes, and core content.
 *
 * @from OpenCAD
 * 
 * @since 0.3.1
 */
define( 'OCINC', 'oc-includes' );
define( 'OCAPPS', 'oc-apps' );
define( 'OCCONTENT', 'oc-content' );
define( 'OCTHEMES', 'oc-content/themes' );
define( 'OCTHEMEINC', 'oc-content/themes/'. THEME .'/includes' );
define( 'OCTHEMEMOD', 'oc-content/themes/'. THEME .'/modals' );
/*
 * These can't be directly globalized in version.php. When updating,
 * we're including version.php from another installation and don't want
 * these values to be overridden if already set.
 */
global $oc_version, $oc_db_version, $tinymce_version, $required_php_version, $required_mysql_version, $oc_local_package;
require( ABSPATH . OCINC . '/version.php' );

// Set initial default constants including OC_MEMORY_LIMIT, OC_MAX_MEMORY_LIMIT, OC_DEBUG, SCRIPT_DEBUG, OC_CONTENT_DIR and OC_CACHE.
oc_initial_constants();

/**
 * Defines initial OpenCAD constants
 *
 *
 * @from WordPress
 * 
 * @since 3.0.1
 *
 * @global int    $blog_id    The current site ID.
 * @global string $oc_version The OpenCAD version string.
 */
function oc_initial_constants() {


	/**#@+
	 * Constants for expressing human-readable data sizes in their respective number of bytes.
	 *
	 * @from WordPress
	 * 
	 * @since 0.3.1
	 */
	define( 'KB_IN_BYTES', 1024 );
	define( 'MB_IN_BYTES', 1024 * KB_IN_BYTES );
	define( 'GB_IN_BYTES', 1024 * MB_IN_BYTES );
	define( 'TB_IN_BYTES', 1024 * GB_IN_BYTES );
	/**#@-*/

	// Start of run timestamp.
	if ( ! defined( 'OC_START_TIMESTAMP' ) ) {
		define( 'OC_START_TIMESTAMP', microtime( true ) );
	}

	$current_limit     = ini_get( 'memory_limit' );
	$current_limit_int = oc_convert_hr_to_bytes( $current_limit );

	// Define memory limits.
	if ( ! defined( 'OC_MEMORY_LIMIT' ) ) {
		if ( false === oc_is_ini_value_changeable( 'memory_limit' ) ) {
			define( 'OC_MEMORY_LIMIT', $current_limit );
		} else {
			define( 'OC_MEMORY_LIMIT', '40M' );
		}
	}

	if ( ! defined( 'OC_MAX_MEMORY_LIMIT' ) ) {
		if ( false === oc_is_ini_value_changeable( 'memory_limit' ) ) {
			define( 'OC_MAX_MEMORY_LIMIT', $current_limit );
		} elseif ( -1 === $current_limit_int || $current_limit_int > 268435456 /* = 256M */ ) {
			define( 'OC_MAX_MEMORY_LIMIT', $current_limit );
		} else {
			define( 'OC_MAX_MEMORY_LIMIT', '256M' );
		}
	}

	// Set memory limits.
	$oc_limit_int = oc_convert_hr_to_bytes( OC_MEMORY_LIMIT );
	if ( -1 !== $current_limit_int && ( -1 === $oc_limit_int || $oc_limit_int > $current_limit_int ) ) {
		ini_set( 'memory_limit', OC_MEMORY_LIMIT );
	}

	if ( ! isset( $blog_id ) ) {
		$blog_id = 1;
	}

	if ( ! defined( 'OC_CONTENT_DIR' ) ) {
		define( 'OC_CONTENT_DIR', ABSPATH . 'oc-content' ); // no trailing slash, full paths only - OC_CONTENT_URL is defined further down
	}

	// Add define( 'OC_DEBUG', true ); to oc-config.php to enable display of notices during development.
	if ( ! defined( 'OC_DEBUG' ) ) {
		define( 'OC_DEBUG', false );
	}

	// Add define( 'OC_DEBUG_DISPLAY', null ); to oc-config.php use the globally configured setting for
	// display_errors and not force errors to be displayed. Use false to force display_errors off.
	if ( ! defined( 'OC_DEBUG_DISPLAY' ) ) {
		define( 'OC_DEBUG_DISPLAY', true );
	}

	// Add define( 'OC_DEBUG_LOG', true ); to enable error logging to wp-content/debug.log.
	if ( ! defined( 'OC_DEBUG_LOG' ) ) {
		define( 'OC_DEBUG_LOG', false );
	}

	if ( ! defined( 'OC_CACHE' ) ) {
		define( 'OC_CACHE', false );
	}

	// Add define( 'SCRIPT_DEBUG', true ); to oc-config.php to enable loading of non-minified,
	// non-concatenated scripts and stylesheets.
	if ( ! defined( 'SCRIPT_DEBUG' ) ) {
		if ( ! empty( $GLOBALS['oc_version'] ) ) {
			$develop_src = false !== strpos( $GLOBALS['oc_version'], '-src' );
		} else {
			$develop_src = false;
		}

		define( 'SCRIPT_DEBUG', $develop_src );
	}

	/**
	 * Private
	 */
	if ( ! defined( 'MEDIA_TRASH' ) ) {
		define( 'MEDIA_TRASH', false );
	}

	if ( ! defined( 'SHORTINIT' ) ) {
		define( 'SHORTINIT', false );
	}

	// Constants for features added to WP that should short-circuit their plugin implementations
	define( 'OC_FEATURE_BETTER_PASSWORDS', true );

	/**#@+
	 * Constants for expressing human-readable intervals
	 * in their respective number of seconds.
	 *
	 * Please note that these values are approximate and are provided for convenience.
	 * For example, MONTH_IN_SECONDS wrongly assumes every month has 30 days and
	 * YEAR_IN_SECONDS does not take leap years into account.
	 *
	 * If you need more accuracy please consider using the DateTime class (https://secure.php.net/manual/en/class.datetime.php).
	 *
	 * @from WordPress
	 * 
	 * @since 0.3.1
	 * @since 4.4.0 Introduced `MONTH_IN_SECONDS`.
	 */
	define( 'MINUTE_IN_SECONDS', 60 );
	define( 'HOUR_IN_SECONDS', 60 * MINUTE_IN_SECONDS );
	define( 'DAY_IN_SECONDS', 24 * HOUR_IN_SECONDS );
	define( 'WEEK_IN_SECONDS', 7 * DAY_IN_SECONDS );
	define( 'MONTH_IN_SECONDS', 30 * DAY_IN_SECONDS );
	define( 'YEAR_IN_SECONDS', 365 * DAY_IN_SECONDS );
	/**#@-*/
}

/**
 * Converts a shorthand byte value to an integer byte value.
 *
 * @from WordPress
 * 
 * @since 0.3.1
 *
 * @link https://secure.php.net/manual/en/function.ini-get.php
 * @link https://secure.php.net/manual/en/faq.using.php#faq.using.shorthandbytes
 *
 * @param string $value A (PHP ini) byte value, either shorthand or ordinary.
 * @return int An integer byte value.
 */
function oc_convert_hr_to_bytes( $value ) {
	$value = strtolower( trim( $value ) );
	$bytes = (int) $value;

	if ( false !== strpos( $value, 'g' ) ) {
		$bytes *= GB_IN_BYTES;
	} elseif ( false !== strpos( $value, 'm' ) ) {
		$bytes *= MB_IN_BYTES;
	} elseif ( false !== strpos( $value, 'k' ) ) {
		$bytes *= KB_IN_BYTES;
	}

	// Deal with large (float) values which run into the maximum integer size.
	return min( $bytes, PHP_INT_MAX );
}

/**
 * Determines whether a PHP ini value is changeable at runtime.
 *
 * @from WordPress
 * 
 * @since 0.3.1
 *
 * @staticvar array $ini_all
 *
 * @link https://secure.php.net/manual/en/function.ini-get-all.php
 *
 * @param string $setting The name of the ini setting to check.
 * @return bool True if the value is changeable at runtime. False otherwise.
 */
function oc_is_ini_value_changeable( $setting ) {
	static $ini_all;

	if ( ! isset( $ini_all ) ) {
		$ini_all = false;
		// Sometimes `ini_get_all()` is disabled via the `disable_functions` option for "security purposes".
		if ( function_exists( 'ini_get_all' ) ) {
			$ini_all = ini_get_all();
		}
	}

	// Bit operator to workaround https://bugs.php.net/bug.php?id=44936 which changes access level to 63 in PHP 5.2.6 - 5.2.17.
	if ( isset( $ini_all[ $setting ]['access'] ) && ( INI_ALL === ( $ini_all[ $setting ]['access'] & 7 ) || INI_USER === ( $ini_all[ $setting ]['access'] & 7 ) ) ) {
		return true;
	}

	// If we were unable to retrieve the details, fail gracefully to assume it's changeable.
	if ( ! is_array( $ini_all ) ) {
		return true;
	}

	return false;
}