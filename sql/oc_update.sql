-- Last updated for OpenCAD 0.2.6

CREATE TABLE IF NOT EXISTS  `<DB_PREFIX>citation_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `citation_description` varchar(255) NOT NULL COMMENT 'Description of an often issued citation.',
  `citation_fine` decimal(19,2) NOT NULL COMMENT 'Reccomended fine for given citation.', 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS  `<DB_PREFIX>incident_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_id` varchar(255) NOT NULL DEFAULT 'Radio code for given incident type.',
  `code_name` varchar(255) NOT NULL COMMENT 'Name or description of incident.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS  `<DB_PREFIX>radio_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL COMMENT 'Radio code for statuses.', 
  `code_description` varchar(255) NOT NULL COMMENT 'Descriptio of status code.',
  `onCall` int(11) NOT NUL COMMENT 'Execute onCall to clear unit from a call.'L,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS  `<DB_PREFIX>warning_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `warning_description` varchar(255) NOT NULL `citation_fine` decimal(19,2) NOT NULL COMMENT 'Description of a frequently used warning type.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `<DB_PREFIX>warrant_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `warrant_description` varchar(255) NOT NULL COMMENT 'Description of a frequently used warrant type.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `<DB_PREFIX>permissions`;
DROP TABLE IF EXISTS `<DB_PREFIX>codes`;
DROP TABLE IF EXISTS `permissions`;
DROP TABLE IF EXISTS `codes`;