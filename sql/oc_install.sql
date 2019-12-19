DROP TABLE IF EXISTS `<DB_PREFIX>activeUsers`;
CREATE TABLE `<DB_PREFIX>activeUsers` (
  `identifier` varchar(255) NOT NULL,
  `callsign` varchar(255) NOT NULL COMMENT 'Unit Callsign',
  `status` int(11) NOT NULL COMMENT 'Unit status, 0=busy/unavailable, 1=available, 2=dispatcher',
  `statusDetail` int(11) NOT NULL COMMENT 'Paired to Statuses table',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `identifier` (`identifier`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `<DB_PREFIX>patrolInformation`;
CREATE TABLE `<DB_PREFIX>patrolInformation` (
  `key` varchar(80) NOT NULL,
  `value` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `<DB_PREFIX>bolos_persons`;
CREATE TABLE `<DB_PREFIX>bolos_persons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL COMMENT 'First name of BOLO suspect.',
  `lastName` varchar(255) NOT NULL COMMENT 'Last name of BOLO suspect.',
  `gender` varchar(255) NOT NULL COMMENT 'Gender of BOLO suspect.',
  `physicalDescription` varchar(255) NOT NULL COMMENT 'Physical description of BOLO suspect.',
  `reasonWanted` varchar(255) NOT NULL COMMENT 'Reason BOLO suspect is wanted.',
  `lastSeen` varchar(255) NOT NULL COMMENT 'Last observed location of BOLO suspect.',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `<DB_PREFIX>bolosVehicles`;
CREATE TABLE `<DB_PREFIX>bolosVehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `make` varchar(255) NOT NULL COMMENT 'Make of BOLO vehicle.',
  `model` varchar(255) NOT NULL COMMENT 'Model of BOLO vehicle.',
  `plate` varchar(255) NOT NULL COMMENT 'License of BOLO vehicle.',
  `primaryColor` varchar(255) NOT NULL COMMENT 'Primary color of BOLO vehicle.',
  `secondaryColor` varchar(255) NOT NULL COMMENT 'Secondary color of BOLO vehicle.',
  `reasonWanted` varchar(255) NOT NULL COMMENT 'Reason BOLO suspect is wanted.',
  `lastSeen` varchar(255) NOT NULL COMMENT 'Last observed location of BOLO vehicle.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `<DB_PREFIX>calls`;
CREATE TABLE `<DB_PREFIX>calls` (
  `callId` int(11) NOT NULL,
  `callType` text NOT NULL,
  `callPrimaryUnit` text DEFAULT NULL,
  `callStreet1` text NOT NULL,
  `callStreet2` text DEFAULT NULL,
  `callStreet3` text DEFAULT NULL,
  `callNarrative` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `<DB_PREFIX>callsUsers`;
CREATE TABLE `<DB_PREFIX>callsUsers` (
  `callId` int(11) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `callsign` varchar(255) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `<DB_PREFIX>callHistory`;
CREATE TABLE `<DB_PREFIX>callHistory` (
  `callId` int(11) NOT NULL,
  `callType` text NOT NULL,
  `callPrimaryUnit` text DEFAULT NULL,
  `callStreet1` text NOT NULL,
  `callStreet2` text DEFAULT NULL,
  `callStreet3` text DEFAULT NULL,
  `callNarrative` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `<DB_PREFIX>callList`;
CREATE TABLE `<DB_PREFIX>callList` (
  `callId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `<DB_PREFIX>citationTypes`;
CREATE TABLE `<DB_PREFIX>citationTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `citationDescription` varchar(255) NOT NULL,
  `citationFine` decimal(19,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `<DB_PREFIX>civilian_names`;
CREATE TABLE `<DB_PREFIX>civilian_names` (
  `userId` int(11) NOT NULL COMMENT 'Links to users table',
  `namesId` int(11) NOT NULL COMMENT 'Links to names table'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `<DB_PREFIX>colors`;
CREATE TABLE `<DB_PREFIX>colors` (
  `id` int(11) NOT NULL,
  `colorGorup` varchar(255) DEFAULT NULL,
  `colorName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `<DB_PREFIX>config`;
CREATE TABLE `<DB_PREFIX>config` (
  `key` varchar(80) NOT NULL,
  `value` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `<DB_PREFIX>departments`;
CREATE TABLE `<DB_PREFIX>departments` (
  `departmentId` int(11) NOT NULL,
  `departmentName` varchar(255) DEFAULT NULL COMMENT 'The functional name of the department. (eg. Police, Fire, EMS)',
  `departmentShortName` varchar(10) NOT NULL COMMENT 'The acronym of the department name. (eg. BCSO, LAPD, LAFD)',
  `departmentLongName` varchar(255) NOT NULL COMMENT 'The name of the department. (eg. Los Angeles Police Department, Blaine County Sheriffs` Office)',
  `departmentEnabled` int(1) DEFAULT 2 COMMENT 'If 1 then department is disabled, if 2 then department is enabled.' 
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `<DB_PREFIX>dispatchers`;
CREATE TABLE `<DB_PREFIX>dispatchers` (
  `identifier` varchar(255) NOT NULL,
  `callsign` varchar(255) NOT NULL COMMENT 'Unit Callsign',
  `status` int(11) NOT NULL COMMENT 'Unit status, 0=offline, 1=online',
  UNIQUE KEY `identifier` (`identifier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `<DB_PREFIX>genders`;
CREATE TABLE `<DB_PREFIX>genders` (
  `id` int(11) NOT NULL,
  `genders` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `<DB_PREFIX>incident_types`;
CREATE TABLE `<DB_PREFIX>incident_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codeId` varchar(255) DEFAULT '',
  `codeName` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `<DB_PREFIX>ncic_arrests`;
CREATE TABLE `<DB_PREFIX>ncic_arrests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameId` int(11) NOT NULL COMMENT 'Paired to ID of ncic_names table',
  `arrestReason` varchar(255) NOT NULL,
  `arrestFine` int(11) NOT NULL,
  `issuedDate` date DEFAULT NULL,
  `issuer` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `<DB_PREFIX>ncic_citations`;
CREATE TABLE `<DB_PREFIX>ncic_citations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(2) DEFAULT 0 COMMENT '0 = Pending, 1 = Approved/Active',
  `nameId` int(11) NOT NULL COMMENT 'Paired to ID of ncic_names table',
  `citationName` varchar(255) NOT NULL,
  `citationFine` int(11) NOT NULL,
  `issuedDate` date DEFAULT NULL,
  `issuer` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;




CREATE TABLE IF NOT EXISTS `<DB_PREFIX>ncic_plates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameId` int(11) NOT NULL COMMENT 'Links to ncic_names db for driver information',
  `vehPlate` text NOT NULL,
  `vehMake` text NOT NULL,
  `vehModel` text NOT NULL,
  `vehPrimaryColor` text NOT NULL,
  `vehSecondaryColor` text NOT NULL,
  `vehInsurance` set('VALID','EXPIRED','CANCELED','SUSPENDED', 'Unknown') DEFAULT 'Unknown',
  `vehInsuranceType` set('CTP','Third Party','Comprehensive', 'Unknown') DEFAULT 'Unknown',
  `flags` set('STOLEN','WANTED','SUSPENDED REGISTRATION','CANCELED REGISTRATION','EXPIRED REGISTRATION','INSURANCE FLAG','DRIVER FLAG','NO INSURANCE'),
  `veh_reg_state` set('Los Santos','Blaine County','San Andreas', 'Unknown') DEFAULT 'Unknown',
  `notes` text DEFAULT NULL COMMENT 'Any special flags visible to dispatchers',
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

DROP TABLE IF EXISTS `<DB_PREFIX>ncic_names`;
CREATE TABLE `<DB_PREFIX>ncic_names` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `submittedByName` varchar(255) NOT NULL,
  `submittedById` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dob` date DEFAULT NULL COMMENT 'Date of birth',
  `address` text DEFAULT NULL,
  `gender` set('Male','Female','Transgender Man','Transgender Woman','Intersex','Other') DEFAULT NULL,
  `race` set('Indian','Asian','Black or African American','Hispanic','Caucasian','Pacific Islander','White') DEFAULT NULL,
  `dlStatus` set('Unobtained','Valid','Suspended','Canceled','Expired') DEFAULT 'Unobtained',
  `dlType` set('Not Issued','Learners','Provisional','Open','Identification Only') DEFAULT 'Not Issued',
  `dlClass` set('Not Applicable','Car','Light Rig','Heavy Rig','Boat','Motorbike','Military') DEFAULT 'Not Applicable',
  `dlIssuer` set('Not Applicable','Government','Military') DEFAULT 'Not Applicable',
  `hairColor` set('Bald','Black','Blonde','Blue','Brown','Gray','Green','Orange','Pink','Purple','Red','Auburn','Sandy','Strawberry','White','Partially Gray') DEFAULT NULL,
  `build` set('Average','Fit','Muscular','Overweight','Skinny','Thin') DEFAULT NULL,
  `weapon_permit` set('Unobtained','Vaild','Suspended','Expired','Canceled') DEFAULT NULL,
  `weaponPermitType` set('Small Arms','Specialised Weapon','Automatic Weapon','Semi-Automatic','Military Grade') DEFAULT NULL,
  `weaponPermitIssuedBy` set('Ammu-Nation','Government','Military') DEFAULT NULL,
  `bloodType` set('A+','O+','B+','AB+','A-','O-','B-','AB-') DEFAULT NULL,
  `organDonor` set('NO','YES') DEFAULT 'NO',
  `deceased` set('NO','YES') DEFAULT 'NO',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

DROP TABLE IF EXISTS `<DB_PREFIX>ncic_warnings`;
CREATE TABLE `<DB_PREFIX>ncic_warnings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(2) DEFAULT 0 COMMENT '0 = Pending, 1 = Approved/Active',
  `nameId` int(11) NOT NULL COMMENT 'Paired to ID of ncic_names table',
  `warningName` varchar(255) NOT NULL,
  `issuedDate` date DEFAULT NULL,
  `issuer` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `<DB_PREFIX>ncic_warrants`;
CREATE TABLE `<DB_PREFIX>ncic_warrants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expirationDate` date DEFAULT NULL,
  `warrantName` varchar(255) NOT NULL,
  `issuer` varchar(255) NOT NULL,
  `nameId` int(11) NOT NULL COMMENT 'Key that pairs to the ncic_name id',
  `issuedDate` date DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `<DB_PREFIX>ncic_weapons`;
CREATE TABLE `<DB_PREFIX>ncic_weapons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameId` int(11) NOT NULL COMMENT 'Links to ncic_names db for driver information',
  `weaponType` varchar(255) NOT NULL,
  `weaponName` varchar(255) NOT NULL,
  `userId` int(11) NOT NULL,
  `notes` varchar(2048) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `<DB_PREFIX>radioCodes`;
CREATE TABLE `<DB_PREFIX>radioCodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `codeDescription` varchar(255) NOT NULL,
  `onCall` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `<DB_PREFIX>statuses`;
CREATE TABLE `<DB_PREFIX>statuses` (
  `statusId` int(11) NOT NULL,
  `statusText` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `<DB_PREFIX>streets`;
CREATE TABLE `<DB_PREFIX>streets` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key for each street',
  `name` text NOT NULL COMMENT 'Street name',
  `county` text NOT NULL COMMENT 'County name',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `<DB_PREFIX>tones`;
CREATE TABLE `<DB_PREFIX>tones` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` set('0','1') DEFAULT '0' COMMENT '0 = inactive, 1 = active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='Tones table. DO NOT ADD ROWS TO THIS TABLE';


DROP TABLE IF EXISTS `<DB_PREFIX>users`;
CREATE TABLE `<DB_PREFIX>users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text DEFAULT NULL,
  `identifier` varchar(255) DEFAULT NULL,
  `adminPrivilege` int(1) DEFAULT 1 COMMENT 'If 1 then user does not possess any administrative permissions, else if 2 then user does possess Moderator privileges, else if 3 then user possess Administrator privileges.',
  `civilianPrivilege` int(1) DEFAULT 1 COMMENT 'If 1 then user does not possess any civilian privileges, else 2 then user does possess civilian privileges.',
  `supervisorPrivilege` int(1) DEFAULT 1 COMMENT 'If 1 then user does not possess any supervisor privileges, else 2 then user does possess supervisor privileges.',
  `passwordReset` int(1) DEFAULT 0 COMMENT '1 means password reset required. 0 means it''s not.',
  `approved` int(1) DEFAULT 0 COMMENT 'Three main statuses: 0 means pending approval. 1 means has access. 2 means suspended',
  `suspendReason` tinytext DEFAULT NULL COMMENT 'Stores the reason why a user is Suspended',
  `suspendDuration` date DEFAULT NULL COMMENT 'Stores the duration a user is Suspended for',
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='User table';


DROP TABLE IF EXISTS `<DB_PREFIX>userDepartments`;
CREATE TABLE `<DB_PREFIX>userDepartments` (
  `userId` int(11) NOT NULL,
  `departmentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `<DB_PREFIX>userDepartmentsTemp`;
CREATE TABLE `<DB_PREFIX>userDepartmentsTemp` (
  `userId` int(11) NOT NULL,
  `departmentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='Temporary table - stores user departments for non-approved users';


DROP TABLE IF EXISTS `<DB_PREFIX>vehicles`;
CREATE TABLE `<DB_PREFIX>vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `make` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `<DB_PREFIX>warningTypes`;
CREATE TABLE `<DB_PREFIX>warningTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `warningDescription` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `<DB_PREFIX>warrantTypes`;
CREATE TABLE `<DB_PREFIX>warrantTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `warrantDescription` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `<DB_PREFIX>weapons`;
CREATE TABLE `<DB_PREFIX>weapons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weaponType` varchar(255) NOT NULL,
  `weaponName` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;



INSERT INTO `<DB_PREFIX>users` (`id`, `name`, `email`, `password`, `identifier`, `adminPrivilege`, `supervisorPrivilege`, `passwordReset`, `approved`, `suspendReason`, `suspendDuration`) VALUES
(1, '<NAME>', '<EMAIL>', '<PASSWORD>', '<IDENTIFIER>', 3, 1, 0, 1, NULL, NULL);

INSERT INTO `<DB_PREFIX>config` (`key`, `value`) VALUES
('sessionKey',	'HadROvwkb415l7RC7EzQ9riymS931RowCiU8qJn4'),
('dbSchemaVersion',	'1.0');

INSERT INTO `<DB_PREFIX>patrolInformation` (`key`, `value`) VALUES
('areaOfPatrol',	''),
('communicationsSupervisor',	''),
('stateSupervisor',	''),
('sheriffsSupervisor',	''),
('policeSupervisor',	''),
('fireSupervisor',	''),
('emsSupervisor',	''),
('roadesideAssistance',	'');