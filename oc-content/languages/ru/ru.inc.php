<?php
$arrLang = array();

$arrLang['alert_admin_email_wrong'] = "Admin email has wrong format! Please re-enter.";
$arrLang['alert_min_version_db'] = "This program requires at least version _DB_VERSION_ of _DB_ installed (current version is _DB_CURR_VERSION_). You cannot proceed the installation.";
$arrLang['alert_min_version_php'] = "This program requires at least version _PHP_VERSION_ of PHP installed (current version is _PHP_CURR_VERSION_). You cannot proceed the installation.";
$arrLang['alert_directory_not_writable'] = "The directory <b>_FILE_DIRECTORY_</b> is not writable! <br />You must grant 'write' permissions (access rights 0755 or 777, depending on your system settings) to this directory defined in EI_CONFIG_FILE_DIRECTORY before you start the installation!";
$arrLang['alert_extension_not_installed'] = "Required extension pdo_mysql is not installed on your server! You cannot proceed installation.";
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
$arrLang['alert_remove_files'] = "For security reasons, please remove the <b>oc-install/</b> folder from your server!";
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

$arrLang['admin_access_data'] = "Administrator Account Info";
$arrLang['admin_access_data_descr'] = "(you need this to enter the protected admin area)";
$arrLang['admin_email'] = "Email";
$arrLang['admin_email_info'] = "The administrator email which will be used to login to this accout.

More Administrator accounts can be provisioned later in the Administrator Console User Management";
$arrLang['admin_name'] = "Name";
$arrLang['admin_login_info'] = "Your name as per your communities policies and procedures. This can be adjusted later if needed.";
$arrLang['admin_identifier'] = "Identifier";
$arrLang['admin_identifier_info'] = "Your identifier. IE: 1D-01 Note. Depends on your community";
$arrLang['admin_password'] = "Password";
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
$arrLang['database_prefix'] = "Database Prefix";
$arrLang['database_prefix_info'] = "Database prefix. Used to set the unique prefix for database tables and prevent one type of data from interfering with another. An example of database prefix is 'abc_'.";
$arrLang['database_settings'] = "Database Settings";
$arrLang['directories_and_files'] = "Directories and Files";
$arrLang['disabled'] = "Disabled";
$arrLang['enabled'] = "Enabled";
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
$arrLang['installation_complete'] = "Installation Completed!";
$arrLang['installation_guide'] = "Installation Guide";
$arrLang['installation_type'] = "Installation Type";
$arrLang['language'] = "Language";
$arrLang['license'] = "License";
$arrLang['Import'] = "Import";
$arrLang['Export'] = "Export";
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
$arrLang['passed'] = "Passed";
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
$arrLang['API_KEY'] = "API Key";
$arrLang['MANAGE_API'] = "Manage API Keys";
$arrLang['COOKIE_ENCRYPTION_KEY'] = "Cookie Encryption Key";
$arrLang['server_requirements'] = "Server Requirements";
$arrLang['session_support'] = "Session Support";
$arrLang['short_open_tag'] = "Short Open Tag";
$arrLang['smtp'] = "SMTP";
$arrLang['smtp_port'] = "SMTP Port";
$arrLang['start'] = "Start";
$arrLang['start_all_over'] = "Start All Over";
$arrLang['start_all_over_text'] = "If you want to remove this installation for some reason, you can force the Installer to remove current configuration and start all over again. <br><b>WARNING</b>: You have to undo the database installation manually to remove all changes that were done.";
$arrLang['step_1_of'] = "Step 1 of 11";
$arrLang['step_2_of'] = "Step 2 of 11";
$arrLang['step_3_of'] = "Step 3 of 11";
$arrLang['step_4_of'] = "Step 4 of 11";
$arrLang['step_5_of'] = "Step 5 of 11";
$arrLang['step_6_of'] = "Step 6 of 11";
$arrLang['step_7_of'] = "Step 7 of 11";
$arrLang['step_8_of'] = "Step 8 of 11";
$arrLang['step_9_of'] = "Step 9 of 11";
$arrLang['step_10_of'] = "Step 10 of 11";
$arrLang['step_11_of'] = "Step 11 of 11";
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
$arrLang['we_are_ready_to_installation_text'] = "At this step setup wizard will attempt to create all required database tables and populate them with data. <br>If an error is encountered then return to the database settings page and make any corrections.";
$arrLang['we_are_ready_to_install_warning'] = "Please note, this page may be stuck on loading for up to 60 seconds (Depending on your systems speed). <br>Please do NOT refresh or close this window as you may cause SQL errors and have to completely start again with a clean database!";
$arrLang['writable'] = "Writable";

$arrLang['core_configuration'] = "Core Configuration";
$arrLang['department_configuration'] = 'Department Configuration';
$arrLang['civilian_configuration'] = 'Civilian Configuration'; 
$arrLang['administrative_configuration'] = 'Administrative Configuration';
$arrLang['extra_settings'] = 'Extra Settings';

//** Begin Core Configuration Strings **//
$arrLang['COMMUNITY_NAME'] = "Community Name";
$arrLang['COMMUNITY_NAME_notes'] = "Set your community's name";
$arrLang['COMMUNITY_NAME_alert'] = "Community Name cannot be empty! Please re-enter.";

$arrLang['COMMUNITY_HOMEPAGE'] = "Community Homepage";

$arrLang['BASE_URL'] = "Application URL";
$arrLang['BASE_URL_notes'] = "The URL to your installation of OpenCAD inlcuding, if utilized, it's subdirectory
            Valid Examples include:
            example.com - Root domain, no subdirectory
            subdomain.example.com - subdomain, no subdirectory
            subdomain.example.com/subdir - subdomain with subdirectory
            example.com/subdir - root domain with subdirectory
            The OpenCAD teams does not reccomend including the trailing / on any of the above examples.
            It won't necessarily break anything but just makes reference look strange having two slashed when it isn't needed.";
$arrLang['BASE_URL_alert'] = "BASE_URL cannot be empty! Please re-enter.";

$arrLang['CAD_FROM_EMAIL'] = 'CAD From Email';
$arrLang['CAD_FROM_EMAIL_notes'] = 'The email which notications from you CAD should appear to come from.

Example: cad@community.com
';

