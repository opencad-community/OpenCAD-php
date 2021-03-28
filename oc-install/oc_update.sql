-- Last updated for OpenCAD 0.3.1

UPDATE `<DB_PREFIX>warrant_types` SET `warrant_type` = 1 WHERE `warrant_type` = "Violent";
UPDATE `<DB_PREFIX>warrant_types` SET `warrant_type` = 0 WHERE `warrant_type` = "Non-Violent";
ALTER TABLE `<DB_PREFIX>warrant_types` ADD COLUMN `warrant_violent` int(1) NOT NULL AFTER `id`;

ALTER TABLE `<DB_PREFIX>citation_types` CHANGE COLUMN `id` `citation_id` int(11) NOT NULL AUTO_INCREMENT;