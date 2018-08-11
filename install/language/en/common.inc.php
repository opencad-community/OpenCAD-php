<?php
//------------------------------------------------------------------------------ 
//*** English (en)
//------------------------------------------------------------------------------ 

$arrLang = array();

$arrLang['alert_admin_email_wrong'] = "Admin email has wrong format! Please re-enter.";
$arrLang['alert_min_version_db'] = "This program requires at least version _DB_VERSION_ of _DB_ installed (current version is _DB_CURR_VERSION_). You cannot proceed the installation.";
$arrLang['alert_min_version_php'] = "This program requires at least version _PHP_VERSION_ of PHP installed (current version is _PHP_CURR_VERSION_). You cannot proceed the installation.";
$arrLang['alert_directory_not_writable'] = "The directory <b>_FILE_DIRECTORY_</b> is not writable! <br />You must grant 'write' permissions (access rights 0755 or 777, depending on your system settings) to this directory defined in EI_CONFIG_FILE_DIRECTORY before you start the installation!";
$arrLang['alert_extension_not_installed'] = "Required extension pdo_".EI_DATABASE_TYPE." is not installed on your server! You cannot proceed installation.";
$arrLang['alert_unable_to_install'] = "Unable to install this application because an application with the same identity is already installed. <br>You may only <b>Update</b> or <b>Uninstall</b> it. Make sure you have a backup of your database before proceeding.";
$arrLang['alert_required_fields'] = "Items marked with an asterisk are required";
$arrLang['alert_db_host_empty'] = "Database host cannot be empty! Please re-enter.";
$arrLang['alert_db_name_empty'] = "Database name cannot be empty! Please re-enter.";
$arrLang['alert_db_username_empty'] = "Database username cannot be empty! Please re-enter.";
$arrLang['alert_db_password_empty'] = "Database password cannot be empty! Please re-enter.";
$arrLang['alert_admin_name_empty'] = "Admin username cannot be empty! Please re-enter.";
$arrLang['alert_admin_identifier_empty'] = "Identifier cannot be empty! Please re-enter.";
$arrLang['alert_admin_password_empty'] = "Admin password cannot be empty! Please re-enter.";
$arrLang['alert_wrong_testing_parameters'] = "Testing parameters are wrong! Please enter valid parameters.";
$arrLang['alert_remove_files'] = "For security reasons, please remove <b>start.php</b> file and <b>install/</b> folder from your server!";
$arrLang['alert_wrong_parameter_passed'] = "Wrong parameter passed! Please back to the previous step and try again.";

$arrLang['error_asp_tags'] = "This installation requires <b>ASP tags</b> settings turned ON.";
$arrLang['error_can_not_open_config_file'] = "Database was successfully created! Cannot open configuration file _CONFIG_FILE_PATH_ to save info.";
$arrLang['error_can_not_read_file'] = "Could not read file <b>_SQL_DUMP_FILE_</b>! Please check if a file exists.";
$arrLang['error_check_db_exists'] = "Database connection error! Please check if your database exists and access allowed for user <b>_DATABASE_USERNAME_</b>._ERROR_<br />";
$arrLang['error_check_db_connection'] = "Database connecting error! Please check your connection parameters._ERROR_<br />";
$arrLang['error_pdo_support'] = "This installation requires <b>PDO extension</b> installed.";
$arrLang['error_sql_executing'] = "SQL execution error! Please Turn debug mode On and check carefully a syntax of your SQL dump file.";
$arrLang['error_server_requirements'] = "This installation requires _SETTINGS_NAME_ settings turned on/installed.";
$arrLang['error_vd_support'] = "This installation requires Virtual Directory support turned ON.";