$arrLang['CAD_TO_EMAIL'] = 'CAD To Email';
$arrLang['CAD_TO_EMAIL_notes'] = 'The email which notications from you CAD should appear to come from.

Example: cad@community.com
';

$arrLang['API_SECURITY'] = 'API Security';

$arrLang['AUTH_KEY'] = 'Authentication Key';
$arrLang['AUTH_SALT'] = 'Authentication Salt';
$arrLang['SECURE_AUTH_KEY'] = 'Secure Authentication Key';
$arrLang['SECURE_AUTH_SALT'] = 'Secure Authentication Salt';
$arrLang['LOGGED_IN_KEY'] = 'Logged-In Key';
$arrLang['LOGGED_IN_SALT'] = 'Logged-In Salt';
$arrLang['NONCE_KEY'] = 'Nonce Key';
$arrLang['NONCE_SALT'] = 'Nonce Salt';
$arrLang['SESSION_KEY'] = 'Session Key';
$arrLang['COOKIE_NAME'] = 'Cookie Name';
//** End Core Configuration Strings **//

//** Begin Login Strings **//
$arrLang['LAW_ENFORCEMENT_OFFICER'] = "Law Enforcement Officer";
$arrLang['FIRST_RESPONDER'] = "First Responder";
$arrLang['CIVILIAN'] = "Civilian";
$arrLang['SIGN_IN_TO_YOUR_ACCOUNT'] = "Sign in to your account";
$arrLang['LOGIN'] = "Log In";
$arrLang['REQUEST_ACCESS'] = "Request Access";
//** End Login Strings **//


//** Begin Registration Modal Strings **//
$arrLang['FIRST_RESPONDER_ACCESS_REQUEST'] = "First Responder Access Request";
$arrLang['CIVILIAN_ACCESS_REQUEST'] = "Civilian Access Request";
$arrLang['DIVISION_SELECT_ALL'] = "Division (Select all that apply)";
$arrLang['IDENTIFIER_PLCAEHOLDER'] = "Identifier (Code Number, Unit ID)";
//** End Registration Modal Strings  **//


//** Begin Registration Modal Strings **//
$arrLang['CONFIRM_PASSWORD'] = "Confirm Password";
//** End Registration Modal Strings **//

//** Begin Dashboard Strings **//
$arrLang['CIVILIAN_SERVICES'] = "Civilian Services";
$arrLang['LAW_ENFORCEMENT_SERVICES'] = "Law Enforcement Services";
$arrLang['FIRST_RESPONDER_SERVICES'] = "First Responder Services";
$arrLang["CONFIGURE_LIVEMAP"] = "<strong>ADMINISTRATOR:</strong> <i>Configure LIVEMAP_URL variable in oc-config.php</i>";
//** End Dashboard Strings **//


//** Begin LEO Strings **//
$arrLang['POLICE_NCIC'] = "LEO NCIC Lookup";
$arrLang['POLICE_NCIC_notes'] = "Shows/Hides NCIC functionality on MDT console. If 'true' then LEO will be able to use NCIC functions without the need for a dispatcher, else if 'flase' then LEO will require the presence of dispatcher to use NCIC funcationality.";

$arrLang['POLICE_CALL_SELFASSIGN'] = "LEO Call Self Assign";
$arrLang['POLICE_CALL_SELFASSIGN_notes'] = "Allows/Disallows capability for LEO officers to attach them selves to call..";
//** End LEO Strings **//

//**  Begin Fire Strings **//
$arrLang['FIRE_PANIC'] = "Fire Panic";
$arrLang['FIRE_PANIC_notes'] = "If 'true' then Fire personnel will be able to use the Panic button, else if 'false' then Fire personnel will not be able to use the Panic button.";

$arrLang['FIRE_BOLO'] = "Fire BOLO";
$arrLang['FIRE_BOLO_notes'] = "If 'true' then Fire personnel will be able to view the BOLO board, else if 'false' then Fire personnel will not be able to view the BOLO board";

$arrLang['FIRE_NCIC_NAME'] = "Fire NCIC Name";
$arrLang['FIRE_NCIC_NAME_notes'] = "If 'true' then Fire personnel will be able to use the NCIC name lookup, else if 'false' then Fire personnel will not be able to use NCIC name lookup";

$arrLang['FIRE_NCIC_PLATE'] = "Fire NCIC Plate";
$arrLang['FIRE_NCIC_PLATE_notes'] = "If 'true' then Fire personnel will be able to use the NCIC plate lookup function, else if 'false' then Fire personnel will not be able to use the NICI plate lookup function.";

$arrLang['FIRE_CALL_SELFASSIGN'] = "Fire Call Self Assign";
$arrLang['FIRE_CALL_SELFASSIGN_notes'] = "Allows/Disallows capability for LEO officers to attach them selves to call..";
//**  End Fire Strings **//

//** Begin EMS Strings **//
$arrLang['EMS_PANIC'] = "EMS Panic";
$arrLang['EMS_PANIC_notes'] = "If 'true' then Fire personnel will be able to use the Panic button, else if 'false' then EMS personnel will not be able to use the Panic button.";

$arrLang['EMS_BOLO'] = "EMS BOLO";
$arrLang['EMS_BOLO_notes'] = "If 'true' then Fire personnel will be able to view the BOLO board, else if 'false' then EMS personnel will not be able to view the BOLO board";

$arrLang['EMS_NCIC_NAME'] = "EMS NCIC Name";
$arrLang['EMS_NCIC_NAME_notes'] = "If 'true' then Fire personnel will be able to use the NCIC name lookup, else if 'false' then EMS personnel will not be able to use NCIC name lookup";

$arrLang['EMS_NCIC_PLATE'] = "EMS NCIC Plate";
$arrLang['EMS_NCIC_PLATE_notes'] = "If 'true' then Fire personnel will be able to use the NCIC plate lookup function, else if 'false' then EMS personnel will not be able to use the NCIC plate lookup function.";
//** End EMS Strings **//

//** Begin Roadside Assistance Strings **//
$arrLang['ROADSIDE_PANIC'] = "Roadside Panic";
$arrLang['ROADSIDE_PANIC_notes'] = "If 'true' then RAO will be able to use the Panic button, else if 'false' then RAO will not be able to use the Panic button.";

