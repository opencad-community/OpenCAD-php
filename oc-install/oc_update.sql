-- Last updated for OpenCAD 0.3.1

UPDATE `<DB_PREFIX>warrantTypes` SET `warrantType` = 1 WHERE `warrantType` = "Violent";
UPDATE `<DB_PREFIX>warrantTypes` SET `warrantType` = 0 WHERE `warrantType` = "Non-Violent";
ALTER TABLE `<DB_PREFIX>warrantTypes` ADD COLUMN `warrantViolent` int(1) NOT NULL AFTER `id`;

ALTER TABLE `<DB_PREFIX>citationTypes` CHANGE COLUMN `id` `citationId` int(11) NOT NULL AUTO_INCREMENT;