$arrLang['admin_access_data'] = "Admin Access Info";
$arrLang['admin_access_data_descr'] = "(you need this to enter the protected admin area)";
$arrLang['admin_email'] = "Admin Email";
$arrLang['admin_email_info'] = "Admin Email that be used to login with.";
$arrLang['admin_login'] = "Admin Name";
$arrLang['admin_login_info'] = "Your name that is on the account. Note: Can be changed later";
$arrLang['admin_identifier'] = "Idenfiier";
$arrLang['admin_identifier_info'] = "Your identifier. IE: 1D-01 Note:Depends on your community";
$arrLang['admin_password'] = "Admin Password";
$arrLang['admin_password_info'] = "We recommend that your password is not a word you can find in the dictionary, includes both capital and lower case letters, and contains at least one special character (1-9, !, *, _, etc.).";
$arrLang['administrator_account'] = "Administrator Account";
$arrLang['options_page'] = "System Settings";
$arrLang['administrator_account_skipping'] = "Skipping (Admin Account not required)";
$arrLang['asp_tags'] = "Asp Tags";
$arrLang['back'] = "Back";
$arrLang['build_date'] = "Build Date";
$arrLang['cancel_installation'] = "Cancel Installation";
$arrLang['click_start_button'] = "Click on Start button to continue";
$arrLang['click_to_start_installation'] = "Click to start installation";
$arrLang['checked'] = "Checked";
$arrLang['complete'] = "Complete";
$arrLang['complete_installation'] = "Complete Installation";
$arrLang['completed'] = "Completed";
$arrLang['continue'] = "Continue";
$arrLang['continue_installation'] = "Continue Installation";
$arrLang['database_extension'] = "Database Extension";
$arrLang['database_host'] = "Database Host";
$arrLang['database_host_info'] = "Hostname or IP-address of the database server. The database server can be in the form of a hostname (and/or port address), such as db1.myserver.com, or localhost:5432, or as an IP-address, such as 192.168.0.1";
$arrLang['database_import'] = "Database Import";
$arrLang['database_import_error'] = "Database Import (error)";
$arrLang['database_name'] = "Database Name";
$arrLang['database_name_info'] = "Database Name. The database used to hold the data. An example of database name is 'testdb'.";
$arrLang['database_username'] = "Database Username";
$arrLang['database_username_info'] = "Database username. The username used to connect to the database server. An example of username is 'test_123'.";
$arrLang['database_password'] = "Database Password";
$arrLang['database_password_info'] = "Database password. The password is used together with the username, which forms the database user account.";
$arrLang['database_prefix'] = "Database Prefix (optional)";
$arrLang['database_prefix_info'] = "Database prefix. Used to set the unique prefix for database tables and prevent one type of data from interfering with another. An example of database prefix is 'abc_'.";
$arrLang['database_settings'] = "Database Settings";
$arrLang['directories_and_files'] = "Directories and Files";
$arrLang['disabled'] = "disabled";
$arrLang['enabled'] = "enabled";
$arrLang['error'] = "Error";
$arrLang['extensions'] = "Extensions";
$arrLang['getting_system_info'] = "Getting System Info";
$arrLang['file_successfully_rewritten'] = "The _CONFIG_FILE_ file was successfully re-written and database updated.";
$arrLang['file_successfully_deleted'] = "The _CONFIG_FILE_ file was successfully deleted and database removed.";
$arrLang['file_successfully_created'] = "The _CONFIG_FILE_ file was successfully created.";
$arrLang['failed'] = "failed";
$arrLang['folder_paths'] = "Folder Paths";
$arrLang['follow_the_wizard'] = "Follow the <b>Wizard</b> to install your program";
$arrLang['installed'] = "installed";
$arrLang['installation_completed'] = "Installation Completed!";
$arrLang['installation_guide'] = "Installation Guide";
$arrLang['installation_type'] = "Installation Type";
$arrLang['language'] = "Language";
$arrLang['license'] = "License";
$arrLang['loading'] = "loading";
$arrLang['mbstring_support'] = "Multibyte String Support";
$arrLang['magic_quotes_gpc'] = "Magic Quotes for GPC (Get/Post/Cookie)";
$arrLang['magic_quotes_runtime'] = "Magic Quotes Runtime";
$arrLang['magic_quotes_sybase'] = "Magic Quotes are in Sybase-style";
$arrLang['mode'] = "Mode";
$arrLang['modes'] = "Modes";
$arrLang['new_installation_of'] = "New Installation of";
$arrLang['new'] = "New";
$arrLang['no'] = "No";
$arrLang['no_writable'] = "no writable";
$arrLang['not_installed'] = "not installed";
$arrLang['off'] = "Off";
$arrLang['ok'] = "OK";
$arrLang['on'] = "On";
$arrLang['passed'] = "passed";
$arrLang['password_encryption'] = "Password Encryption";
$arrLang['perform_manual_installation'] = "Perform a <b>Manual</b> Installation";
$arrLang['pdo_support'] = "PDO Support";
$arrLang['php_version'] = "PHP Version";
$arrLang['proceed_to_login_page'] = "Proceed to login page";
$arrLang['ready_to_install'] = "Ready to Install";
$arrLang['remove_configuration_button'] = "Remove Configuration and Start Over";
$arrLang['required_php_settings'] = "Required PHP Settings";
$arrLang['safe_mode'] = "Safe Mode";
$arrLang['select_installation_language'] = "Select Installation Language";
$arrLang['select_installation_type'] = "Select Installation Type";
$arrLang['sendmail_from'] = "Sendmail From";
$arrLang['sendmail_path'] = "Sendmail Path";
$arrLang['server_api'] = "Server API";
$arrLang['server_requirements'] = "Server Requirements";
$arrLang['session_support'] = "Session Support";
$arrLang['short_open_tag'] = "Short Open Tag";
$arrLang['smtp'] = "SMTP";
$arrLang['smtp_port'] = "SMTP Port";
$arrLang['start'] = "Start";
$arrLang['start_all_over'] = "Start All Over";
$arrLang['start_all_over_text'] = "If you want to remove this installation for some reason, you can force the Installer to remove current configuration and start all over again. <br><b>WARNING</b>: You have to undo the database installation manually to remove all changes that were done.";
$arrLang['step_1_of'] = "Step 1 of 7";
$arrLang['step_2_of'] = "Step 2 of 7";
$arrLang['step_3_of'] = "Step 3 of 7";
$arrLang['step_4_of'] = "Step 4 of 7";
$arrLang['step_5_of'] = "Step 5 of 7";
$arrLang['step_6_of'] = "Step 6 of 7";
$arrLang['step_7_of'] = "Step 7 of 7";
$arrLang['sub_title_message'] = "This wizard will guide you through the whole installation process";
$arrLang['system'] = "System";
$arrLang['system_architecture'] = "System Architecture";
$arrLang['test_connection'] = "Test Connection";
$arrLang['test_database_connection'] = "Test database connection";
$arrLang['unknown'] = "Unknown";
$arrLang['uninstall'] = "Uninstall";
$arrLang['uninstallation_completed'] = "Uninstallation Completed!";
$arrLang['update'] = "Update";
$arrLang['updating_completed'] = "Updating Completed!";
$arrLang['virtual_directory_support'] = "Virtual Directory Support";
$arrLang['we_are_ready_to_installation'] = "We are ready now to proceed with installation";
$arrLang['we_are_ready_to_installation_text'] = "At this step setup wizard will attempt to create all required database tables and populate them with data. <br>If something goes wrong, go back to the Database Settings step and make sure every information you've entered is correct.";
$arrLang['writable'] = "writable";


