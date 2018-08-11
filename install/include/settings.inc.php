<?php

    // -------------------------------------------------------------------------
    // 1. GLOBAL SETTINGS
    // -------------------------------------------------------------------------
    // *** system mode (demo|debug|production)
    define('EI_MODE', 'debug');
    
    // *** version number of ApPHP EasyInstaller
    define('EI_VERSION', '3.2.4');

    // *** default language: en - English
    define('EI_DEFAULT_LANGUAGE', 'en');
    // *** default language direction: ltr - Left-To-Right (), rtl - Right-To-Left
    define('EI_DEFAULT_LANGUAGE_DIRECTION', 'ltr');

    // *** array of available languages
    //     to not show dropdown box with languages define it as empty
    //     $arr_active_languages = array()
    $arr_active_languages = array(
        'en'=>array('name'=>'English', 'direction'=>'ltr'),
    );
    
    // *** default template
    define('EI_TEMPLATE', 'x-white');


    // -------------------------------------------------------------------------
    // 2. GENERAL SETTINGS
    // -------------------------------------------------------------------------
    // *** check for PHP minimum version number (true, false) -
    //     checks if a minimum required version of PHP runs on a server
    define('EI_CHECK_PHP_MINIMUM_VERSION', true);
    define('EI_PHP_MINIMUM_VERSION', '7.0.0');
    
    // *** check or not config directory for writability
    define('EI_CHECK_CONFIG_DIR_WRITABILITY', false);

    // *** allows collecting info for magic quotes
    define('EI_CHECK_MAGIC_QUOTES', false);
    
    // *** allows collecting info for mbstring support
    define('EI_CHECK_MBSTRING_SUPPORT', false);

    // *** allows collecting info for email settings
    define('EI_CHECK_MAIL_SETTINGS', false);

    // *** allows collecting info for specified extensions
    define('EI_CHECK_EXTENSIONS', false);

    // *** allows collecting info for specified modes
    define('EI_CHECK_MODES', true);
    
    // *** allows collecting info for writability of specified directories and files
    define('EI_CHECK_DIRECTORIES_AND_FILES', true);
    
   
    
    // -------------------------------------------------------------------------
    // 3. DATABASE SETTINGS
    // -------------------------------------------------------------------------
    // *** force database creation
    define('EI_DATABASE_CREATE', false);

    // *** define database type
    // *** to check installed drivers use: print_r(PDO::getAvailableDrivers());
    //     mysql          - MySql,
    //     pgsql          - PostgreSQL
    //     sqlite/sqlite2 - SQLite 
    //     oci            - Oracle
    //     cubrid         - Cubrid
    //     firebird       - Firebird/Interbase 6
    //     dblib          - FreeTDS / MSSQL / Sybase
    //     sqlsrv         - Microsoft SQL Server 
    //     ibm            - IBM DB2
    //     informix       - IBM Informix Dynamic Server
    //     odbc           - ODBC v3 (IBM DB2, unixODBC and win32 ODBC)
    define('EI_DATABASE_TYPE', 'mysql');

    // *** check for database engine minimum version number (true, false) -
    //     checks if a minimum required version of database engine runs on a server
    define('EI_CHECK_DB_MINIMUM_VERSION', false);
    define('EI_DB_MINIMUM_VERSION', '4.0.0');    
        
    // *** admin username and password (true, false) - get admin username and password
    define('EI_USE_ADMIN_ACCOUNT', true);        
    // *** encrypt or not admin password true|false
    define('EI_USE_PASSWORD_ENCRYPTION', true);        
    // *** type of encryption - AES|MD5
    define('EI_PASSWORD_ENCRYPTION_TYPE', 'MD5');        
    // *** password encryption key for AES encryption
    define('EI_PASSWORD_ENCRYPTION_KEY', 'php_easy_installer');
    
    
    // -------------------------------------------------------------------------
    // 4. CONFIG PARAMETERS
    // -------------------------------------------------------------------------
    // *** config file directory - directory, where config file must be created
    //     for ex.: '../common/' or 'common/' - according to directory hierarchy and relatively to start.php file
    define('EI_CONFIG_FILE_DIRECTORY', '../');
    // *** config file name - output file with config parameters (database, username etc.)
    define('EI_CONFIG_FILE_NAME', 'oc-config.php');
    // *** according to directory hierarchy (you may add/remove '../' before EI_CONFIG_FILE_DIRECTORY)
    define('EI_CONFIG_FILE_PATH', EI_CONFIG_FILE_DIRECTORY.EI_CONFIG_FILE_NAME);

    // *** specifies whether to allow new installation
    define('EI_ALLOW_NEW_INSTALLATION', true);        
    // *** specifies whether to allow update
    define('EI_ALLOW_UPDATE', true);        
    // *** specifies whether to allow un-installation
    define('EI_ALLOW_UN_INSTALLATION', false); 
    define('DB_PREFIX', '');

    // *** allows start all over button
    define('EI_ALLOW_START_ALL_OVER', true);
    
    // *** sql dump file - file that includes SQL statements for instalation
    define('EI_SQL_DUMP_FILE_CREATE', 'sql_dump/create.sql');
    define('EI_SQL_DUMP_FILE_UPDATE', 'sql_dump/update.sql');
    define('EI_SQL_DUMP_FILE_UN_INSTALL', 'sql_dump/un-install.sql');

    // *** defines using of utf-8 encoding and collation for SQL dump file
    define('EI_USE_ENCODING', true);
    define('EI_DUMP_FILE_ENCODING', 'utf8');
    define('EI_DUMP_FILE_COLLATION', 'utf8_unicode_ci');               
    
    // *** allows manual installation
    define('EI_ALLOW_MANUAL_INSTALLATION', false);
    // *** manual installation text directoiry and text files
    define('EI_MANUAL_INSTALLATION_DIR', 'manual/');    
    $arr_manual_installations = array(
        'en'=>'manual.en.txt',
        'es'=>'manual.es.txt',
        'de'=>'manual.de.txt'
    );
    

    // -------------------------------------------------------------------------
    // 5. CONFIG TEMPLATE PARAMETERS
    // -------------------------------------------------------------------------
    // *** config file name - config template file name
    define('EI_CONFIG_FILE_TEMPLATE', 'config.tpl');
   
    
    // -------------------------------------------------------------------------
    // 6. APPLICATION PARAMETERS
    // -------------------------------------------------------------------------
    // *** application name
    define('EI_APPLICATION_NAME', 'OpenCAD');
    // *** version number of your application 
    define('EI_APPLICATION_VERSION', 'v0.2.3');
    
    // *** default start file name - application start file
    define('EI_APPLICATION_START_FILE', 'index.php');
    
    // *** license agreement page
    define('EI_LICENSE_AGREEMENT_PAGE', 'install/license/license.txt');    
   
    // *** additional text after successful installation
    define('EI_POST_INSTALLATION_TEXT', '');
    
?>