$arrLang['ROADSIDE_BOLO'] = "Roadside BOLO";
$arrLang['ROADSIDE_BOLO_notes'] = "If 'true' then RAO will be able to use the BOLO button, else if 'false' then RAO will not be able to use the BOLO functionality.";

$arrLang['ROADSIDE_NCIC_NAME'] = "Roadside NCIC Name";
$arrLang['ROADSIDE_NCIC_NAME_notes'] = "If 'true' then RAO will be able to use NCIC name query without the need for a dispatcher, else if 'false' then RAO will require the presence of dispatcher to use NCIC name query funcationality.";

$arrLang['ROADSIDE_NCIC_PLATE'] = "Roadside NCIC Plate";
$arrLang['ROADSIDE_NCIC_PLATE_notes'] = "If 'true' then RAO will be able to use NCIC plate query without the need for a dispatcher, else if 'false' then RAO will require the presence of dispatcher to use NCIC plate query funcationality.";

$arrLang['ROADSIDE_CALL_SELFASSIGN'] = "Roadside Call Self Assign";
$arrLang['ROADSIDE_CALL_SELFASSIGN_notes'] = "If 'true' then RAO will be able to self assign to call without the need for a dispatcher, else if 'false' then RAO will require the presence of dispatcher to be assigned to a call.";
//** End Roadside Assistance Strings **//

//** Begin Civilian Strings **//
$arrLang['CIV_WARRANT'] = "Civilian Warrant Creation";
$arrLang['CIV_WARRANT_notes'] = "If set to 'true' then Civs will be able to delete warrants from their profile, else if set to 'false' then Civs will not have the ability to remove warrants.";

$arrLang['CIV_REG'] = "Instant Civilian Registration";
$arrLang['CIV_REG_notes'] = "If set to 'true' then civillians will not require admin approval, esle if set to 'false' then Civillian registartion will require Admin approval. Allow/Disallow immediate regitration for civilians. If 'true' then civilian registartion will require Administrator approval else if 'false' then civilian registrations will NOT require Administrator approval.";

$arrLang['CIV_LIMIT_MAX_IDENTITIES'] = "Civilian Maximum Identities";
$arrLang['CIV_LIMIT_MAX_IDENTITIES_notes'] = "If CIV_LIMIT_MAX is '0' then civilians will be able to create unlimited identites. Otherwise, if CIV_LIMIT_MAX is a value other than '0' then it will cap the maximum number of possible identites to that value.";

$arrLang['CIV_LIMIT_MAX_VEHICLES'] = "Civilian Maximum Vehicles";
$arrLang['CIV_LIMIT_MAX_VEHICLES_notes'] = "If CIV_LIMIT_MAX_VEHICLES is '0' then civilian will be able to create unlimited vehicles. Otherwise, if CIV_LIMIT_MAX_VEHICLES is a value other than '0' then it will cap the maximum number of possible vehicles to that value";

$arrLang['CIV_LIMIT_MAX_WEAPONS'] = "Civilian Maximum Weapons";
$arrLang['CIV_LIMIT_MAX_WEAPONS_notes'] = "If CIV_LIMIT_MAX_WEAPONS is '0' then civilian will be able to create unlimited weapons. Otherwise, if CIV_LIMIT_MAX_WEAPONS is a value other than '0' then it will cap the maximum number of possible weapons to that value";
//** End Civilian Strings **//

//** Begin Administrative Strings**//
$arrLang['MODERATOR_USER_MANAGER'] = "Moderator Approve User";
$arrLang['MODERATOR_USER_MANAGER_notes'] = "If 'true' then Moderators will be able to approve new user requests, else, if 'false' then Moderators will not be able to approve new user requests.";

$arrLang['MODERATOR_APPROVE_USER'] = "Moderator Approve User";
$arrLang['MODERATOR_APPROVE_USER_notes'] = "If 'true' then Moderators will be able to approve new user requests, else, if 'false' then Moderators will not be able to approve new user requests.";

$arrLang['MODERATOR_EDIT_USER'] = "Moderator Edit User";
$arrLang['MODERATOR_EDIT_USER_notes'] = "If 'true' then Moderators will be able to edit users profile, if 'false' then Moderators will not be able to edit users profile. This includes name, email, identifier, and roles. Moderators will be able to add user groups but the removal of them is governed by the MODERATOR_REMOVE_GROUPS setting.";

$arrLang['MODERATOR_DELETE_USER'] = "Moderator Delete User";
$arrLang['MODERATOR_DELETE_USER_notes'] = "If 'true' then Moderators will be able to delete users, else if 'false' Moderators will not be able to delete users.";

$arrLang['MODERATOR_EDIT_VEHICLES'] = "Moderator Edit Vehicle";
$arrLang['MODERATOR_EDIT_VEHICLES_notes'] = "If 'true' then Moderators will be able to edit vehicles, if 'false' then this option will be disabled.";

$arrLang['MODERATOR_DELETE_VEHICLES'] = "Moderator Delete Vehicle";
$arrLang['MODERATOR_DELETE_VEHICLES_notes'] = "If 'true' then Moderators will be able to delete vehicles, if 'false' then this option will be disabled.";

$arrLang['MODERATOR_EDIT_WARNINGTYPE'] = "Moderator Edit Warning Types";
$arrLang['MODERATOR_EDIT_WARNINGTYPE_notes'] = "If 'true' then Moderators will be able to edit Warning Types, if 'false' then this option will be disabled.";

$arrLang['MODERATOR_DELETE_WARNINGTYPE'] = "Moderator Delete Warning Types";
$arrLang['MODERATOR_DELETE_WARNINGTYPE_notes'] = "If 'true' then Moderators will be able to delete Warning Types, if 'false' then this option will be disabled.";

$arrLang['MODERATOR_EDIT_INCIDENTTYPES'] = "Moderator Edit Incident Types";
$arrLang['MODERATOR_EDIT_INCIDENTTYPES_notes'] = "If 'true' then Moderators will be able to edit incident types, if 'false' then this option will be disabled.";

$arrLang['MODERATOR_DELETE_INCIDENTTYPES'] = "Moderator Delete Incident Types";
$arrLang['MODERATOR_DELETE_INCIDENTTYPES_notes'] = "If 'true' then Moderators will be able to delete incident types, if 'false' then this option will be disabled.";

