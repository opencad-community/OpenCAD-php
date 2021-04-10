CREATE TABLE IF NOT EXISTS `<DB_PREFIX>activeUsers` (
  `identifier` varchar(255) NOT NULL,
  `callsign` varchar(255) NOT NULL COMMENT 'Unit Callsign',
  `status` int(11) NOT NULL COMMENT 'Unit status, 0=busy/unavailable, 1=available, 2=dispatcher',
  `statusDetail` int(11) NOT NULL COMMENT 'Paired to Statuses table',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `identifier` (`identifier`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>aop` (
  `aop` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>bolosPersons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL COMMENT 'First name of BOLO suspect.',
  `lastName` varchar(255) NOT NULL COMMENT 'Last name of BOLO suspect.',
  `gender` varchar(255) NOT NULL COMMENT 'Gender of BOLO suspect.',
  `physicalDescription` varchar(255) NOT NULL COMMENT 'Physical description of BOLO suspect.',
  `reasonWanted` varchar(255) NOT NULL COMMENT 'Reason BOLO suspect is wanted.',
  `lastSeen` varchar(255) NOT NULL COMMENT 'Last observed location of BOLO suspect.',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>bolosVehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicleMake` varchar(255) NOT NULL COMMENT 'Make of BOLO vehicle.',
  `vehicleModel` varchar(255) NOT NULL COMMENT 'Model of BOLO vehicle.',
  `vehiclePlate` varchar(255) NOT NULL COMMENT 'License of BOLO vehicle.',
  `primaryColor` varchar(255) NOT NULL COMMENT 'Primary color of BOLO vehicle.',
  `secondaryColor` varchar(255) NOT NULL COMMENT 'Secondary color of BOLO vehicle.',
  `reasonWanted` varchar(255) NOT NULL COMMENT 'Reason BOLO suspect is wanted.',
  `lastSeen` varchar(255) NOT NULL COMMENT 'Last observed location of BOLO vehicle.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>calls` (
  `callId` int(11) NOT NULL,
  `callType` text NOT NULL,
  `callPprimary` text DEFAULT NULL,
  `callStreet1` text NOT NULL,
  `callStreet2` text DEFAULT NULL,
  `callStreet3` text DEFAULT NULL,
  `callNarrative` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>callsUsers` (
  `callId` int(11) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `callsign` varchar(255) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>callHistory` (
  `callId` int(11) NOT NULL,
  `callType` text NOT NULL,
  `callPrimary` text DEFAULT NULL,
  `callStreet1` text NOT NULL,
  `callStreet2` text DEFAULT NULL,
  `callStreet3` text DEFAULT NULL,
  `callNarrative` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>callList` (
  `callId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>citationTypes` (
  `citationId` int(11) NOT NULL AUTO_INCREMENT,
  `citationDescription` varchar(255) NOT NULL,
  `citationFine` decimal(19,2) NOT NULL,
  PRIMARY KEY (`citationId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>civilianNames` (
  `userId` int(11) NOT NULL COMMENT 'Links to users table',
  `namesId` int(11) NOT NULL COMMENT 'Links to names table'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>colors` (
  `id` int(11) NOT NULL,
  `colorGroup` varchar(255) DEFAULT NULL,
  `colorName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>config` (
  `key` varchar(80) NOT NULL,
  `value` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>departments` (
  `departmentId` int(11) NOT NULL,
  `departmentName` varchar(255) DEFAULT NULL COMMENT 'The functional name of the department. (eg. Police, Fire, EMS)',
  `departmentShortName` varchar(10) NOT NULL COMMENT 'The name of the department. (eg. Los Angeles Police Department, Blaine County Sheriffs` Office',
  `departmentLongName` varchar(255) NOT NULL COMMENT 'The acronym of the department name. (eg. BCSO, LAPD, LAFD)',
  `allowDepartment` int(1) DEFAULT 2 COMMENT 'If 1 then department is disabled, if 2 then department is enabled.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>dispatchers` (
  `identifier` varchar(255) NOT NULL,
  `callsign` varchar(255) NOT NULL COMMENT 'Unit Callsign',
  `status` int(11) NOT NULL COMMENT 'Unit status, 0=offline, 1=online',
  UNIQUE KEY `identifier` (`identifier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>genders` (
  `id` int(11) NOT NULL,
  `genders` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>incidentTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codeId` varchar(255) DEFAULT '',
  `codeName` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>ncicArrests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameId` int(11) NOT NULL COMMENT 'Paired to ID of ncicNames table',
  `arrestReason` varchar(255) NOT NULL,
  `arrestFine` int(11) NOT NULL,
  `issuedDate` date DEFAULT NULL,
  `issuedBy` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>ncicCitations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(2) DEFAULT 0 COMMENT '0 = Pending, 1 = Approved/Active',
  `nameId` int(11) NOT NULL COMMENT 'Paired to ID of ncicNames table',
  `citationName` varchar(255) NOT NULL,
  `citationFine` int(11) NOT NULL,
  `issuedDate` date DEFAULT NULL,
  `issuedBy` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>ncicPlates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameId` int(11) NOT NULL COMMENT 'Links to ncicNames db for driver information',
  `vehPlate` text NOT NULL,
  `vehMake` text NOT NULL,
  `veh_model` text NOT NULL,
  `vehPColor` text NOT NULL,
  `vehSColor` text NOT NULL,
  `vehInsurance` set('VALID','EXPIRED','CANCELED','SUSPENDED','Unknown') DEFAULT 'VALID',
  `vehInsuranceType` set('CTP','Third Party','Comprehensive') DEFAULT 'CTP',
  `flags` set('NONE','STOLEN','WANTED','SUSPENDED REGISTRATION','CANCELED REGISTRATION','EXPIRED REGISTRATION','INSURANCE FLAG','DRIVER FLAG','NO INSURANCE') DEFAULT NULL,
  `vehRegState` set('Los Santos','Blaine County','San Andreas') DEFAULT NULL,
  `notes` text DEFAULT NULL COMMENT 'Any special flags visible to dispatchers',
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>ncicNames` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `submittedByName` varchar(255) NOT NULL,
  `submittedById` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dob` date DEFAULT NULL COMMENT 'Date of birth',
  `address` text DEFAULT NULL,
  `gender` set('Male','Female','Transgender Man','Transgender Woman','Intersex','Other') DEFAULT NULL,
  `race` set('Indian','Asian','Black or African American','Hispanic','Caucasian','Pacific Islander','White') DEFAULT NULL,
  `dlStatus` set('Unobtained','Valid','Suspended','Cancelled','Expired') DEFAULT 'Unobtained',
  `dlType` set('Not Issued','Learners','Provisional','Open','Identification Only') DEFAULT 'Not Issued',
  `dlClass` set('Not Applicable','Car','Light Rig','Heavy Rig','Boat','Motorbike','Military') DEFAULT 'Not Applicable',
  `dlIssuer` set('Not Applicable','Government','Military') DEFAULT 'Not Applicable',
  `hairColor` set('Bald','Black','Blonde','Blue','Brown','Gray','Green','Orange','Pink','Purple','Red','Auburn','Sandy','Strawberry','White','Partially Gray') DEFAULT NULL,
  `build` set('Average','Fit','Muscular','Overweight','Skinny','Thin') DEFAULT NULL,
  `weaponPermitStatus` set('Unobtained','Vaild','Suspended','Expired','Canceled') DEFAULT NULL,
  `weaponPermitType` set('Small Arms','Specialised Weapon','Automatic Weapon','Semi-Automatic','Military Grade') DEFAULT NULL,
  `weaponPermitIssuedBy` set('Ammu-Nation','Government','Military') DEFAULT NULL,
  `bloodType` set('A+','O+','B+','AB+','A-','O-','B-','AB-') DEFAULT NULL,
  `blodType` set('A+','O+','B+','AB+','A-','O-','B-','AB-') DEFAULT NULL,
  `organDonor` set('NO','YES') DEFAULT 'NO',
  `deceased` set('NO','YES') DEFAULT 'NO',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>ncicWarnings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(2) DEFAULT 0 COMMENT '0 = Pending, 1 = Approved/Active',
  `nameId` int(11) NOT NULL COMMENT 'Paired to ID of ncicNames table',
  `warningName` varchar(255) NOT NULL,
  `issuedDate` date DEFAULT NULL,
  `issuedBy` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>ncicWarrants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expirationDate` date DEFAULT NULL,
  `warrantName` varchar(255) NOT NULL,
  `issuingAgency` varchar(255) NOT NULL,
  `nameId` int(11) NOT NULL COMMENT 'Key that pairs to the ncicName id',
  `issuedDate` date DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>ncicWeapons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameId` int(11) NOT NULL COMMENT 'Links to ncicNames db for driver information',
  `weaponType` varchar(255) NOT NULL,
  `weaponName` varchar(255) NOT NULL,
  `userId` int(11) NOT NULL,
  `notes` varchar(2048) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>radioCodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `codeDescription` varchar(255) NOT NULL,
  `onCall` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>statuses` (
  `statusId` int(11) NOT NULL,
  `statusText` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>streets` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key for each street',
  `name` text NOT NULL COMMENT 'Street name',
  `county` text NOT NULL COMMENT 'County name',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>tones` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` set('0','1') DEFAULT '0' COMMENT '0 = inactive, 1 = active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='Tones table. DO NOT ADD ROWS TO THIS TABLE';

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text DEFAULT NULL,
  `identifier` varchar(255) DEFAULT NULL,
  `adminPrivilege` int(1) DEFAULT 1 COMMENT 'If 1 then user does not possess any administrative permissions, else if 2 then user possess Moderator privileges, else if 3 then user possess Administrator privileges.',
  `supervisorPrivilege` int(1) DEFAULT 1 COMMENT 'If 1 then user does not possess any supervisor privileges, else 2 then user possess supervisor privileges.',
  `civilianPrivilege` int(1) DEFAULT 1 COMMENT 'If 1 then user does not possess any civilian privileges, else 2 then user possess civilian privileges.',
  `passwordReset` int(1) DEFAULT 0 COMMENT '1 means password reset required. 0 means it''s not.',
  `approved` int(1) DEFAULT 0 COMMENT 'Three main statuses: 0 means pending approval. 1 means has access. 2 means suspended',
  `suspendReason` tinytext DEFAULT NULL COMMENT 'Stores the reason why a user is Suspended',
  `suspendDuration` date DEFAULT NULL COMMENT 'Stores the duration a user is Suspended for',
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='User table';

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>userDepartments` (
  `userId` int(11) NOT NULL,
  `departmentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>userDepartmentsTemp` (
  `userId` int(11) NOT NULL,
  `departmentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='Temporary table - stores user departments for non-approved users';

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Make` varchar(100) NOT NULL,
  `Model` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>warningTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `warningDescription` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>warrantTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `warrantViolent` int(1) NOT NULL,
  `warrantDescription` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>weapons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weaponType` varchar(255) NOT NULL,
  `weaponName` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;



INSERT INTO `<DB_PREFIX>users` (`id`, `name`, `email`, `password`, `identifier`, `adminPrivilege`, `supervisorPrivilege`, `passwordReset`, `approved`, `suspendReason`, `suspendDuration`) VALUES
(1, '<NAME>', '<EMAIL>', '<PASSWORD>', '<IDENTIFIER>', 3, 1, 0, 1, NULL, NULL);



CREATE TABLE `<DB_PREFIX>patrolinformation` (
  `key` tinytext COLLATE latin1_general_cs NOT NULL,
  `value` tinytext COLLATE latin1_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

INSERT INTO `<DB_PREFIX>patrolinformation` (`key`, `value`) VALUES
('aop',	'Metro Los Santos');