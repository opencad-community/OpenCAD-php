-- Last updated for OpenCAD 0.2.6

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>citation_types` (
    `id` INT(11)  AUTO_INCREMENT,
    `citation_description` VARCHAR(255) COMMENT 'Description of an often issued citation.',
    `citation_fine` DECIMAL(19, 2) COMMENT 'Reccomended fine for given citation.',
    PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>incident_types` (
    `id` INT(11) AUTO_INCREMENT,
    `code_id` VARCHAR(255) DEFAULT 'Radio code for given incident type.',
    `code_name` VARCHAR(255) COMMENT 'Name or description of incident.',
    PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>radio_codes` (
    `id` INT(11) AUTO_INCREMENT,
    `code` VARCHAR(10) COMMENT 'Radio code for statuses.',
    `code_description` VARCHAR(255) COMMENT 'Descriptio of status code.',
    `onCall` INT(11) COMMENT 'Execute onCall to clear unit from a call.',
    PRIMARY KEY(`id`),
    UNIQUE KEY `code`(`code`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>warning_types` (
    `id` INT(11)  AUTO_INCREMENT,
    `warning_description` VARCHAR(255),
    `citation_fine` DECIMAL(19, 2) COMMENT 'Description of a frequently used warning type.',
    PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>warrant_types` (
    `id` INT(11) AUTO_INCREMENT,
    `warrant_description` VARCHAR(255) COMMENT 'Description of a frequently used warrant type.',
    PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

ALTER TABLE `<DB_PREFIX>ncic_names` MODIFY IF EXISTS `dl_type`
set('Not Issued','Learners','Provisional','Open','Identification Only')  DEFAULT 'Not Issued' AFTER `dl_status`;

ALTER TABLE `<DB_PREFIX>ncic_names` MODIFY IF EXISTS `dl_class`
set('Car','Light Rig','Heavy Rig','Boat','Motorbike','Military')  AFTER `dl_type`;

ALTER TABLE `<DB_PREFIX>ncic_names` MODIFY IF EXISTS `dl_issuer`
set('Government','Military')  AFTER `dl_class`;

ALTER TABLE `<DB_PREFIX>ncic_names` MODIFY IF EXISTS `weapon_permit`
set('Unobtained','Vaild','Suspended','Expired','Canceled')  AFTER `build`;

ALTER TABLE `<DB_PREFIX>ncic_names` MODIFY IF EXISTS `weapon_permit_type`
set('Small Arms','Specialised Weapon','Automatic Weapon','Semi-Automatic','Military Grade','Unknown') DEFAULT 'Unknown' AFTER `weapon_permit`;

ALTER TABLE `<DB_PREFIX>ncic_names` MODIFY IF EXISTS `weapon_permit_Issued_by`
set('Ammu-Nation','Government','Military','Unknown') DEFAULT 'Unknown' AFTER `weapon_permit_type`;

ALTER TABLE `<DB_PREFIX>ncic_names` MODIFY IF EXISTS `deceased`
set('NO','YES') DEFAULT 'NO' AFTER `organ_donor`;

ALTER TABLE `<DB_PREFIX>ncic_names` MODIFY IF EXISTS `race`
set('Indian','Asian','Black or African American','Hispanic','Caucasian','Pacific Islander','Unknown') DEFAULT 'Unknown' AFTER `gender`;

ALTER TABLE `<DB_PREFIX>ncic_names` MODIFY IF EXISTS `blood_type`
set('A+','O+','B+','AB+','A-','O-','B-','AB-','Unknown') DEFAULT 'Unknown' AFTER `weapon_permit_issued_by`;

ALTER TABLE `<DB_PREFIX>ncic_names` MODIFY IF EXISTS `organ_donor`
set('NO','YES')  DEFAULT 'NO' AFTER `blood_type`;

ALTER TABLE `<DB_PREFIX>ncic_names` MODIFY IF EXISTS `build`
set('Average','Fit','Muscular','Overweight','Skinny','Thin') AFTER `hair_color`;

ALTER TABLE `<DB_PREFIX>ncic_names` MODIFY IF EXISTS `hair_color`
set('Bald','Black','Blonde','Blue','Brown','Gray','Green','Orange','Pink','Purple','Red','Auburn','Sandy','Strawberry','White','Partially Gray') AFTER `dl_Issued_by`;

ALTER TABLE `<DB_PREFIX>ncic_plates` MODIFY IF EXISTS `veh_insurance`
set('VALID','EXPIRED','CANCELED','SUSPENDED','Unknown') DEFAULT 'Unknown' AFTER `veh_scolor`;

ALTER TABLE `<DB_PREFIX>ncic_plates` MODIFY IF EXISTS `veh_insurance type`
set('CTP','Third Party','Comprehensive','Unknown') DEFAULT 'Unknown' AFTER `veh_insurance`;

ALTER TABLE `<DB_PREFIX>ncic_plates` MODIFY IF EXISTS `flags`
set('STOLEN','WANTED','SUSPENDED REGISTRATION','CANCELED REGISTRATION','EXPIRED REGISTRATION','INSURANCE FLAG','DL FLAG') AFTER `veh_insurance type`;

ALTER TABLE `<DB_PREFIX>ncic_plates` MODIFY IF EXISTS `veh_reg_state`
set('Los Santos','Blaine County','San Andreas','Unknown') DEFAULT 'Unknown' AFTER `flags`;

DROP TABLE IF EXISTS
    `<DB_PREFIX>permissions`;
DROP TABLE IF EXISTS
    `<DB_PREFIX>codes`;
DROP TABLE IF EXISTS
    `permissions`;
DROP TABLE IF EXISTS
    `codes`;