$arrLang['MODERATOR_EDIT_STREETS'] = "Moderator Edit Streets";
$arrLang['MODERATOR_EDIT_STREETS_notes'] = "If 'true' then Moderators will be able to edit streets, if 'false' then this option will be disabled.";

$arrLang['MODERATOR_DELETE_STREETS'] = "Moderator Delete Streets";
$arrLang['MODERATOR_DELETE_STREETS_notes'] = "If 'true' then Moderators will be able to delete streets, if 'false' then this option will be disabled.";

$arrLang['MODERATOR_EDIT_WARRANTTYPES'] = "Moderator Edit Warrant Types";
$arrLang['MODERATOR_EDIT_WARRANTTYPES_notes'] = "If 'true' then Moderators will be able to edit warrant types, if 'false' then this option will be disabled.";

$arrLang['MODERATOR_DELETE_WARRANTTYPES'] = "Moderator Delete Warrant Types";
$arrLang['MODERATOR_DELETE_WARRANTTYPES_notes'] = "If 'true' then Moderators will be able to delete warrant types, if 'false' then this option will be disabled.";

$arrLang['MODERATOR_EDIT_WEAPONS'] = "Moderator Edit Weapons";
$arrLang['MODERATOR_EDIT_WEAPONS_notes'] = "If 'true' then Moderators will be able to edit weapons, if 'false' then this option will be disabled.";

$arrLang['MODERATOR_DELETE_WEAPONS'] = "Moderator Delete Weapons";
$arrLang['MODERATOR_DELETE_WEAPONS_notes'] = "If 'true' then Moderators will be able to delete weapons, if 'false' then this option will be disabled.";

$arrLang['MODERATOR_SUSPEND_WITHOUT_REASON'] = "Moderator Suspend without Reason";
$arrLang['MODERATOR_SUSPEND_WITHOUT_REASON_notes'] = "If 'true' then Moderators will be able suspend users without a reason, else if 'false' Moderators will not be able suspend users without a reason.";

$arrLang['MODERATOR_SUSPEND_WITH_REASON'] = "Moderator Suspend with Reason";
$arrLang['MODERATOR_SUSPEND_WITH_REASON_notes'] = "If 'true' then Moderators will be able suspend users with a reason, if 'false' Moderators will not be able suspend users with a reason.";

$arrLang['MODERATOR_REACTIVATE_USER'] = "Moderator Reactivate User";
$arrLang['MODERATOR_REACTIVATE_USER_notes'] = "If 'true' then Moderators will be able to ractvate users else, if 'false' Moderators will not be able to reactivate users.";

$arrLang['MODERATOR_REMOVE_GROUP'] = "Moderator Remove Group";
$arrLang['MODERATOR_REMOVE_GROUP_notes'] = "If 'true' then Moderators will be able to remove user's groups, else if 'false' Moderators will not be able to remove user's groups.";

$arrLang['MODERATOR_NCIC_EDITOR'] = "Moderator NCIC Editor";
$arrLang['MODERATOR_NCIC_EDITOR_notes'] = "If 'true' then Moderators will be able to access the NCIC editor, else if 'false' Moderators will not be able to access the NCIC editor.";

$arrLang['MODERATOR_DATA_MANAGER'] = "Moderator Game Data Manager";
$arrLang['MODERATOR_DATA_MANAGER_notes'] = "If 'true' then Moderators will be able to access the Game Data Manager, else if 'false' then Moderators will not be able to access the Game Data Manager.";

$arrLang['MODERATOR_DATAMAN_CITATIONTYPES'] = "Moderator Citation Types Editor";
$arrLang['MODERATOR_DATAMAN_CITATIONTYPES_notes'] = "If 'true' then Moderators will have access to the Citation Types Manager module of the Game Data Manager, else if 'false' then Moderators will be denied access.";

$arrLang['MODERATOR_DATAMAN_DEPARTMENTS'] = "Moderator Departments Editor";
$arrLang['MODERATOR_DATAMAN_DEPARTMENTS_notes'] = "If 'true' then Moderators will have access to the Departments Manager module of the Game Data Manager, else if 'false' then Moderators will be denied access.";

$arrLang['MODERATOR_DATAMAN_INCIDENTTYPES'] = "Moderator Incident Types Editor";
$arrLang['MODERATOR_DATAMAN_INCIDENTTYPES_notes'] = "If 'true' then Moderators will have access to the Incident Types Manager module of the Game Data Manager, else if 'false' then Moderators will be denied access.";

$arrLang['MODERATOR_DATAMAN_RADIOCODES'] = "Moderator Radio Codes Editor";
$arrLang['MODERATOR_DATAMAN_RADIOCODES_notes'] = "If 'true' then Moderators will have access to the Radio Codes Manager module of the Game Data Manager, else if 'false' then Moderators will be denied access.";

$arrLang['MODERATOR_DATAMAN_STREETS'] = "Moderator Streets Editor";
$arrLang['MODERATOR_DATAMAN_STREETS_notes'] = "If 'true' then Moderators will have access to the Streets Manager module of the Game Data Manager, else if 'false' then Moderators will be denied access.";

$arrLang['MODERATOR_DATAMAN_VEHICLES'] = "Moderator Vehicles Editor";
$arrLang['MODERATOR_DATAMAN_VEHICLES_notes'] = "If 'true' then Moderators will have access to the Vehicles Manager module of the Game Data Manager, else if 'false' then Moderators will be denied access.";

$arrLang['MODERATOR_DATAMAN_WARNINGTYPES'] = "Moderator Warning Types Editor";
$arrLang['MODERATOR_DATAMAN_WARNINGTYPES_notes'] = "If 'true' then Moderators will have access to the Warning Types Manager module of the Game Data Manager, else if 'false' then Moderators will be denied access.";

$arrLang['MODERATOR_DATAMAN_WARRANTTYPES'] = "Moderator Warrant Types Editor";
$arrLang['MODERATOR_DATAMAN_WARRANTTYPES_notes'] = "If 'true' then Moderators will have access to the Warrant Types Manager module of the Game Data Manager, else if 'false' then Moderators will be denied access.";