$arrLang['COMMUNITY_NAME'] = "Community Name";
$arrLang['COMMUNITY_NAME_notes'] = "Set your communities name";
$arrLang['COMMUNITY_NAME_alert'] = "COMMUNITY_NAME cannot be empty! Please re-enter.";

$arrLang['BASE_URL'] = "BASE_URL";
$arrLang['BASE_URL_notes'] = "The URL to your installation of OpenCAD inlcuding, if utilized, it's subdirectory
            Valid Examples include:
            example.com - Root domain, no subdirectory
            subdomain.example.com - subdomain, no subdirectory
            subdomain.example.com/subdir - subdomain with subdirectory
            example.com/subdir - root domain with subdirectory
            The OpenCAD teams does not reccomend including the trailing / on any of the above examples.
            It won't necessarily break anything but just makes reference look strange having two slashed when it isn't needed.";
$arrLang['BASE_URL_alert'] = "BASE_URL cannot be empty! Please re-enter.";


$arrLang['POLICE_NCIC'] = "Police NCIC";
$arrLang['POLICE_NCIC_notes'] = "Shows/Hides NCIC functionality on MDT console. If 'true' then LEO will be able to use NCIC functions without the need for a dispatcher, else if 'flase' then LEO will require the presence of dispatcher to use NCIC funcationality.";



$arrLang['FIRE_PANIC'] = "Fire Panic";
$arrLang['FIRE_PANIC_notes'] = "Shows/Hides Panic functionality on MDT console for Fire. If 'true' then Fire personnel will be able to use the Panic button, else if 'false' then Fire personnel will not be able to use the Panic button.";

$arrLang['FIRE_BOLO'] = "Fire BOLO";
$arrLang['FIRE_BOLO_notes'] = "Shows/Hides Panic functionality on MDT console for Fire. If 'true' then Fire personnel will be able to view the BOLO board, else if 'false' then Fire personnel will not be able to view the BOLO board";

$arrLang['FIRE_NCIC_NAME'] = "Fire NCIC Name";
$arrLang['FIRE_NCIC_NAME_notes'] = "Shows/Hides Panic functionality on MDT console for Fire. If 'true' then Fire personnel will be able to use the NCIC name name lookup, else if 'false' then Fire personnel will not be able to use NCIC name lookup";

