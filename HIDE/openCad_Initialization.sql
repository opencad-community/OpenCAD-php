CREATE DATABASE IF NOT EXISTS "opencad";
USE "opencad";

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for active_users
-- ----------------------------
DROP TABLE IF EXISTS `active_users`;
CREATE TABLE `active_users`  (
  `identifier` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `callsign` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'Unit Callsign',
  `status` int(11) NOT NULL COMMENT 'Unit status, 0=busy/unavailable, 1=available, 2=dispatcher',
  `status_detail` int(11) NOT NULL COMMENT 'Paired to Statuses table',
  PRIMARY KEY (`identifier`) USING BTREE,
  UNIQUE INDEX `callsign`(`callsign`) USING BTREE,
  UNIQUE INDEX `identifier`(`identifier`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for call_history
-- ----------------------------
DROP TABLE IF EXISTS `call_history`;
CREATE TABLE `call_history`  (
  `call_id` int(11) NOT NULL,
  `call_primary` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `call_type` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `call_street1` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `call_street2` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `call_street3` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `call_notes` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`call_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for calls
-- ----------------------------
DROP TABLE IF EXISTS `calls`;
CREATE TABLE `calls`  (
  `call_id` int(4) NOT NULL AUTO_INCREMENT,
  `call_type` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `call_primary` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `call_street1` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `call_street2` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `call_street3` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `call_notes` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`call_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for calls_users
-- ----------------------------
DROP TABLE IF EXISTS `calls_users`;
CREATE TABLE `calls_users`  (
  `call_id` int(11) NOT NULL,
  `identifier` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`call_id`, `identifier`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for citations
-- ----------------------------
DROP TABLE IF EXISTS `citations`;
CREATE TABLE `citations`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `citation_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `citation_name`(`citation_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for civilian_names
-- ----------------------------
DROP TABLE IF EXISTS `civilian_names`;
CREATE TABLE `civilian_names`  (
  `user_id` int(11) NOT NULL COMMENT 'Links to users table',
  `names_id` int(11) NOT NULL COMMENT 'Links to names table',
  PRIMARY KEY (`user_id`, `names_id`) USING BTREE,
  UNIQUE INDEX `names_id`(`names_id`) USING BTREE,
  CONSTRAINT `Name ID` FOREIGN KEY (`names_id`) REFERENCES `ncic_names` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `User ID` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for codes
-- ----------------------------
DROP TABLE IF EXISTS `codes`;
CREATE TABLE `codes`  (
  `code_id` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `code_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`code_id`) USING BTREE,
  UNIQUE INDEX `code_name`(`code_name`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Table for 10 codes and their english meaning' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for departments
-- ----------------------------
DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments`  (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`department_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of departments
-- ----------------------------
INSERT INTO `departments` VALUES (0, 'Head Administrators');
INSERT INTO `departments` VALUES (1, 'Communications');
INSERT INTO `departments` VALUES (2, 'EMS');
INSERT INTO `departments` VALUES (3, 'Fire');
INSERT INTO `departments` VALUES (4, 'Highway');
INSERT INTO `departments` VALUES (5, 'Police');
INSERT INTO `departments` VALUES (6, 'Sheriff');
INSERT INTO `departments` VALUES (7, 'Civilian');
INSERT INTO `departments` VALUES (8, 'Admins');

-- ----------------------------
-- Table structure for identity_requests
-- ----------------------------
DROP TABLE IF EXISTS `identity_requests`;
CREATE TABLE `identity_requests`  (
  `req_id` int(11) NOT NULL AUTO_INCREMENT,
  `submittedByName` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `submittedById` int(20) DEFAULT NULL,
  `first_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `sex` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `race` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `hair_color` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `build` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `biography` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `veh_plate` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `veh_make` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `veh_model` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `veh_color` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `submitted_on` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  PRIMARY KEY (`req_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of identity_requests
-- ----------------------------
INSERT INTO `identity_requests` VALUES (1, 'Testy Test', 23, 'Erik', 'Glockenspiel', '1999-05-20', '3201 Fuck St.', 'Female', 'Asian', 'Black', 'Fit', 'fafafsdaf', 'aaaaaaa', 'aaaaaa', 'aaaaaaa', 'Red', NULL);
INSERT INTO `identity_requests` VALUES (2, 'Testy Test', 23, 'Test', 'Test2', '1997-02-02', '222 Test Ave', 'Female', 'American Indian or Alaskan Native', 'Black', 'Fit', 'sdadadad sfsFMQK MFEQK  KMQ K Q', 'DDDD', 'DDDD', 'DDDD', 'Multi-Colored', NULL);

-- ----------------------------
-- Table structure for ncic_citations
-- ----------------------------
DROP TABLE IF EXISTS `ncic_citations`;
CREATE TABLE `ncic_citations`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0 = Pending, 1 = Approved/Active',
  `name_id` int(11) NOT NULL COMMENT 'Paired to ID of ncic_names table',
  `citation_name` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `issued_date` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `issued_by` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `name_id`(`name_id`) USING BTREE,
  INDEX `status`(`status`) USING BTREE,
  CONSTRAINT `Name` FOREIGN KEY (`name_id`) REFERENCES `ncic_names` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ncic_names
-- ----------------------------
DROP TABLE IF EXISTS `ncic_names`;
CREATE TABLE `ncic_names`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `dob` date NOT NULL COMMENT 'Date of birth',
  `address` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `sex` set('Male','Female') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `race` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `dl_status` set('Valid','Suspended','Expired') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `hair_color` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `build` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id_UNIQUE`(`id`) USING BTREE,
  UNIQUE INDEX `first_name`(`first_name`, `last_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 175 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ncic_plates
-- ----------------------------
DROP TABLE IF EXISTS `ncic_plates`;
CREATE TABLE `ncic_plates`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_id` int(11) NOT NULL COMMENT 'Links to ncic_names db for driver information',
  `veh_plate` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `veh_make` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `veh_model` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `veh_color` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `veh_insurance` set('VALID','EXPIRED') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'VALID',
  `flags` set('NONE','STOLEN','WANTED','SUSPENDED REGISTRATION','UC FLAG','HPIU FLAG') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'NONE',
  `veh_reg_state` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `notes` text CHARACTER SET latin1 COLLATE latin1_swedish_ci COMMENT 'Any special flags visible to dispatchers',
  `hidden_notes` text CHARACTER SET latin1 COLLATE latin1_swedish_ci COMMENT 'Notes only visible in the admin panel',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `veh_plate`(`veh_plate`(55)) USING BTREE,
  INDEX `name_id`(`name_id`) USING BTREE,
  CONSTRAINT `Name Pair` FOREIGN KEY (`name_id`) REFERENCES `ncic_names` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 74 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ncic_warrants
-- ----------------------------
DROP TABLE IF EXISTS `ncic_warrants`;
CREATE TABLE `ncic_warrants`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_id` int(11) NOT NULL COMMENT 'Key that pairs to the ncic_name id',
  `issued_date` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expiration_date` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `warrant_name` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `issuing_agency` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` set('Active','Served') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `name_id`(`name_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `perm_id` int(11) NOT NULL,
  `perm_desc` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`perm_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ranks
-- ----------------------------
DROP TABLE IF EXISTS `ranks`;
CREATE TABLE `ranks`  (
  `rank_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rank_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `can_select` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`rank_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 105 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ranks_users
-- ----------------------------
DROP TABLE IF EXISTS `ranks_users`;
CREATE TABLE `ranks_users`  (
  `user_id` int(11) NOT NULL,
  `rank_id` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`) USING BTREE,
  UNIQUE INDEX `user_id`(`user_id`) USING BTREE,
  UNIQUE INDEX `user_id_2`(`user_id`) USING BTREE,
  INDEX `rank_id`(`rank_id`) USING BTREE,
  CONSTRAINT `Ranks` FOREIGN KEY (`rank_id`) REFERENCES `ranks` (`rank_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for statuses
-- ----------------------------
DROP TABLE IF EXISTS `statuses`;
CREATE TABLE `statuses`  (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_text` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`status_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for streets
-- ----------------------------
DROP TABLE IF EXISTS `streets`;
CREATE TABLE `streets`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key for each street',
  `name` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'Street name',
  `county` set('Los Santos County','Blaine County','State') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'County name',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name`(`name`(767)) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 363 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tones
-- ----------------------------
DROP TABLE IF EXISTS `tones`;
CREATE TABLE `tones`  (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `active` set('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0' COMMENT '0 = inactive, 1 = active',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name`(`name`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Tones table. DO NOT ADD ROWS TO THIS TABLE' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for user_departments
-- ----------------------------
DROP TABLE IF EXISTS `user_departments`;
CREATE TABLE `user_departments`  (
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`, `department_id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  INDEX `department_id`(`department_id`) USING BTREE,
  CONSTRAINT `Department` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user_departments
-- ----------------------------
INSERT INTO `user_departments` VALUES (21, 0);
INSERT INTO `user_departments` VALUES (21, 1);
INSERT INTO `user_departments` VALUES (21, 2);
INSERT INTO `user_departments` VALUES (21, 3);
INSERT INTO `user_departments` VALUES (21, 4);
INSERT INTO `user_departments` VALUES (21, 5);
INSERT INTO `user_departments` VALUES (21, 6);
INSERT INTO `user_departments` VALUES (21, 7);
INSERT INTO `user_departments` VALUES (21, 8);
INSERT INTO `user_departments` VALUES (22, 7);
INSERT INTO `user_departments` VALUES (23, 7);

-- ----------------------------
-- Table structure for user_departments_temp
-- ----------------------------
DROP TABLE IF EXISTS `user_departments_temp`;
CREATE TABLE `user_departments_temp`  (
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'Temporary table - stores user departments for non-approved users' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user_departments_temp
-- ----------------------------
INSERT INTO `user_departments_temp` VALUES (21, 7);
INSERT INTO `user_departments_temp` VALUES (21, 1);
INSERT INTO `user_departments_temp` VALUES (21, 5);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `identifier` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `password_reset` int(1) NOT NULL DEFAULT 0 COMMENT '1 means password reset required. 0 means it\'s not.',
  `approved` int(1) NOT NULL DEFAULT 0 COMMENT 'Three main statuses: 0 means pending approval. 1 means has access. 2 means banned',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE,
  UNIQUE INDEX `identifier`(`identifier`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'User table' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (13, 'Test A', 'test@test.test', '$2y$10$VzaFECcy6hb2df5leNEyTOcBo4DbZkhieiglLCcdqwE8Vp1YXn/R6', '1A-99', 0, 1);
INSERT INTO `users` VALUES (21, 'Default Admin', 'admin@test.com', '$2y358c8c0e878fbf15371b5e557876cac8', '1A-98', 0, 1);

SET FOREIGN_KEY_CHECKS = 1;
