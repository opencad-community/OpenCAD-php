CREATE DATABASE IF NOT EXISTS `opencad` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `opencad`;

-- --------------------------------------------------------

--
-- Table structure for table `active_users`
--

CREATE TABLE `active_users` (
  `identifier` varchar(255) NOT NULL,
  `callsign` varchar(255) NOT NULL COMMENT 'Unit Callsign',
  `status` int(11) NOT NULL COMMENT 'Unit status, 0=busy/unavailable, 1=available, 2=dispatcher',
  `status_detail` int(11) NOT NULL COMMENT 'Paired to Statuses table'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `call_history`
--

CREATE TABLE `call_history` (
  `call_id` int(11) NOT NULL,
  `call_primary` text NOT NULL,
  `call_type` text NOT NULL,
  `call_street1` text NOT NULL,
  `call_street2` text,
  `call_street3` text,
  `call_notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `calls`
--

CREATE TABLE `calls` (
  `call_id` int(4) NOT NULL,
  `call_type` text NOT NULL,
  `call_primary` text NOT NULL,
  `call_street1` text NOT NULL,
  `call_street2` text,
  `call_street3` text,
  `call_notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `calls_users`
--

CREATE TABLE `calls_users` (
  `call_id` int(11) NOT NULL,
  `identifier` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `citations`
--

CREATE TABLE `citations` (
  `id` int(11) NOT NULL,
  `citation_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `civilian_names`
--

CREATE TABLE `civilian_names` (
  `user_id` int(11) NOT NULL COMMENT 'Links to users table',
  `names_id` int(11) NOT NULL COMMENT 'Links to names table'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `codes`
--

CREATE TABLE `codes` (
  `code_id` varchar(11) NOT NULL DEFAULT '',
  `code_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Table for 10 codes and their english meaning' ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`) VALUES
(0, 'Head Administrators'),
(1, 'Communications'),
(2, 'EMS'),
(3, 'Fire'),
(4, 'Highway'),
(5, 'Police'),
(6, 'Sheriff'),
(7, 'Civilian'),
(8, 'Admins');

-- --------------------------------------------------------

--
-- Table structure for table `identity_requests`
--

CREATE TABLE `identity_requests` (
  `req_id` int(11) NOT NULL,
  `submittedByName` varchar(255) DEFAULT NULL,
  `submittedById` int(20) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` text,
  `sex` text,
  `race` text,
  `hair_color` text,
  `build` text,
  `biography` text,
  `veh_plate` text,
  `veh_make` text,
  `veh_model` text,
  `veh_color` text,
  `submitted_on` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `identity_requests`
--

INSERT INTO `identity_requests` (`req_id`, `submittedByName`, `submittedById`, `first_name`, `last_name`, `dob`, `address`, `sex`, `race`, `hair_color`, `build`, `biography`, `veh_plate`, `veh_make`, `veh_model`, `veh_color`, `submitted_on`) VALUES
(1, 'Testy Test', 23, 'Erik', 'Glockenspiel', '1999-05-20', '3201 Fuck St.', 'Female', 'Asian', 'Black', 'Fit', 'fafafsdaf', 'aaaaaaa', 'aaaaaa', 'aaaaaaa', 'Red', NULL),
(2, 'Testy Test', 23, 'Test', 'Test2', '1997-02-02', '222 Test Ave', 'Female', 'American Indian or Alaskan Native', 'Black', 'Fit', 'sdadadad sfsFMQK MFEQK  KMQ K Q', 'DDDD', 'DDDD', 'DDDD', 'Multi-Colored', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ncic_citations`
--

CREATE TABLE `ncic_citations` (
  `id` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 = Pending, 1 = Approved/Active',
  `name_id` int(11) NOT NULL COMMENT 'Paired to ID of ncic_names table',
  `citation_name` text NOT NULL,
  `issued_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `issued_by` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `ncic_names`
--

CREATE TABLE `ncic_names` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `dob` date NOT NULL COMMENT 'Date of birth',
  `address` text NOT NULL,
  `sex` set('Male','Female') NOT NULL,
  `race` text NOT NULL,
  `dl_status` set('Valid','Suspended','Expired') NOT NULL,
  `hair_color` text NOT NULL,
  `build` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `ncic_plates`
--

CREATE TABLE `ncic_plates` (
  `id` int(11) NOT NULL,
  `name_id` int(11) NOT NULL COMMENT 'Links to ncic_names db for driver information',
  `veh_plate` text NOT NULL,
  `veh_make` text NOT NULL,
  `veh_model` text NOT NULL,
  `veh_color` text NOT NULL,
  `veh_insurance` set('VALID','EXPIRED') NOT NULL DEFAULT 'VALID',
  `flags` set('NONE','STOLEN','WANTED','SUSPENDED REGISTRATION','UC FLAG','HPIU FLAG') NOT NULL DEFAULT 'NONE',
  `veh_reg_state` text NOT NULL,
  `notes` text COMMENT 'Any special flags visible to dispatchers',
  `hidden_notes` text COMMENT 'Notes only visible in the admin panel'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `ncic_warrants`
--

CREATE TABLE `ncic_warrants` (
  `id` int(11) NOT NULL,
  `name_id` int(11) NOT NULL COMMENT 'Key that pairs to the ncic_name id',
  `issued_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expiration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `warrant_name` text NOT NULL,
  `issuing_agency` text NOT NULL,
  `status` set('Active','Served') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `perm_id` int(11) NOT NULL,
  `perm_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `ranks`
--

CREATE TABLE `ranks` (
  `rank_id` int(11) UNSIGNED NOT NULL,
  `rank_name` varchar(255) NOT NULL,
  `can_select` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `ranks_users`
--

CREATE TABLE `ranks_users` (
  `user_id` int(11) NOT NULL,
  `rank_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `status_id` int(11) NOT NULL,
  `status_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `streets`
--

CREATE TABLE `streets` (
  `id` int(11) NOT NULL COMMENT 'Primary key for each street',
  `name` text NOT NULL COMMENT 'Street name',
  `county` set('Los Santos County','Blaine County','State') NOT NULL COMMENT 'County name'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `tones`
--

CREATE TABLE `tones` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` set('0','1') NOT NULL DEFAULT '0' COMMENT '0 = inactive, 1 = active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tones table. DO NOT ADD ROWS TO THIS TABLE' ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `user_departments`
--

CREATE TABLE `user_departments` (
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user_departments`
--

INSERT INTO `user_departments` (`user_id`, `department_id`) VALUES
(21, 0),
(21, 1),
(21, 2),
(21, 3),
(21, 4),
(21, 5),
(21, 6),
(21, 7),
(21, 8),
(22, 7),
(23, 7);

-- --------------------------------------------------------

--
-- Table structure for table `user_departments_temp`
--

CREATE TABLE `user_departments_temp` (
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Temporary table - stores user departments for non-approved users' ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user_departments_temp`
--

INSERT INTO `user_departments_temp` (`user_id`, `department_id`) VALUES
(21, 7),
(21, 1),
(21, 5),
(24, 1),
(26, 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text,
  `identifier` varchar(255) DEFAULT NULL,
  `password_reset` int(1) NOT NULL DEFAULT '0' COMMENT '1 means password reset required. 0 means it''s not.',
  `approved` int(1) NOT NULL DEFAULT '0' COMMENT 'Three main statuses: 0 means pending approval. 1 means has access. 2 means banned'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='User table' ROW_FORMAT=COMPACT;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `identifier`, `password_reset`, `approved`) VALUES
(13, 'Test A', 'test@test.test', '$2y$10$VzaFECcy6hb2df5leNEyTOcBo4DbZkhieiglLCcdqwE8Vp1YXn/R6', '1A-99', 0, 1),
(21, 'Default Admin', 'admin@test.com', '$2y$10$xHvogGcqQs8jhTPbFEDHJO9KWu2FCLgJ5XGxH.hHMA0BY1brgCkSG', '1A-98', 0, 1),
(24, 'Test', 'phillfernandes92@gmail.com', '$2y$10$IzhB4DWb8gOIHMcP2v2rDelv59bUZGTZHcS2h3hR9.cm7qUQv2m12', 'AA', 0, 0),
(26, 'test', 'test@test.com', '$2y$10$xHvogGcqQs8jhTPbFEDHJO9KWu2FCLgJ5XGxH.hHMA0BY1brgCkSG', 'aaa', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_users`
--
ALTER TABLE `active_users`
  ADD PRIMARY KEY (`identifier`) USING BTREE,
  ADD UNIQUE KEY `callsign` (`callsign`) USING BTREE,
  ADD UNIQUE KEY `identifier` (`identifier`) USING BTREE;

--
-- Indexes for table `call_history`
--
ALTER TABLE `call_history`
  ADD PRIMARY KEY (`call_id`) USING BTREE;

--
-- Indexes for table `calls`
--
ALTER TABLE `calls`
  ADD PRIMARY KEY (`call_id`) USING BTREE;

--
-- Indexes for table `calls_users`
--
ALTER TABLE `calls_users`
  ADD PRIMARY KEY (`call_id`,`identifier`) USING BTREE;

--
-- Indexes for table `citations`
--
ALTER TABLE `citations`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `citation_name` (`citation_name`) USING BTREE;

--
-- Indexes for table `civilian_names`
--
ALTER TABLE `civilian_names`
  ADD PRIMARY KEY (`user_id`,`names_id`) USING BTREE,
  ADD UNIQUE KEY `names_id` (`names_id`) USING BTREE;

--
-- Indexes for table `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`code_id`) USING BTREE,
  ADD UNIQUE KEY `code_name` (`code_name`) USING BTREE;

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`) USING BTREE;

--
-- Indexes for table `identity_requests`
--
ALTER TABLE `identity_requests`
  ADD PRIMARY KEY (`req_id`) USING BTREE;

--
-- Indexes for table `ncic_citations`
--
ALTER TABLE `ncic_citations`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `name_id` (`name_id`) USING BTREE,
  ADD KEY `status` (`status`) USING BTREE;

--
-- Indexes for table `ncic_names`
--
ALTER TABLE `ncic_names`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD UNIQUE KEY `first_name` (`first_name`,`last_name`) USING BTREE;

--
-- Indexes for table `ncic_plates`
--
ALTER TABLE `ncic_plates`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `veh_plate` (`veh_plate`(55)) USING BTREE,
  ADD KEY `name_id` (`name_id`) USING BTREE;

--
-- Indexes for table `ncic_warrants`
--
ALTER TABLE `ncic_warrants`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `name_id` (`name_id`) USING BTREE;

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`perm_id`) USING BTREE;

--
-- Indexes for table `ranks`
--
ALTER TABLE `ranks`
  ADD PRIMARY KEY (`rank_id`) USING BTREE;

--
-- Indexes for table `ranks_users`
--
ALTER TABLE `ranks_users`
  ADD PRIMARY KEY (`user_id`) USING BTREE,
  ADD UNIQUE KEY `user_id` (`user_id`) USING BTREE,
  ADD UNIQUE KEY `user_id_2` (`user_id`) USING BTREE,
  ADD KEY `rank_id` (`rank_id`) USING BTREE;

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`status_id`) USING BTREE;

--
-- Indexes for table `streets`
--
ALTER TABLE `streets`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `name` (`name`(767)) USING BTREE;

--
-- Indexes for table `tones`
--
ALTER TABLE `tones`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `name` (`name`) USING BTREE;

--
-- Indexes for table `user_departments`
--
ALTER TABLE `user_departments`
  ADD PRIMARY KEY (`user_id`,`department_id`) USING BTREE,
  ADD KEY `user_id` (`user_id`) USING BTREE,
  ADD KEY `department_id` (`department_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`) USING BTREE,
  ADD UNIQUE KEY `identifier` (`identifier`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calls`
--
ALTER TABLE `calls`
  MODIFY `call_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `citations`
--
ALTER TABLE `citations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `identity_requests`
--
ALTER TABLE `identity_requests`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ncic_citations`
--
ALTER TABLE `ncic_citations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `ncic_names`
--
ALTER TABLE `ncic_names`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;
--
-- AUTO_INCREMENT for table `ncic_plates`
--
ALTER TABLE `ncic_plates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `ncic_warrants`
--
ALTER TABLE `ncic_warrants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `ranks`
--
ALTER TABLE `ranks`
  MODIFY `rank_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `streets`
--
ALTER TABLE `streets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key for each street', AUTO_INCREMENT=363;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `civilian_names`
--
ALTER TABLE `civilian_names`
  ADD CONSTRAINT `Name ID` FOREIGN KEY (`names_id`) REFERENCES `ncic_names` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `User ID` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ncic_citations`
--
ALTER TABLE `ncic_citations`
  ADD CONSTRAINT `Name` FOREIGN KEY (`name_id`) REFERENCES `ncic_names` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ncic_plates`
--
ALTER TABLE `ncic_plates`
  ADD CONSTRAINT `Name Pair` FOREIGN KEY (`name_id`) REFERENCES `ncic_names` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ranks_users`
--
ALTER TABLE `ranks_users`
  ADD CONSTRAINT `Ranks` FOREIGN KEY (`rank_id`) REFERENCES `ranks` (`rank_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_departments`
--
ALTER TABLE `user_departments`
  ADD CONSTRAINT `Department` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Database: `opencad2`
--
CREATE DATABASE IF NOT EXISTS `opencad2` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `opencad2`;

-- --------------------------------------------------------

--
-- Table structure for table `active_users`
--

CREATE TABLE `active_users` (
  `identifier` varchar(255) NOT NULL,
  `callsign` varchar(255) NOT NULL COMMENT 'Unit Callsign',
  `status` int(11) NOT NULL COMMENT 'Unit status, 0=busy/unavailable, 1=available, 2=dispatcher',
  `status_detail` int(11) NOT NULL COMMENT 'Paired to Statuses table'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `active_users`
--

INSERT INTO `active_users` (`identifier`, `callsign`, `status`, `status_detail`) VALUES
('1A-98', '1A-98', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `call_history`
--

CREATE TABLE `call_history` (
  `call_id` int(11) NOT NULL,
  `call_primary` text NOT NULL,
  `call_type` text NOT NULL,
  `call_street1` text NOT NULL,
  `call_street2` text,
  `call_street3` text,
  `call_notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `calls`
--

CREATE TABLE `calls` (
  `call_id` int(4) NOT NULL,
  `call_type` text NOT NULL,
  `call_primary` text NOT NULL,
  `call_street1` text NOT NULL,
  `call_street2` text,
  `call_street3` text,
  `call_notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `calls_users`
--

CREATE TABLE `calls_users` (
  `call_id` int(11) NOT NULL,
  `identifier` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `citations`
--

CREATE TABLE `citations` (
  `id` int(11) NOT NULL,
  `citation_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `civilian_names`
--

CREATE TABLE `civilian_names` (
  `user_id` int(11) NOT NULL COMMENT 'Links to users table',
  `names_id` int(11) NOT NULL COMMENT 'Links to names table'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `codes`
--

CREATE TABLE `codes` (
  `code_id` varchar(11) NOT NULL DEFAULT '',
  `code_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Table for 10 codes and their english meaning' ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`) VALUES
(0, 'Head Administrators'),
(1, 'Communications'),
(2, 'EMS'),
(3, 'Fire'),
(4, 'Highway'),
(5, 'Police'),
(6, 'Sheriff'),
(7, 'Civilian'),
(8, 'Admins');

-- --------------------------------------------------------

--
-- Table structure for table `identity_requests`
--

CREATE TABLE `identity_requests` (
  `req_id` int(11) NOT NULL,
  `submittedByName` varchar(255) DEFAULT NULL,
  `submittedById` int(20) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` text,
  `sex` text,
  `race` text,
  `hair_color` text,
  `build` text,
  `biography` text,
  `veh_plate` text,
  `veh_make` text,
  `veh_model` text,
  `veh_color` text,
  `submitted_on` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `identity_requests`
--

INSERT INTO `identity_requests` (`req_id`, `submittedByName`, `submittedById`, `first_name`, `last_name`, `dob`, `address`, `sex`, `race`, `hair_color`, `build`, `biography`, `veh_plate`, `veh_make`, `veh_model`, `veh_color`, `submitted_on`) VALUES
(1, 'Testy Test', 23, 'Erik', 'Glockenspiel', '1999-05-20', '3201 Fuck St.', 'Female', 'Asian', 'Black', 'Fit', 'fafafsdaf', 'aaaaaaa', 'aaaaaa', 'aaaaaaa', 'Red', NULL),
(2, 'Testy Test', 23, 'Test', 'Test2', '1997-02-02', '222 Test Ave', 'Female', 'American Indian or Alaskan Native', 'Black', 'Fit', 'sdadadad sfsFMQK MFEQK  KMQ K Q', 'DDDD', 'DDDD', 'DDDD', 'Multi-Colored', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ncic_citations`
--

CREATE TABLE `ncic_citations` (
  `id` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 = Pending, 1 = Approved/Active',
  `name_id` int(11) NOT NULL COMMENT 'Paired to ID of ncic_names table',
  `citation_name` text NOT NULL,
  `issued_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `issued_by` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `ncic_names`
--

CREATE TABLE `ncic_names` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `dob` date NOT NULL COMMENT 'Date of birth',
  `address` text NOT NULL,
  `sex` set('Male','Female') NOT NULL,
  `race` text NOT NULL,
  `dl_status` set('Valid','Suspended','Expired') NOT NULL,
  `hair_color` text NOT NULL,
  `build` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `ncic_plates`
--

CREATE TABLE `ncic_plates` (
  `id` int(11) NOT NULL,
  `name_id` int(11) NOT NULL COMMENT 'Links to ncic_names db for driver information',
  `veh_plate` text NOT NULL,
  `veh_make` text NOT NULL,
  `veh_model` text NOT NULL,
  `veh_color` text NOT NULL,
  `veh_insurance` set('VALID','EXPIRED') NOT NULL DEFAULT 'VALID',
  `flags` set('NONE','STOLEN','WANTED','SUSPENDED REGISTRATION','UC FLAG','HPIU FLAG') NOT NULL DEFAULT 'NONE',
  `veh_reg_state` text NOT NULL,
  `notes` text COMMENT 'Any special flags visible to dispatchers',
  `hidden_notes` text COMMENT 'Notes only visible in the admin panel'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `ncic_warrants`
--

CREATE TABLE `ncic_warrants` (
  `id` int(11) NOT NULL,
  `name_id` int(11) NOT NULL COMMENT 'Key that pairs to the ncic_name id',
  `issued_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expiration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `warrant_name` text NOT NULL,
  `issuing_agency` text NOT NULL,
  `status` set('Active','Served') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `perm_id` int(11) NOT NULL,
  `perm_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `ranks`
--

CREATE TABLE `ranks` (
  `rank_id` int(11) UNSIGNED NOT NULL,
  `rank_name` varchar(255) NOT NULL,
  `can_select` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `ranks_users`
--

CREATE TABLE `ranks_users` (
  `user_id` int(11) NOT NULL,
  `rank_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `status_id` int(11) NOT NULL,
  `status_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `streets`
--

CREATE TABLE `streets` (
  `id` int(11) NOT NULL COMMENT 'Primary key for each street',
  `name` text NOT NULL COMMENT 'Street name',
  `county` set('Los Santos County','Blaine County','State') NOT NULL COMMENT 'County name'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `tones`
--

CREATE TABLE `tones` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` set('0','1') NOT NULL DEFAULT '0' COMMENT '0 = inactive, 1 = active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tones table. DO NOT ADD ROWS TO THIS TABLE' ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `user_departments`
--

CREATE TABLE `user_departments` (
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user_departments`
--

INSERT INTO `user_departments` (`user_id`, `department_id`) VALUES
(21, 0),
(21, 1),
(21, 2),
(21, 3),
(21, 4),
(21, 5),
(21, 6),
(21, 7),
(21, 8);

-- --------------------------------------------------------

--
-- Table structure for table `user_departments_temp`
--

CREATE TABLE `user_departments_temp` (
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Temporary table - stores user departments for non-approved users' ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user_departments_temp`
--

INSERT INTO `user_departments_temp` (`user_id`, `department_id`) VALUES
(21, 7),
(21, 1),
(21, 5),
(24, 1),
(26, 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text,
  `identifier` varchar(255) DEFAULT NULL,
  `password_reset` int(1) NOT NULL DEFAULT '0' COMMENT '1 means password reset required. 0 means it''s not.',
  `approved` int(1) NOT NULL DEFAULT '0' COMMENT 'Three main statuses: 0 means pending approval. 1 means has access. 2 means banned'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='User table' ROW_FORMAT=COMPACT;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `identifier`, `password_reset`, `approved`) VALUES
(21, 'Default Admin', 'admin@test.com', '$2y$10$xHvogGcqQs8jhTPbFEDHJO9KWu2FCLgJ5XGxH.hHMA0BY1brgCkSG', '1A-98', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_users`
--
ALTER TABLE `active_users`
  ADD PRIMARY KEY (`identifier`) USING BTREE,
  ADD UNIQUE KEY `callsign` (`callsign`) USING BTREE,
  ADD UNIQUE KEY `identifier` (`identifier`) USING BTREE;

--
-- Indexes for table `call_history`
--
ALTER TABLE `call_history`
  ADD PRIMARY KEY (`call_id`) USING BTREE;

--
-- Indexes for table `calls`
--
ALTER TABLE `calls`
  ADD PRIMARY KEY (`call_id`) USING BTREE;

--
-- Indexes for table `calls_users`
--
ALTER TABLE `calls_users`
  ADD PRIMARY KEY (`call_id`,`identifier`) USING BTREE;

--
-- Indexes for table `citations`
--
ALTER TABLE `citations`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `citation_name` (`citation_name`) USING BTREE;

--
-- Indexes for table `civilian_names`
--
ALTER TABLE `civilian_names`
  ADD PRIMARY KEY (`user_id`,`names_id`) USING BTREE,
  ADD UNIQUE KEY `names_id` (`names_id`) USING BTREE;

--
-- Indexes for table `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`code_id`) USING BTREE,
  ADD UNIQUE KEY `code_name` (`code_name`) USING BTREE;

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`) USING BTREE;

--
-- Indexes for table `identity_requests`
--
ALTER TABLE `identity_requests`
  ADD PRIMARY KEY (`req_id`) USING BTREE;

--
-- Indexes for table `ncic_citations`
--
ALTER TABLE `ncic_citations`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `name_id` (`name_id`) USING BTREE,
  ADD KEY `status` (`status`) USING BTREE;

--
-- Indexes for table `ncic_names`
--
ALTER TABLE `ncic_names`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD UNIQUE KEY `first_name` (`first_name`,`last_name`) USING BTREE;

--
-- Indexes for table `ncic_plates`
--
ALTER TABLE `ncic_plates`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `veh_plate` (`veh_plate`(55)) USING BTREE,
  ADD KEY `name_id` (`name_id`) USING BTREE;

--
-- Indexes for table `ncic_warrants`
--
ALTER TABLE `ncic_warrants`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `name_id` (`name_id`) USING BTREE;

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`perm_id`) USING BTREE;

--
-- Indexes for table `ranks`
--
ALTER TABLE `ranks`
  ADD PRIMARY KEY (`rank_id`) USING BTREE;

--
-- Indexes for table `ranks_users`
--
ALTER TABLE `ranks_users`
  ADD PRIMARY KEY (`user_id`) USING BTREE,
  ADD UNIQUE KEY `user_id` (`user_id`) USING BTREE,
  ADD UNIQUE KEY `user_id_2` (`user_id`) USING BTREE,
  ADD KEY `rank_id` (`rank_id`) USING BTREE;

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`status_id`) USING BTREE;

--
-- Indexes for table `streets`
--
ALTER TABLE `streets`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `name` (`name`(767)) USING BTREE;

--
-- Indexes for table `tones`
--
ALTER TABLE `tones`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `name` (`name`) USING BTREE;

--
-- Indexes for table `user_departments`
--
ALTER TABLE `user_departments`
  ADD PRIMARY KEY (`user_id`,`department_id`) USING BTREE,
  ADD KEY `user_id` (`user_id`) USING BTREE,
  ADD KEY `department_id` (`department_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`) USING BTREE,
  ADD UNIQUE KEY `identifier` (`identifier`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calls`
--
ALTER TABLE `calls`
  MODIFY `call_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `citations`
--
ALTER TABLE `citations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `identity_requests`
--
ALTER TABLE `identity_requests`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ncic_citations`
--
ALTER TABLE `ncic_citations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `ncic_names`
--
ALTER TABLE `ncic_names`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;
--
-- AUTO_INCREMENT for table `ncic_plates`
--
ALTER TABLE `ncic_plates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `ncic_warrants`
--
ALTER TABLE `ncic_warrants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `ranks`
--
ALTER TABLE `ranks`
  MODIFY `rank_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `streets`
--
ALTER TABLE `streets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key for each street', AUTO_INCREMENT=363;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `civilian_names`
--
ALTER TABLE `civilian_names`
  ADD CONSTRAINT `Name ID` FOREIGN KEY (`names_id`) REFERENCES `ncic_names` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `User ID` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ncic_citations`
--
ALTER TABLE `ncic_citations`
  ADD CONSTRAINT `Name` FOREIGN KEY (`name_id`) REFERENCES `ncic_names` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ncic_plates`
--
ALTER TABLE `ncic_plates`
  ADD CONSTRAINT `Name Pair` FOREIGN KEY (`name_id`) REFERENCES `ncic_names` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ranks_users`
--
ALTER TABLE `ranks_users`
  ADD CONSTRAINT `Ranks` FOREIGN KEY (`rank_id`) REFERENCES `ranks` (`rank_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_departments`
--
ALTER TABLE `user_departments`
  ADD CONSTRAINT `Department` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(11) NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"opencad\",\"table\":\"active_users\"},{\"db\":\"opencad\",\"table\":\"user_departments_temp\"},{\"db\":\"opencad2\",\"table\":\"streets\"},{\"db\":\"opencad2\",\"table\":\"user_departments_temp\"},{\"db\":\"opencad2\",\"table\":\"user_departments\"},{\"db\":\"opencad2\",\"table\":\"users\"},{\"db\":\"opencad\",\"table\":\"users\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT '0',
  `x` float UNSIGNED NOT NULL DEFAULT '0',
  `y` float UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin,
  `data_sql` longtext COLLATE utf8_bin,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2017-08-29 13:32:07', '{\"collation_connection\":\"utf8mb4_unicode_ci\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
