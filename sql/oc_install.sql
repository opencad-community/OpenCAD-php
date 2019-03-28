-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>active_users`
--

DROP TABLE IF EXISTS `<DB_PREFIX>active_users`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>active_users` (
  `identifier` varchar(255) NOT NULL,
  `callsign` varchar(255) NOT NULL COMMENT 'Unit Callsign',
  `status` int(11) NOT NULL COMMENT 'Unit status, 0=busy/unavailable, 1=available, 2=dispatcher',
  `status_detail` int(11) NOT NULL COMMENT 'Paired to Statuses table',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `identifier` (`identifier`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>aop`
--

DROP TABLE IF EXISTS `<DB_PREFIX>aop`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>aop` (
  `aop` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>bolos_persons`
--

DROP TABLE IF EXISTS `<DB_PREFIX>bolos_persons`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>bolos_persons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL COMMENT 'First name of BOLO suspect.',
  `last_name` varchar(255) NOT NULL COMMENT 'Last name of BOLO suspect.',
  `gender` varchar(255) NOT NULL COMMENT 'Gender of BOLO suspect.',
  `physical_description` varchar(255) NOT NULL COMMENT 'Physical description of BOLO suspect.',
  `reason_wanted` varchar(255) NOT NULL COMMENT 'Reason BOLO suspect is wanted.',
  `last_seen` varchar(255) NOT NULL COMMENT 'Last observed location of BOLO suspect.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>bolos_vehicles`
--

DROP TABLE IF EXISTS `<DB_PREFIX>bolos_vehicles`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>bolos_vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_make` varchar(255) NOT NULL COMMENT 'Make of BOLO vehicle.',
  `vehicle_model` varchar(255) NOT NULL COMMENT 'Model of BOLO vehicle.',
  `vehicle_plate` varchar(255) NOT NULL COMMENT 'License of BOLO vehicle.',
  `primary_color` varchar(255) NOT NULL COMMENT 'Primary color of BOLO vehicle.',
  `secondary_color` varchar(255) NOT NULL COMMENT 'Secondary color of BOLO vehicle.',
  `reason_wanted` varchar(255) NOT NULL COMMENT 'Reason BOLO suspect is wanted.',
  `last_seen` varchar(255) NOT NULL COMMENT 'Last observed location of BOLO vehicle.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>calls`
--

DROP TABLE IF EXISTS `<DB_PREFIX>calls`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>calls` (
  `call_id` int(11) NOT NULL,
  `call_type` text NOT NULL,
  `call_primary` text DEFAULT NULL,
  `call_street1` text NOT NULL,
  `call_street2` text DEFAULT NULL,
  `call_street3` text DEFAULT NULL,
  `call_narrative` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>calls_users`
--

DROP TABLE IF EXISTS `<DB_PREFIX>calls_users`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>calls_users` (
  `call_id` int(11) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `callsign` varchar(255) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>call_history`
--

DROP TABLE IF EXISTS `<DB_PREFIX>call_history`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>call_history` (
  `call_id` int(11) NOT NULL,
  `call_type` text NOT NULL,
  `call_primary` text DEFAULT NULL,
  `call_street1` text NOT NULL,
  `call_street2` text DEFAULT NULL,
  `call_street3` text DEFAULT NULL,
  `call_narrative` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>call_list`
--

DROP TABLE IF EXISTS `<DB_PREFIX>call_list`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>call_list` (
  `call_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>citation_types`
--

DROP TABLE IF EXISTS `<DB_PREFIX>citation_types`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>citation_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `citation_description` varchar(255) NOT NULL,
  `citation_fine` decimal(6,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>civilian_names`
--

DROP TABLE IF EXISTS `<DB_PREFIX>civilian_names`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>civilian_names` (
  `user_id` int(11) NOT NULL COMMENT 'Links to users table',
  `names_id` int(11) NOT NULL COMMENT 'Links to names table'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>colors`
--

DROP TABLE IF EXISTS `<DB_PREFIX>colors`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>colors` (
  `id` int(11) NOT NULL,
  `color_group` varchar(255) DEFAULT NULL,
  `color_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>config`
--

DROP TABLE IF EXISTS `<DB_PREFIX>config`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>config` (
  `key` varchar(80) NOT NULL,
  `value` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>departments`
--

DROP TABLE IF EXISTS `<DB_PREFIX>departments`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) DEFAULT NULL COMMENT 'The functional name of the department. (eg. Police, Fire, EMS)',
  `department_short_name` varchar(10) NOT NULL COMMENT 'The name of the department. (eg. Los Angeles Police Department, Blaine County Sheriffs` Office',
  `department_long_name` varchar(255) NOT NULL COMMENT 'The acronym of the department name. (eg. BCSO, LAPD, LAFD)',
  `allow_department` int(11) NOT NULL COMMENT 'If 0 then department is disabled, if 1 then department is enabled.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>dispatchers`
--

DROP TABLE IF EXISTS `<DB_PREFIX>dispatchers`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>dispatchers` (
  `identifier` varchar(255) NOT NULL,
  `callsign` varchar(255) NOT NULL COMMENT 'Unit Callsign',
  `status` int(11) NOT NULL COMMENT 'Unit status, 0=offline, 1=online',
  UNIQUE KEY `identifier` (`identifier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>genders`
--

DROP TABLE IF EXISTS `<DB_PREFIX>genders`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>genders` (
  `id` int(11) NOT NULL,
  `genders` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>incident_type`
--

DROP TABLE IF EXISTS `<DB_PREFIX>incident_type`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>incident_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_id` varchar(255) NOT NULL DEFAULT '',
  `code_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>ncic_arrests`
--

DROP TABLE IF EXISTS `<DB_PREFIX>ncic_arrests`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>ncic_arrests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_id` int(11) NOT NULL COMMENT 'Paired to ID of ncic_names table',
  `arrest_reason` varchar(255) NOT NULL,
  `arrest_fine` int(11) NOT NULL,
  `issued_date` date DEFAULT NULL,
  `issued_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>ncic_citations`
--

DROP TABLE IF EXISTS `<DB_PREFIX>ncic_citations`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>ncic_citations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0 = Pending, 1 = Approved/Active',
  `name_id` int(11) NOT NULL COMMENT 'Paired to ID of ncic_names table',
  `citation_name` varchar(255) NOT NULL,
  `citation_fine` int(11) NOT NULL,
  `issued_date` date DEFAULT NULL,
  `issued_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>ncic_names`
--

DROP TABLE IF EXISTS `<DB_PREFIX>ncic_names`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>ncic_names` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `submittedByName` varchar(255) NOT NULL,
  `submittedById` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dob` date NOT NULL COMMENT 'Date of birth',
  `address` text NOT NULL,
  `gender` varchar(255) NOT NULL,
  `race` text NOT NULL,
  `dl_status` set('Unobtained','Valid','Suspended','Expired') NOT NULL,
  `hair_color` text NOT NULL,
  `build` text NOT NULL,
  `weapon_permit` varchar(255) NOT NULL,
  `deceased` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>ncic_plates`
--

DROP TABLE IF EXISTS `<DB_PREFIX>ncic_plates`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>ncic_plates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_id` int(11) NOT NULL COMMENT 'Links to ncic_names db for driver information',
  `veh_plate` text NOT NULL,
  `veh_make` text NOT NULL,
  `veh_model` text NOT NULL,
  `veh_pcolor` text NOT NULL,
  `veh_scolor` text NOT NULL,
  `veh_insurance` set('VALID','EXPIRED') NOT NULL DEFAULT 'VALID',
  `flags` set('NONE','STOLEN','WANTED','SUSPENDED REGISTRATION','UC FLAG','HPIU FLAG') NOT NULL DEFAULT 'NONE',
  `veh_reg_state` text NOT NULL,
  `notes` text DEFAULT NULL COMMENT 'Any special flags visible to dispatchers',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>ncic_warnings`
--

DROP TABLE IF EXISTS `<DB_PREFIX>ncic_warnings`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>ncic_warnings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0 = Pending, 1 = Approved/Active',
  `name_id` int(11) NOT NULL COMMENT 'Paired to ID of ncic_names table',
  `warning_name` varchar(255) NOT NULL,
  `issued_date` date DEFAULT NULL,
  `issued_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>ncic_warrants`
--

DROP TABLE IF EXISTS `<DB_PREFIX>ncic_warrants`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>ncic_warrants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expiration_date` date DEFAULT NULL,
  `warrant_name` varchar(255) NOT NULL,
  `issuing_agency` varchar(255) NOT NULL,
  `name_id` int(11) NOT NULL COMMENT 'Key that pairs to the ncic_name id',
  `issued_date` date DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>ncic_weapons`
--

DROP TABLE IF EXISTS `<DB_PREFIX>ncic_weapons`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>ncic_weapons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_id` int(11) NOT NULL COMMENT 'Links to ncic_names db for driver information',
  `weapon_type` varchar(255) NOT NULL,
  `weapon_name` varchar(255) NOT NULL,
  `weapon_notes` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>permissions`
--

DROP TABLE IF EXISTS `<DB_PREFIX>permissions`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>permissions` (
  `perm_id` int(11) NOT NULL,
  `perm_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>radio_codes`
--

DROP TABLE IF EXISTS `<DB_PREFIX>radio_codes`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>radio_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `code_description` varchar(255) NOT NULL,
  `onCall` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>statuses`
--

DROP TABLE IF EXISTS `<DB_PREFIX>statuses`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>statuses` (
  `status_id` int(11) NOT NULL,
  `status_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>streets`
--

DROP TABLE IF EXISTS `<DB_PREFIX>streets`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>streets` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key for each street',
  `name` text NOT NULL COMMENT 'Street name',
  `county` text NOT NULL COMMENT 'County name',
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>tones`
--

DROP TABLE IF EXISTS `<DB_PREFIX>tones`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>tones` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` set('0','1') NOT NULL DEFAULT '0' COMMENT '0 = inactive, 1 = active'
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tones table. DO NOT ADD ROWS TO THIS TABLE' ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>users`
--

DROP TABLE IF EXISTS `<DB_PREFIX>users`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text DEFAULT NULL,
  `identifier` varchar(255) DEFAULT NULL,
  `admin_privilege` int(1) NOT NULL DEFAULT 1 COMMENT 'If 1 then user does not possess any administrative permissions, else if 2 then user possess Moderator privileges, else if 3 then user possess Administrator privileges.',
  `supervisor_privilege` int(1) NOT NULL DEFAULT 1 COMMENT 'If 1 then user does not possess any supervisor privileges, else 2 then user possess supervisor privileges.',
  `password_reset` int(1) NOT NULL DEFAULT 0 COMMENT '1 means password reset required. 0 means it''s not.',
  `approved` int(1) NOT NULL DEFAULT 0 COMMENT 'Three main statuses: 0 means pending approval. 1 means has access. 2 means suspended',
  `suspend_reason` tinytext DEFAULT NULL COMMENT 'Stores the reason why a user is Suspended',
  `suspend_duration` date DEFAULT NULL COMMENT 'Stores the duration a user is Suspended for',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='User table' ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Dumping data for table `users`
--

INSERT INTO `<DB_PREFIX>users` (`id`, `name`, `email`, `password`, `identifier`, `admin_privilege`, `supervisor_privilege`, `password_reset`, `approved`, `suspend_reason`, `suspend_duration`) VALUES
(1, '<NAME>', '<EMAIL>', '<PASSWORD>', '1A-1', 3, 1, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>user_departments`
--

CREATE TABLE `<DB_PREFIX>user_departments` (
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>user_departments_temp`
--

DROP TABLE IF EXISTS `<DB_PREFIX>user_departments_temp`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>user_departments_temp` (
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Temporary table - stores user departments for non-approved users' ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>vehicles`
--

DROP TABLE IF EXISTS `<DB_PREFIX>vehicles`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Make` varchar(100) NOT NULL,
  `Model` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>warning_types`
--

DROP TABLE IF EXISTS `<DB_PREFIX>warning_types`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>warning_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `warning_description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>warrant_types`
--

DROP TABLE IF EXISTS `<DB_PREFIX>warrant_types`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>warrant_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `warrant_descr<>iption` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `<DB_PREFIX>weapons`
--

DROP TABLE IF EXISTS `<DB_PREFIX>weapons`;
CREATE TABLE IF NOT EXISTS `<DB_PREFIX>weapons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weapon_type` varchar(255) NOT NULL,
  `weapon_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;
