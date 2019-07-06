-- Last updated for OpenCAD 0.2.6

CREATE TABLE IF NOT EXISTS `S7UIEg_citation_types` (
    `id` INT(11)  AUTO_INCREMENT,
    `citation_description` VARCHAR(255) COMMENT 'Description of an often issued citation.',
    `citation_fine` DECIMAL(19, 2) COMMENT 'Reccomended fine for given citation.',
    PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

CREATE TABLE IF NOT EXISTS `S7UIEg_incident_types` (
    `id` INT(11) AUTO_INCREMENT,
    `code_id` VARCHAR(255) DEFAULT 'Radio code for given incident type.',
    `code_name` VARCHAR(255) COMMENT 'Name or description of incident.',
    PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

CREATE TABLE IF NOT EXISTS `S7UIEg_radio_codes` (
    `id` INT(11) AUTO_INCREMENT,
    `code` VARCHAR(10) COMMENT 'Radio code for statuses.',
    `code_description` VARCHAR(255) COMMENT 'Descriptio of status code.',
    `onCall` INT(11) COMMENT 'Execute onCall to clear unit from a call.',
    PRIMARY KEY(`id`),
    UNIQUE KEY `code`(`code`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

CREATE TABLE IF NOT EXISTS `S7UIEg_warning_types` (
    `id` INT(11)  AUTO_INCREMENT,
    `warning_description` VARCHAR(255),
    `citation_fine` DECIMAL(19, 2) COMMENT 'Description of a frequently used warning type.',
    PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

CREATE TABLE IF NOT EXISTS `S7UIEg_warrant_types` (
    `id` INT(11) AUTO_INCREMENT,
    `warrant_description` VARCHAR(255) COMMENT 'Description of a frequently used warrant type.',
    PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

CREATE TABLE IF NOT EXISTS `S7UIEg_config` (
    `key` varchar(80) NOT NULL,
    `value` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

ALTER TABLE `S7UIEg_ncic_names` MODIFY `dl_type` set('Not Issued','Learners','Provisional','Open','Identification Only') DEFAULT 'Not Issued' AFTER `dl_status`;

ALTER TABLE `S7UIEg_ncic_names` MODIFY `dl_class` set('Car','Light Rig','Heavy Rig','Boat','Motorbike','Military') AFTER `dl_type`;

ALTER TABLE `S7UIEg_ncic_names` MODIFY `dl_issuer` set('Government','Military') AFTER `dl_class`;

ALTER TABLE `S7UIEg_ncic_names` MODIFY `weapon_permit` set('Unobtained','Vaild','Suspended','Expired','Canceled') AFTER `build`;

ALTER TABLE `S7UIEg_ncic_names` MODIFY `weapon_permit_type` set('Small Arms','Specialised Weapon','Automatic Weapon','Semi-Automatic','Military Grade') AFTER `weapon_permit`;

ALTER TABLE `S7UIEg_ncic_names` MODIFY `weapon_permit_issuer` set('Ammu-Nation','Government','Military') AFTER `weapon_permit_type`;

ALTER TABLE `S7UIEg_ncic_names` MODIFY `deceased` set('NO','YES') DEFAULT 'NO' AFTER `organ_donor`;

ALTER TABLE `S7UIEg_ncic_names` MODIFY `race` set('Indian','Asian','Black or African American','Hispanic','Caucasian','Pacific Islander') AFTER `gender`;

ALTER TABLE `S7UIEg_ncic_names` MODIFY `blood_type` set('A+','O+','B+','AB+','A-','O-','B-','AB-') AFTER `weapon_permit_issuer`;

ALTER TABLE `S7UIEg_ncic_names` MODIFY `organ_donor` set('NO','YES')  DEFAULT 'NO' AFTER `blood_type`;

ALTER TABLE `S7UIEg_ncic_names` MODIFY `build` set('Average','Fit','Muscular','Overweight','Skinny','Thin') AFTER `hair_color`;

ALTER TABLE `S7UIEg_ncic_names` MODIFY `hair_color` set('Bald','Black','Blonde','Blue','Brown','Gray','Green','Orange','Pink','Purple','Red','Auburn','Sandy','Strawberry','White','Partially Gray') AFTER `dl_issuer`;

ALTER TABLE `S7UIEg_ncic_plates` MODIFY `veh_insurance` set('VALID','EXPIRED','CANCELED','SUSPENDED')  AFTER `veh_scolor`;

ALTER TABLE `S7UIEg_ncic_plates` MODIFY `veh_insurance type` set('CTP','Third Party','Comprehensive')  AFTER `veh_insurance`;

ALTER TABLE `S7UIEg_ncic_plates` MODIFY `flags` set('STOLEN','WANTED','SUSPENDED REGISTRATION','CANCELED REGISTRATION','EXPIRED REGISTRATION','INSURANCE FLAG','DRIVER FLAG','NO INSURANCE') AFTER `veh_insurance type`;

ALTER TABLE `S7UIEg_ncic_plates` MODIFY `veh_reg_state` set('Los Santos','Blaine County','San Andreas') AFTER `flags`;

DROP TABLE IF EXISTS
    `S7UIEg_permissions`;
DROP TABLE IF EXISTS
    `S7UIEg_codes`;
DROP TABLE IF EXISTS
    `permissions`;
DROP TABLE IF EXISTS
    `codes`;