$arrLang['FIRE_NCIC_PLATE'] = "Fire NCIC Plate";
$arrLang['FIRE_NCIC_PLATE_notes'] = "Shows/Hides Panic functionality on MDT console for Fire. If 'true' then Fire personnel will be able to use the NCIC plate lookup function, else if 'false' then Fire personnel will not be able to use the NICI plate lookup function.";



$arrLang['EMS_PANIC'] = "EMS Panic";
$arrLang['EMS_PANIC_notes'] = "Shows/Hides Panic functionality on MDT console for EMS. If 'true' then EMS personnel will be able to use the Panic button, else if 'false' then EMS personnel will not be able to use the Panic button. These settings will likely be moved to an *_options table in a future version.";

$arrLang['EMS_BOLO'] = "EMS BOLO";
$arrLang['EMS_BOLO_notes'] = "Shows/Hides Panic functionality on MDT console for EMS. If 'true' then EMS personnel will be able to view the BOLO board, else if 'false' then EMS personnel will not be able to view the BOLO board. These settings will likely be moved to an *_options table in a future version.";

$arrLang['EMS_NCIC_NAME'] = "EMS NCIC Name";
$arrLang['EMS_NCIC_NAME_notes'] = "Shows/Hides Panic functionality on MDT console for EMS. If 'true' then EMS personnel will be able to use the NCIC name lookup funcion, else if 'false' then EMS personnel will not be to use the NCIC name lookup function.";

$arrLang['EMS_NCIC_PLATE'] = "EMS NCIC Plate";
$arrLang['EMS_NCIC_PLATE_notes'] = "Shows/Hides Panic functionality on MDT console for EMS. If 'true' then EMS personnel will be able to use the Panic button, else if 'false' then EMS personnel will not be able to use the Panic button. These settings will likely be moved to an *_options table in a future version.";



$arrLang['ROADSIDE_PANIC'] = "Roadside Panic";
$arrLang['ROADSIDE_PANIC_notes'] = "Shows/Hides Panic functionality on MDT console for Roadside Assistance. If 'true' then RAO will be able to use the Panic button, else if 'false' then RAO will not be able to use the Panic button.";

$arrLang['ROADSIDE_BOLO'] = "Roadside BOLO";
$arrLang['ROADSIDE_BOLO_notes'] = "Shows/Hides BOLO functionality on MDT console for Roadside Assistance. If 'true' then RAO will be able to use the Panic button, else if 'false' then RAO will not be able to use the Panic button.";

$arrLang['ROADSIDE_NCIC_NAME'] = "Roadside NCIC Name";
$arrLang['ROADSIDE_NCIC_NAME_notes'] = "Shows/Hides NCIC functionality on MDT console for Roadside Assistance. If 'true' then RAO will be able to use NCIC plate query without the need for a dispatcher, else if 'false' then RAO will require the presence of dispatcher to use NCIC plate query funcationality.";

$arrLang['ROADSIDE_NCIC_PLATE'] = "Roadside NCIC Plate";
$arrLang['ROADSIDE_NCIC_PLATE_notes'] = "Shows/Hides NCIC functionality on MDT console for Roadside Assistance. If 'true' then RAO will be able to use NCIC plate query without the need for a dispatcher, else if 'false' then RAO will require the presence of dispatcher to use NCIC plate query funcationality.";



$arrLang['CIV_WARRANT'] = "Civ Warrant";
$arrLang['CIV_WARRANT_notes'] = "Allow/Disallow Civiliians from managing their warrants. If set to 'true' then Civs will be able to delete warrants from their profile, else if set to 'false' then Civs will not have the ability to remove warrants.";

$arrLang['CIV_REG'] = "Civ Registration";
$arrLang['CIV_REG_notes'] = "Allow/Disallow direct registration for Civillians. If set to 'true' then civillians will not require admin approval, esle if set to 'false' then Civillian registartion will require Admin approval. Allow/Disallow immediate regitration for civilians. If 'true' then civilian registartion will require Administrator approval else if 'false' then civilian registrations will NOT require Administrator approval.";



$arrLang['USE_GRAVATAR'] = "Gravatar";
$arrLang['USE_GRAVATAR_notes'] = "OpenCAD will dynamically retrieve your avatar from {@link Gravatar http://en.gravatar.com/} if you have an account. Otherwise it will use the default generic avatar image included with OpenCAD .";







?>