-- Last updated for OpenCAD 0.2.6
CREATE TABLE IF NOT EXISTS `wizard_citation_types`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `citation_description` VARCHAR(255) NOT NULL COMMENT 'Description of an often issued citation.',
    `citation_fine` DECIMAL(19, 2) NOT NULL COMMENT 'Reccomended fine for given citation.',
    PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

CREATE TABLE IF NOT EXISTS `wizard_incident_types`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `code_id` VARCHAR(255) NOT NULL DEFAULT 'Radio code for given incident type.',
    `code_name` VARCHAR(255) NOT NULL COMMENT 'Name or description of incident.',
    PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1; 

CREATE TABLE IF NOT EXISTS `wizard_radio_codes`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(10) NOT NULL COMMENT 'Radio code for statuses.',
    `code_description` VARCHAR(255) NOT NULL COMMENT 'Descriptio of status code.',
    `onCall` INT(11) NOT NULL COMMENT 'Execute onCall to clear unit from a call.',
    PRIMARY KEY(`id`),
    UNIQUE KEY `code`(`code`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

CREATE TABLE IF NOT EXISTS `wizard_warning_types`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `warning_description` VARCHAR(255) NOT NULL,
    `citation_fine` DECIMAL(19, 2) NOT NULL COMMENT 'Description of a frequently used warning type.',
    PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1; 

CREATE TABLE IF NOT EXISTS `wizard_warrant_types`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `warrant_description` VARCHAR(255) NOT NULL COMMENT 'Description of a frequently used warrant type.',
    PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1; 

  ALTER TABLE `wizard_ncic_names` MODIFY IF EXISTS `dl_type`
set('Not Issued','Learners','Provisional','Open','Identification Only') NOT NULL AFTER `dl_status`;

  ALTER TABLE `wizard_ncic_names` MODIFY IF EXISTS `dl_class`
  set('Car','Light Rig','Heavy Rig','Boat','Motorbike','Military') NOT NULL AFTER `dl_type`;

  ALTER TABLE `wizard_ncic_names` MODIFY IF EXISTS `dl_issuer`
  set('Government','Military') NOT NULL AFTER `dl_class`;

  ALTER TABLE `wizard_ncic_names` MODIFY IF EXISTS `weapon_permit`
  set('Unobtained','Vaild','Suspended','Expired','Canceled') NOT NULL AFTER `build`;

  ALTER TABLE `wizard_ncic_names` MODIFY IF EXISTS `weapon_permit_type`
  set('Small Arms','Specialised Weapon','Automatic Weapon','Semi-Automatic','Military Grade') NOT NULL AFTER `weapon_permit`;

  ALTER TABLE `wizard_ncic_names` MODIFY IF EXISTS `weapon_permit_Issued_by`
  set('Ammu-Nation','Government','Military') NOT NULL AFTER `weapon_permit_type`;

  ALTER TABLE `wizard_ncic_names` MODIFY IF EXISTS `deceased`
  set('NO','YES') NOT NULL AFTER `weapon_permit_Issued_by`;

  ALTER TABLE `wizard_ncic_plates` MODIFY IF EXISTS `veh_insurance`
  set('VALID','EXPIRED','CANCELED','SUSPENDED') NOT NULL AFTER `veh_scolor`;

  ALTER TABLE `wizard_ncic_plates` MODIFY IF EXISTS `veh_insurance type`
  set('CTP','Third Party','Comprehensive') NOT NULL AFTER `veh_insurance`;

  ALTER TABLE `wizard_ncic_plates` MODIFY IF EXISTS `flags`
  set('STOLEN','WANTED','SUSPENDED REGISTRATION','CANCELED REGISTRATION','EXPIRED REGISTRATION','INSURANCE FLAG','DL FLAG') NOT NULL AFTER `veh_insurance type`;

  ALTER TABLE `wizard_ncic_plates` MODIFY IF EXISTS `veh_reg_state`
  set('Los Santos','Blaine County','San Andreas') NOT NULL AFTER `flags`;

DROP TABLE IF EXISTS
    `wizard_permissions`;
DROP TABLE IF EXISTS
    `wizard_codes`;
DROP TABLE IF EXISTS
    `permissions`;
DROP TABLE IF EXISTS
    `codes`;