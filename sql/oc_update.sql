-- Last updated for OpenCAD 0.2.6

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>citationTypes` (
    `id` INT(11)  AUTO_INCREMENT,
    `citationDescription` VARCHAR(255) COMMENT 'Description of an often issued citation.',
    `citationFine` DECIMAL(19, 2) COMMENT 'Reccomended fine for given citation.',
    PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>incident_types` (
    `id` INT(11) AUTO_INCREMENT,
    `codeId` VARCHAR(255) DEFAULT 'Radio code for given incident type.',
    `codeName` VARCHAR(255) COMMENT 'Name or description of incident.',
    PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>radioCodes` (
    `id` INT(11) AUTO_INCREMENT,
    `code` VARCHAR(10) COMMENT 'Radio code for statuses.',
    `codeDescription` VARCHAR(255) COMMENT 'Descriptio of status code.',
    `onCall` INT(11) COMMENT 'Execute onCall to clear unit from a call.',
    PRIMARY KEY(`id`),
    UNIQUE KEY `code`(`code`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>warningTypes` (
    `id` INT(11)  AUTO_INCREMENT,
    `warningDescription` VARCHAR(255),
    `citationFine` DECIMAL(19, 2) COMMENT 'Description of a frequently used warning type.',
    PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>warrantTypes` (
    `id` INT(11) AUTO_INCREMENT,
    `warrantDescription` VARCHAR(255) COMMENT 'Description of a frequently used warrant type.',
    PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

ALTER TABLE `<DB_PREFIX>ncic_names` CHANGE `dl_issuer` `dl_issuer` set('Government', 'Military') COLLATE 'latin1_swedish_ci' NULL AFTER `dlClass`;


ALTER TABLE `<DB_PREFIX>ncic_names` MODIFY IF EXISTS `dlType`
set('Not Issued','Learners','Provisional','Open','Identification Only')  DEFAULT 'Not Issued' AFTER `dlStatus`;

ALTER TABLE `<DB_PREFIX>departments` CHANGE `departmentShortName` `departmentShortName` 
VARCHAR(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'The acronym of the department name. (eg. BCSO, LAPD, LAFD)';

ALTER TABLE `<DB_PREFIX>departments` CHANGE `departmentLongName` `departmentLongName` 
VARCHAR(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'The name of the department. (eg. Los Angeles Police Department, Blaine County Sheriffs` Office)';

ALTER TABLE `<DB_PREFIX>ncic_names` MODIFY IF EXISTS `dlClass`
set('Car','Light Rig','Heavy Rig','Boat','Motorbike','Military')  AFTER `dlType`;

ALTER TABLE `<DB_PREFIX>ncic_names` MODIFY IF EXISTS `dl_issuer`
set('Government','Military')  AFTER `dlClass`;

ALTER TABLE `<DB_PREFIX>ncic_names` MODIFY IF EXISTS `weaponPermitStatus`
set('Unobtained','Vaild','Suspended','Expired','Canceled')  AFTER `build`;

ALTER TABLE `<DB_PREFIX>ncic_names` MODIFY IF EXISTS `weaponPermitType`
set('Small Arms','Specialised Weapon','Automatic Weapon','Semi-Automatic','Military Grade')  AFTER `weaponPermitStatus`;

ALTER TABLE `<DB_PREFIX>ncic_names` MODIFY IF EXISTS `weapon_permit_issuer`
set('Ammu-Nation','Government','Military') AFTER `weaponPermitType`;

ALTER TABLE `<DB_PREFIX>ncic_names` MODIFY IF EXISTS `deceased`
set('NO','YES') DEFAULT 'NO' AFTER `organDonor`;

ALTER TABLE `<DB_PREFIX>ncic_names` MODIFY IF EXISTS `race`
set('Indian','Asian','Black or African American','Hispanic','Caucasian','Pacific Islander, White')  AFTER `gender`;

ALTER TABLE `<DB_PREFIX>ncic_names` MODIFY IF EXISTS `blood_type`
set('A+','O+','B+','AB+','A-','O-','B-','AB-') AFTER `weapon_permit_issuer`;

ALTER TABLE `<DB_PREFIX>ncic_names` MODIFY IF EXISTS `organDonor`
set('NO','YES')  DEFAULT 'NO' AFTER `blood_type`;

ALTER TABLE `<DB_PREFIX>ncic_names` MODIFY IF EXISTS `build`
set('Average','Fit','Muscular','Overweight','Skinny','Thin') AFTER `hairColor`;

ALTER TABLE `<DB_PREFIX>ncic_names` MODIFY IF EXISTS `hairColor`
set('Bald','Black','Blonde','Blue','Brown','Gray','Green','Orange','Pink','Purple','Red','Auburn','Sandy','Strawberry','White','Partially Gray') AFTER `dl_issuer`;

ALTER TABLE `<DB_PREFIX>ncic_plates` MODIFY IF EXISTS `vehInsurance`
set('VALID','EXPIRED','CANCELED','SUSPENDED')  AFTER `vehSecondaryColor`;

ALTER TABLE `<DB_PREFIX>ncic_plates` MODIFY IF EXISTS `vehInsuranceType`
set('CTP','Third Party','Comprehensive')  AFTER `vehInsurance`;

ALTER TABLE `<DB_PREFIX>ncic_plates` MODIFY IF EXISTS `flags`
set('STOLEN','WANTED','SUSPENDED REGISTRATION','CANCELED REGISTRATION','EXPIRED REGISTRATION','INSURANCE FLAG','DRIVER FLAG','NO INSURANCE') AFTER `vehInsuranceType`;

ALTER TABLE `<DB_PREFIX>ncic_plates` MODIFY IF EXISTS `veh_reg_state`
set('Los Santos','Blaine County','San Andreas')  AFTER `flags`;

DROP TABLE IF EXISTS
    `<DB_PREFIX>permissions`;
DROP TABLE IF EXISTS
    `<DB_PREFIX>codes`;
DROP TABLE IF EXISTS
    `permissions`;
DROP TABLE IF EXISTS
    `codes`;
DROP TABLE IF EXISTS
    `civilian_names`;
DROP TABLE IF EXISTS
    `<DB_PREFIX>civilian_names`;