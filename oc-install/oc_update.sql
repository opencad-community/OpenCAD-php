-- Last updated for OpenCAD 1.0

UPDATE `<DB_PREFIX>warrantTypes` SET `warrantType` = 1 WHERE `warrantType` = "Violent";
UPDATE `<DB_PREFIX>warrantTypes` SET `warrantType` = 0 WHERE `warrantType` = "Non-Violent";
ALTER TABLE `<DB_PREFIX>warrantTypes` ADD COLUMN `warrantViolent` int(1) NOT NULL AFTER `id`;

ALTER TABLE `<DB_PREFIX>citationTypes` CHANGE COLUMN `id` `citationId` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `<DB_PREFIX>users` DROP COLUMN `passwordReset`;