$arrLang['MODERATOR_DATAMAN_WEAPONS'] = "Moderator Weapons Editor";
$arrLang['MODERATOR_DATAMAN_WEAPONS_notes'] = "If 'true' then Moderators will have access to the Weapons Manager module of the Game Data Manager, else if 'false' then Moderators will be denied access.";

$arrLang['MODERATOR_DATAMAN_IMPEXPRESET'] = "Moderator Import/Export/Reset";
$arrLang['MODERATOR_DATAMAN_IMPEXPRESET_notes'] = "If 'true' then Moderators will have access to the Import/Export/Reset module of the Game Data Manager, else if 'false' then Moderators will be denied access.";
//** End Administrative Strings**//

//** Begin Extra Settings Strings **//
$arrLang['LIVEMAP_URL'] = "Livemap URL";

$arrLang['WEBHOOK_URL'] = "Webhook URL";

$arrLang['DEMO_MODE'] = "Demo Mode";
$arrLang['DEMO_MODE_notes'] = "'true' then various user management features of OpenCAD will be locked down, else if 'false' then OpenCAD's full functionality* will be available to use.";

$arrLang['GENERATE_GTAV_DATA'] = "Generate GTAV Game Data";
$arrLang['GENERATE_GTAV_DATA_notes'] = "Generates GTAV Data and inserts it into the database. This will allow quicker configuration of your cad if you are using GTAV. Disable for a blank canvas to use with other games";

$arrLang['USE_GRAVATAR'] = "Gravatar";
$arrLang['USE_GRAVATAR_notes'] = "OpenCAD will dynamically retrieve your avatar from {@link Gravatar http://en.gravatar.com/} if you have an account. Otherwise it will use the default generic avatar image included with OpenCAD .";
//** End Extra Settings Strings **//

//** Begin Common Global Strings **/
$arrLang['WELCOME'] = "Welcome";
$arrLang["GENERAL"] = "General";
$arrLang["CAD_SYSTEM"] = "CAD System";
$arrLang["EDIT"] = "Edit";
$arrLang["DELETE"] = "Delete";
$arrLang["NAME"] = "Name";
$arrLang["EMAIL"] = "E-Mail";
$arrLang["ROLE"] = "Role";
$arrLang["IDENTIFIER"] = "Identifier";
$arrLang["GROUPS"] = "Groups";
$arrLang["ACTIONS"] = "Actions";
$arrLang["NEXT"] = "Next";
$arrLang["PREVIOUS"] = "Previous";
$arrLang["SEARCH"] =  "Search";
$arrLang["DASHBOARD"] =  "Dashboard";
$arrLang["LOGOUT"] =  "Logout";
$arrLang["NEED_HELP"] =  "Need Help?";
$arrLang["FULLSCREEN"] =  "Fullscreen";
$arrLang["DOB"] = "DOB";
$arrLang["ADDRESS"] = "Address";
$arrLang["GENDER"] = "Gender";
$arrLang["RACE"] = "Race";
$arrLang["DL_STATUS"] = "DL Status";
$arrLang["HAIR_COLOR"] = "Hair Color";
$arrLang["BUILD"] = "Build";
$arrLang["WEAPON_STATUS"] = "Weapon Status";
$arrLang["WEAPON_NAME"] = "Weapon Name";
$arrLang["WEAPON_TYPE"] ="Weapon Type";
$arrLang["WEAPON_NOTES"] ="Weapon Notes";
$arrLang["DECEASED"] = "Deceased";
$arrLang["REG_PLATE"] = "Reg. Plate";
$arrLang["VEHICLE_NOTES"] = "Vehicle Notes";
$arrLang["NOT_YOU"] = "Not You?";
$arrLang["ACTIVE_CALLS"] = "Active Calls";
$arrLang["ACTIVE_BOLOS"] = "Active BOLOs";
$arrLang["NCIC_NAME_LOOKUP"] = "NCIC Name Lookup";
$arrLang["NCIC_PLATE_LOOKUP"] = "NCIC Plate Lookup";
$arrLang["NCIC_WEAPON_LOOKUP"] = "NCIC Weapon Lookup";
$arrLang["SEND"] = "Send";
$arrLang["MY_PROFILE"] = "My Profile";
$arrLang["APPLICATIONS"] = "Applications";
$arrLang["SETTINGS"] = "Settings";
$arrLang["REQUEST"] = "Request";
$arrLang["CLOSE"] = "Close";
$arrLang["RESET"] = "Reset";
//** End Common Global Strings */

//** Begin Administrator/Moderator Console Strings  **/
$arrLang["CAD_ADMINISTRATION"] = "CAD Administration";
$arrLang["STATISTICS_AT_A_GLANCE"] = "Statistics at a glance";
$arrLang["TOTAL_USERS"] = "Total Users";
$arrLang["ACEESS_REQUESTS"] = "Access Requests";
$arrLang["THERE_ARE_CURRENTLY_NO_ACCESS_REQUESTS"] = "There are currently no access requests.";
$arrLang["CAD_USER_MANAGEMENT"] = "CAD User Management";
$arrLang["ACCOUNT_MANAGEMENT"] = "Account Management";
$arrLang["SUSPEND_WITH_REASON"] = "Suspend With Reason";
$arrLang["SUSPEND_WITHOUT_REASON"] = "Suspend Without Reason";
$arrLang["NCIC_NAMES_DB"] = "NCIC Names Database"; 
$arrLang["NCIC_NAMES_DB_notes"] = "No results found in the NCIC Names database.";
$arrLang["NCIC_VEHICLES_DB"] = "NCIC Vehicles Database";
$arrLang["NCIC_VEHICLES_DB_notes"] = "No results found in the NCIC Vehicles database.";
$arrLang["NCIC_WEAPONS_DB"] = "NCIC Weapons Database";
$arrLang["NCIC_WEAPONS_DB_notes"] = "No results found in the NCIC Weapons database.";
$arrLang["NCIC_WARNINGS_DB"] = "NCIC Warnings Database";
$arrLang["NCIC_WARNINGS_DB_notes"] = "No results found in the NCIC Weapons database.";
$arrLang["NCIC_CITATIONS_DB"] = "NCIC Citations Database.";
$arrLang["NCIC_CITATIONS_DB_notes"] = "No results found in the NCIC Citations database.";
$arrLang["ncicArrests_DB"] = "NCIC Arrests Database";
$arrLang["ncicArrests_DB_notes"] = "No results found in the NCIC Arrests database.";
$arrLang["ncicwarrants_DB"] = "NCIC Warrants Database";
$arrLang["ncicwarrants_DB_notes"] = "No results found in the NCIC Warrants database";
$arrLang["USER_MANAGER"] = "Users";
$arrLang["NCIC_EDITOR"] = "NCIC Editor";
$arrLang["DATA_MANAGER"] = "Data Manager";
$arrLang["ABOUT_ENVIRONMENT"] = "About Your Environment";
$arrLang["PHP_VERSION"] = "PHP Version";
$arrLang["PHP_VERSION_notes"] = "<em>Note:</em> The active version of PHP.</p>";
$arrLang["DATABASE_ENGINE"] = "Database Engine";
$arrLang["DATABASE_ENGINE_notes"] = "<em>Note:</em> The active database engine.";
$arrLang["LOADED_PHP_MODULES"] = "Loaded PHP Modules";
$arrLang["LOADED_PHP_MODULES_notes"] = "<em>Note:</em> Active PHP modules.";
$arrLang["ABOUT_YOUR_APPLICATION"] = "About Your Application";
$arrLang["APPLICATION_VERSION"] = "Application Version";
$arrLang["APPLICATION_VERSION_notes"] = "<em>Note:</em> The currently installed version of OpenCAD.</p>";
$arrLang["LATEST_VERSION"] = "Latest Version";
$arrLang["LATEST_VERSION_notes"] ="<em>Note:</em> This is the latest released version available.</p>";
$arrLang["DATABASE_SCHEMA_VERSION"] = "Database Schema Version";
$arrLang["DATABASE_SCHEMA_VERSION_notes"] = "<em>Note:</em> The currently installed OpenCAD database schema version.</p>";

