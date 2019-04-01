-- Last updated for OpenCAD 0.2.6
CREATE TABLE IF NOT EXISTS `wizard_citation_types`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `citation_description` VARCHAR(255) NOT NULL COMMENT 'Description of an often issued citation.',
    `citation_fine` DECIMAL(19, 2) NOT NULL COMMENT 'Reccomended fine for given citation.',
    PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1; CREATE TABLE IF NOT EXISTS `wizard_incident_types`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `code_id` VARCHAR(255) NOT NULL DEFAULT 'Radio code for given incident type.',
    `code_name` VARCHAR(255) NOT NULL COMMENT 'Name or description of incident.',
    PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1; CREATE TABLE IF NOT EXISTS `wizard_radio_codes`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(10) NOT NULL COMMENT 'Radio code for statuses.',
    `code_description` VARCHAR(255) NOT NULL COMMENT 'Descriptio of status code.',
    `onCall` INT(11) NOT NULL COMMENT 'Execute onCall to clear unit from a call.',
    PRIMARY KEY(`id`),
    UNIQUE KEY `code`(`code`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1; CREATE TABLE IF NOT EXISTS `wizard_warning_types`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `warning_description` VARCHAR(255) NOT NULL,
    `citation_fine` DECIMAL(19, 2) NOT NULL COMMENT 'Description of a frequently used warning type.',
    PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1; CREATE TABLE IF NOT EXISTS `wizard_warrant_types`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `warrant_description` VARCHAR(255) NOT NULL COMMENT 'Description of a frequently used warrant type.',
    PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1; ALTER TABLE
    `wizard_ncic_names` MODIFY `dl_type`
SET
    (
        'Not Issued',
        'Learners',
        'Provisional',
        'Open',
        'Identification Only'
    ) NOT NULL AFTER 'dl_status';
ALTER TABLE
    `wizard_ncic_names` MODIFY `dl_class`
SET
    (
        'Car',
        'Light Rig',
        'Heavy Rig',
        'Boat',
        'Motorbike',
        'Military'
    ) NOT NULL AFTER `dl_type`;
ALTER TABLE
    `wizard_ncic_names` MODIFY `dl_Issued_by`
SET
    ('Government', 'Military') NOT NULL AFTER 'dl_class';
DROP TABLE IF EXISTS
    `wizard_permissions`;
DROP TABLE IF EXISTS
    `wizard_codes`;
DROP TABLE IF EXISTS
    `permissions`;
DROP TABLE IF EXISTS
    `codes`;