$arrLang["DEPARTMENT_MANAGER"] = "Department Manager";
$arrLang["DEPARTMENT_MANAGER_notes"] = "No results found in the <em>Department</em> datbase";
$arrLang["INCIDENTTYPE_MANAGER"] = "Incident Type Manager";
$arrLang["INCIDENTTYPE_MANAGER_notes"] = "No results found in the <em>Incident Type</em> datbase";
$arrLang["CITATIONTYPE_MANAGER"] = "Citation Type Manager";
$arrLang["CITATIONTYPE_MANAGER_notes"] = "No results found in the <em>Citation Type</em> datbase";
$arrLang["RADIOCODE_MANAGER"] = "Radio Code Manager";
$arrLang["RADIOCODE_MANAGER_notes"] = "No results found in the <em>Radio Code</em> datbase";
$arrLang["STREET_MANAGER"] = "Street Manager";
$arrLang["STREET_MANAGER_notes"] = "No results found in the <em>Street</em> datbase";
$arrLang["VEHICLE_MANAGER"] = "Vehicle Manager";
$arrLang["VEHICLE_MANAGER_notes"] = "No results found in the <em>Vehicle</em> datbase";
$arrLang["WARNINGTYPE_MANAGER"] = "Warning Type Manager";
$arrLang["WARNINGTYPE_MANAGER_notes"] = "No results found in the <em>Warning Type</em> datbase";
$arrLang["WARRANTTYPE_MANAGER"] = "Warrant Type Manager";
$arrLang["WARRANTTYPE_MANAGER_notes"] = "No results found in the <em>Warrant Type</em> datbase";
$arrLang["WEAPON_MANAGER"] = "Weapon Manager";
$arrLang["WEAPON_MANAGER_notes"] = "No results found in the <em>weapons</em> datbase";
$arrLang["ABOUT_OPENCAD"] = "About OpenCAD";
$arrLang["ISSUE_TAB"] = "Report Issue";
$arrLang["SUPPORT_TITLE"] = "Support";
$arrLang["RESET_DATA"] = "Reset Data";
$arrLang["ENVIRONMENTAL_DATA_OPTGRP"] = "Environmental Data";
$arrLang["STREETS"] = "Streets";
$arrLang["VEHICLES"] = "Vehicles";
$arrLang["WEAPONS"] = "Weapons";
$arrLang["CIVILIAN_DATA_OPTGRP"] = "Civilian Data";
$arrLang["IDENTITIES"] = "Identites";
$arrLang["REGISTERED_PLATES"] = "Registered Plates";
$arrLang["REGISTERED_WEAPONS"] = "Registered Weapons";
$arrLang["WARRANT_HISTORY"] = "Warrant History";
$arrLang["WARNING_HISTORY"] = "Warning History";
$arrLang["LEO_SUPPORT_DATA_OPTGRP"] = "LEO Support Data";
$arrLang["CITATION_TYPES"] = "Citation Types";
$arrLang["INCIDENT_TYPES"] = "Incident Types";
$arrLang["RADIO_CODES"] = "Radio Codes";
$arrLang["WARRANT_TYPES"] = "Warrant Types";
$arrLang["WARNING_TYPES"] = "Warning Types";
$arrLang["RESET_ALL_DATA_OPTGRP"] = "RESET ALL DATA (USE WITH CUATION)";
$arrLang["RESET_ALL_DATA"] = "All Data (Use with CAUTION)";
//** End Administrator/Moderator Console Strings  **/

//** Begin Issue Strings **/
$arrLang["ISSUE_TITLE"] = "Report An Issue";
$arrLang["ISSUE_TITLE_BUG"] = "Enter Title *";
$arrLang["ISSUE_DESCRIBE_BUG"] = "Description You are Facing *";
$arrLang["ISSUE_REPRODUCE_BUG"] = "Steps to Reproduce *";
$arrLang["ISSUE_EXPECTED_BEHAVIOUR_BUG"] = "Expected behavior";
$arrLang["ISSUE_SCREENSHOTS_BUG"] = "Screenshots";
$arrLang["ISSUE_DESKTOP_BUG"] = "Desktop Information";
$arrLang["ISSUE_SMARTPHONE_BUG"] = "Smartphone Information (If affecting mobile too)";
$arrLang["ISSUE_SERVER_BUG"] = "Server Information";
$arrLang["ISSUE_ADDITIONAL_INFO_BUG"] = "Additional Useful Information";
$arrLang["ISSUE_TITLE_BUG_notes"] = "Enter a title for your issue";
$arrLang["ISSUE_DESCRIBE_BUG_notes"] = "A clear and concise description of what the bug is.";
$arrLang["ISSUE_REPRODUCE_BUG_notes"] = "Steps to reproduce the behavior";
$arrLang["ISSUE_EXPECTED_BEHAVIOUR_BUG_notes"] = "A clear and concise description of what you expected to happen.";
$arrLang["ISSUE_SCREENSHOTS_BUG_notes"] = " If applicable, add screenshots to help explain your problem. These need to be links, seperated by a comma ','";
$arrLang["ISSUE_DESKTOP_BUG_notes"] = "OS: [e.g. iOS], Browser [e.g. chrome, safari], Version [e.g. 22]";
$arrLang["ISSUE_SMARTPHONE_BUG_notes"] = "Device: [e.g. iPhone6], OS: [e.g. iOS8.1], Browser [e.g. stock browser, safari], Version [e.g. 22]";
$arrLang["ISSUE_SERVER_BUG_notes"] = "OS: [e.g, Debian Linux], Version [e.g. 11], Control Panel [e.g. CPanel 106]";
$arrLang["ISSUE_ADDITIONAL_INFO_BUG_notes"] = "Any additional information that will be useful to help resolve this issue.";
$arrLang["ISSUE_ERROR_GH_KEY_NOT_VALID"] = "Your Github Key is either not set or is invalid!";
$arrLang["ISSUE_ERROR_GH_KEY_INCORRECT"] = "Your Github Key Incorrect! Please check and try again";
$arrLang["ISSUE_ERROR_GH_KEY_EXISTS"] = "There is already a key in the Database. Please remove this before trying again!";
$arrLang["ISSUE_SUCCESS_GH_KEY_CREATE"] = "Your Github Key Has been Inserted!";
$arrLang["ISSUE_SUCCESS_GH_ISSUE_CREATED"] = "Sucessfully Created Issue!";
$arrLang["ISSUE_GH_CREATE_TITLE"] = "Create Your GitHub Key";
$arrLang["ISSUE_GH_CREATE_KEY"] = "Enter Key";
$arrLang["ISSUE_GH_CREATE_KEY_notes"] = "Enter your GitHub Personal Access Key";
$arrLang["ISSUE_GH_CREATE_DESCRIPTION"] = "To gain your access key, follow the below instructions<br><br>◉ Head over to this link: https://github.com/settings/tokens <br>◉ Sign in with your main account<br>◉ Create your new Personal Access token<br>◉ Be sure to set the Expiration to never<br>◉ Be sure to select 'repo' as the minimum scope!<br><br>Please note, your GitHub key is encrypted using your secret keys within oc-config.php.<br>Be sure not to share this file with anyone as your keys can be decrpyted!";

//** End Issue Strings **/

//** Plugin Strings **/

$arrLang["PLUGIN_TAB"] = "Plugin Manager";

//** End Plugin Strings **/


//** Begin Webhook Strings **/

$arrLang["WEBHOOK_TAB"] = "Webhook Manager";
$arrLang["WEBHOOK_LIST_TITLE"] = "Active Webhooks";
$arrLang["WEBHOOK_CREATE_TITLE"] = "Create a new webhook";
$arrLang["WEBHOOK_JSON"] = "Enter Your Custom Webhook Data";
$arrLang["WEBHOOK_JSON_NOTES"] = "Note: Please ensure this is in 'JSON' format!";
$arrLang["WEBHOOK_NEW_TITLE"] = "Create Webhook Title";
$arrLang["WEBHOOK_NEW_TITLE_PLACEHOLDER"] = "My New Webhook";
$arrLang["WEBHOOK_NEW_URI"] = "Enter Webook URL";
$arrLang["WEBHOOK_NEW_URI_PLACEHOLDER"] = "https://discordapp.com/api/webhooks/xxxxxxxxx";
$arrLang["WEBHOOK_NEW_TYPE"] = "Select Type Of Webhook";
$arrLang["WEBHOOK_NEW_RADIO_NOTIFICATION"] = "Notification - Sends Notification To Your Webhook Based On Certain Events";
$arrLang["WEBHOOK_ERROR_INCORRECTJSON"] = "Incorrect JSON Format! Please correct this before submitting again!";
$arrLang["WEBHOOK_ERROR_EMPTYSTRING"] = "Be sure to fill all fields before submitting!";
$arrLang["WEBHOOK_ERROR_INVALIDURI"] = "Webhook URL seems to be invalid, if this isn't the case, please contact support!";
$arrLang["WEBHOOK_ERROR_EMPTYOPTION"] = "Be sure to select an activation parameter!";
$arrLang["WEBHOOK_SUCCESS_SUBMITTED"] = "Succesfully Created Webhook!";
$arrLang["WEBHOOK_SUCCESS_DELETED"] = "Succesfully Deleted Webhook!";
$arrLang["WEBHOOK_SUCCESS_UPDATED"] = "Succesfully Updated Webhook!";

$arrLang["WEBHOOK_NEW_SETTING"] = "Select Activation Parameters";
$arrLang["WEBHOOK_SETTINGS_CIVREGISTERED"] = "On Civ Register";
$arrLang["WEBHOOK_SETTINGS_USERREQUESTED"] = "On User Requested";
$arrLang["WEBHOOK_SETTINGS_USERDELETE"] = "On User Deletetion";
$arrLang["WEBHOOK_SETTINGS_USERSUSPENSION"] = "On User Suspension";
$arrLang["WEBHOOK_SETTINGS_USERREGISTRATION"] = "On User Registration";
$arrLang["WEBHOOK_SETTINGS_PANICBUTTONPRESSED"] = "On Panic Button Pressed";
$arrLang["WEBHOOK_SETTINGS_ISSUEREPORT"] = "On Issue Create";


//** End Webhook Strings **/

//** Begin Webhook Strings **/

$arrLang["API_TAB"] = "API Manager";
$arrLang["API_LIST_TITLE"] = "Active APIs";
$arrLang["API_CREATE_TITLE"] = "API Manager";
$arrLang["API_NEW_TITLE"] = "Create API Title";
$arrLang["API_NEW_TITLE_PLACEHOLDER"] = "My New API";
$arrLang["API_NEW_KEY"] = "API Key";
$arrLang["API_NEW_KEY_PLACEHOLDER"] = "Key";

//** Error Messages */
$arrLang["API_ERROR_PERMISSIONREQUIRED"] = "You are required to set permissions!";
$arrLang["API_ERROR_TITLEREQUIRED"] = "A Title Required!";
$arrLang["API_ERROR_METHODREQUIRED"] = "At least one Method is required!";
$arrLang["API_ERROR_PERMISSIONREQUIRED"] = "At least one permission is requried!";

//** END Error Messages */
//** Success Messages */
$arrLang["API_SUCCESS_SUBMITTED"] = "Succesfully Created API Key!";
$arrLang["API_SUCCESS_DELETED"] = "Succesfully Revoked API Key!";

//** END Success Messages */
//** Method Strings **/
$arrLang["API_SETTINGS_ALLOWPOST"] = "Allow POST";
$arrLang["API_SETTINGS_ALLOWGET"] = "Allow GET";
$arrLang["API_SETTINGS_ALLOWDELETE"] = "Allow DELETE";
$arrLang["API_SETTINGS_ALLOWPUT"] = "Allow PUT";
//** End Method Strings **/

//** Method Strings **/
$arrLang["API_SETTINGS_NCICARRESTS"] = "Allow NCIC Arrest Access";
$arrLang["API_SETTINGS_NCICCITATIONS"] = "Allow NCIC Citations Access";
$arrLang["API_SETTINGS_NCICWARRANTS"] = "Allow NCIC Warrants Access";
$arrLang["API_SETTINGS_NCICWARNINGS"] = "Allow NCIC Warnings Access";
$arrLang["API_SETTINGS_NCICPLATES"] = "Allow NCIC Plates Access";
$arrLang["API_SETTINGS_NCICNAMES"] = "Allow NCIC Names Access";
$arrLang["API_SETTINGS_NCICWEAPONS"] = "Allow NCIC Weapons Access";
//** End Method Strings **/


//** End Webhook Strings **/

//** Begin Civillian Console Strings **/
$arrLang["CIVILLIAN_CONSOLE"] = "Civillian Console";
$arrLang["MY_IDENTITIES"] = "My Identities";
$arrLang["MY_IDENTITIES_notes"] = "No results found in the the identities database.";
$arrLang["MY_VEHICLES"] = "My Vehicles";
$arrLang["MY_VEHICLES_notes"] = "No results found in the vehicles database.";
$arrLang["MY_WEAPONS"] = "My Weapons";
$arrLang["MY_WEAPONS_notes"] = "No results found in the weapons database.";
$arrLang["MY_WARRANTS"] = "My Warrants";
$arrLang["MY_WARRANTS_notes"] = "No results found in the warrants database.";
$arrLang["CREATE_A_CALL"] = "Create A Call";
$arrLang["ADD_NEW_IDENTITY"] = "Add New Identity";
$arrLang["ADD_NEW_VEHICLE"] = "Add New Vehicle";
$arrLang["ADD_NEW_WEAPON"] = "Add New Weapon";
$arrLang["CIVILLIAN_DASHBOARD"] = "Civillian Dashboard";
$arrLang["VIEW_WARRANTS"] = "View Warrants";
$arrLang["CREATE_WARRANT"] = "Create Warrant";
$arrLang["UPDATE"] = "Update";
//** End Civillian Console Strings **/

//** Begin CAD Console Strings **/
$arrLang["CAD_CONSOLE"] = "CAD Console";
$arrLang["ACTIVE_DISPATCHERS"] = "Active Dispatchers";
$arrLang["ACTIVE_DISPATCHERS_notes"] = "No dispatchers currently available.";
$arrLang["AVAILABLE_UNITS"] = "Available Units";
$arrLang["UNAVAILABLE_UNITS"] = "Unavailable Units";
$arrLang["NEW_PERSONS_BOLO"] = "New Persons BOLO";
$arrLang["NEW_VEHICLE_BOLO"] = "New Vehicle BOLO";
$arrLang["NEW_CALL"] = "New Call";
$arrLang["PANIC_BUTTON"] = "Panic Button";
$arrLang["PRIORITY_TONE"] = "Priority Tone";
$arrLang["__BORADCASTING_BUTTON"] = "10-3 Tone";
$arrLang["STOPWATCH"] = "Stopwatch";
$arrLang["WARNINGS"] = "Warnings";
$arrLang["CITATIONS"] = "Citations";
$arrLang["ARREST_REPORT"] = "Arrest Report";
$arrLang["WARRANTS"] = "Warrants";
$arrLang["SET_AREA_OF_PATROL"] = "Set Area of Patrol";
$arrLang["STOP_TRANSMITTING"] = "10-3 Tone";
//** End CAD Console Strings *//

//** Begin MDT Console Strings **/
$arrLang["MDT_CONSOLE"] = "MDT Console";
$arrLang["MY_CALLSIGN"] = "My Callsign";
$arrLang["MY_STATUS"] = "My Status";
$arrLang["STATUS"] = "My Status";
$arrLang["MY_CALL"] ="My Call";
$arrLang["VIEW_PERSONS_BOLOS"] = "View Persons BOLOs";
$arrLang["VIEW_VEHICLE_BOLOS"] = "View Vehicle BOLOs";
//** End MDT Console Strings *//

//** Begin Profile Console Strings **/
$arrLang["PASSWORD"] = "Password";
$arrLang["CHANGE_PASSWORD"] = "Change Password";
$arrLang["MY_PRFILE"] ="My Profile";
$arrLang["PROFILE_SUCCESS"] = "Successfully updated your user profile.";
$arrLang["PASSWORD_SUCCESS"] = "Successfully updated your password.";
//** End Profile Console Strings *//


// ** Begin MISC Strings **//
$arrLang["OUTDATED"] = "Your version of OpenCAD is Outdated! Please download the lastest <a href='https://github.com/opencad-app/OpenCAD-php'>From our GitHub</a>";
$arrLang["OUTDATED_notes"] = "<i>Notice:</i> You are welcome to ignore this message and carry on using OpenCAD, but please be aware, you won't have the latest features and fixes.";
// ** End MISC Strings **//
?>