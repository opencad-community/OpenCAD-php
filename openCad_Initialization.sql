DROP DATABASE IF EXISTS opencad;
CREATE DATABASE opencad;
USE opencad;


--
-- Table structure for table `active_users`
--

CREATE TABLE `active_users`(
  `identifier` VARCHAR(255) NOT NULL,
  `callsign` VARCHAR(255) NOT NULL COMMENT 'Unit Callsign',
  `status` INT(11) NOT NULL COMMENT 'Unit status, 0=busy/unavailable, 1=available, 2=dispatcher',
  `status_detail` INT(11) NOT NULL COMMENT 'Paired to Statuses table'
) ENGINE = InnoDB DEFAULT CHARSET = latin1 ROW_FORMAT = COMPACT;


-- --------------------------------------------------------

--
-- Table structure for table `calls`
--

CREATE TABLE `calls`(
  `call_id` INT(4) NOT NULL,
  `call_type` TEXT NOT NULL,
  `call_primary` TEXT NOT NULL,
  `call_street1` TEXT NOT NULL,
  `call_street2` TEXT DEFAULT NULL,
  `call_street3` TEXT DEFAULT NULL,
  `call_notes` TEXT NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1 ROW_FORMAT = COMPACT;


-- --------------------------------------------------------

--
-- Table structure for table `calls_users`
--

CREATE TABLE `calls_users`(
  `call_id` INT(11) NOT NULL,
  `identifier` VARCHAR(255) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1 ROW_FORMAT = COMPACT;


-- --------------------------------------------------------

--
-- Table structure for table `call_history`
--

CREATE TABLE `call_history`(
  `call_id` INT(11) NOT NULL,
  `call_primary` TEXT NOT NULL,
  `call_type` TEXT NOT NULL,
  `call_street1` TEXT NOT NULL,
  `call_street2` TEXT DEFAULT NULL,
  `call_street3` TEXT DEFAULT NULL,
  `call_notes` TEXT NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1 ROW_FORMAT = COMPACT;


-- --------------------------------------------------------

--
-- Table structure for table `citations`
--

CREATE TABLE `citations`(
  `id` INT(11) NOT NULL,
  `citation_name` VARCHAR(255) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1 ROW_FORMAT = COMPACT;


-- --------------------------------------------------------

--
-- Table structure for table `civilian_names`
--

CREATE TABLE `civilian_names`(
  `user_id` INT(11) NOT NULL COMMENT 'Links to users table',
  `names_id` INT(11) NOT NULL COMMENT 'Links to names table'
) ENGINE = InnoDB DEFAULT CHARSET = latin1 ROW_FORMAT = COMPACT;


-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments`(
  `department_id` INT(11) NOT NULL,
  `department_name` VARCHAR(255) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1 ROW_FORMAT = COMPACT;


--
-- Dumping data for table `departments`
--

INSERT
INTO
  `departments`(`department_id`,
  `department_name`)
VALUES(0, 'Head Administrators'),(1, 'Communications'),(2, 'EMS'),(3, 'Fire'),(4, 'Highway'),(5, 'Police'),(6, 'Sheriff'),(7, 'Civilian'),(8, 'Admins'), (9, 'State');


-- --------------------------------------------------------

--
-- Table structure for table `identity_requests`
--

CREATE TABLE `identity_requests`(
  `req_id` INT(11) NOT NULL,
  `submittedByName` VARCHAR(255) DEFAULT NULL,
  `submittedById` INT(20) DEFAULT NULL,
  `first_name` VARCHAR(255) DEFAULT NULL,
  `last_name` VARCHAR(255) DEFAULT NULL,
  `dob` DATE DEFAULT NULL,
  `address` TEXT DEFAULT NULL,
  `sex` TEXT DEFAULT NULL,
  `race` TEXT DEFAULT NULL,
  `hair_color` TEXT DEFAULT NULL,
  `build` TEXT DEFAULT NULL,
  `biography` TEXT DEFAULT NULL,
  `veh_plate` TEXT DEFAULT NULL,
  `veh_make` TEXT DEFAULT NULL,
  `veh_model` TEXT DEFAULT NULL,
  `veh_color` TEXT DEFAULT NULL,
  `submitted_on` TEXT DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1 ROW_FORMAT = COMPACT;


-- --------------------------------------------------------

--
-- Table structure for table `incident_type`
--

CREATE TABLE `incident_type`(
  `code_id` VARCHAR(255) NOT NULL DEFAULT '',
  `code_name` VARCHAR(255) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;


--
-- Dumping data for table `incident_type`
--

INSERT
INTO
  `incident_type`(`code_id`,
  `code_name`)
VALUES('68', 'Armed Robbery'),('25', 'Domestic Dispute'),('10', 'Fight in Progress'),('49', 'Homicide'),('55', 'Intoxicated Driver'),('56', 'Intoxicated Person'),('62', 'Kidnapping'),('66', 'Reckless Driver'),('13', 'Shots Fired'),('16', 'Stolen Vehicle'),('17', 'Suspicious Person'),('11', 'Traffic Stop'),('50', 'Vehicle Accident');


-- --------------------------------------------------------

--
-- Table structure for table `ncic_citations`
--

CREATE TABLE `ncic_citations`(
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `status` TINYINT(2) NOT NULL DEFAULT 0 COMMENT '0 = Pending, 1 = Approved/Active',
  `name_id` INT(11) NOT NULL COMMENT 'Paired to ID of ncic_names table',
  `citation_name` TEXT NOT NULL,
  `issued_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);


-- --------------------------------------------------------

--
-- Table structure for table `ncic_names`
--

CREATE TABLE `ncic_names`(
  `id` INT(11) NOT NULL,
  `submittedByName` VARCHAR(255) NOT NULL,
  `submittedById` VARCHAR(255) NOT NULL,
  `first_name` VARCHAR(255) NOT NULL,
  `last_name` VARCHAR(255) NOT NULL,
  `dob` DATE NOT NULL COMMENT 'Date of birth',
  `address` TEXT NOT NULL,
  `sex`
SET
  ('Male',
  'Female') NOT NULL,
  `race` TEXT NOT NULL,
  `dl_status`
SET
  ('Valid',
  'Suspended',
  'Expired') NOT NULL,
  `hair_color` TEXT NOT NULL,
  `build` TEXT NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1 ROW_FORMAT = COMPACT;


-- --------------------------------------------------------

--
-- Table structure for table `ncic_plates`
--

CREATE TABLE `ncic_plates`(
  `id` INT(11) NOT NULL,
  `name_id` INT(11) NOT NULL COMMENT 'Links to ncic_names db for driver information',
  `veh_plate` TEXT NOT NULL,
  `veh_make` TEXT NOT NULL,
  `veh_model` TEXT NOT NULL,
  `veh_color` TEXT NOT NULL,
  `veh_insurance`
SET
  ('VALID',
  'EXPIRED') NOT NULL DEFAULT 'VALID',
  `flags`
SET
  (
    'NONE',
    'STOLEN',
    'WANTED',
    'SUSPENDED REGISTRATION',
    'UC FLAG',
    'HPIU FLAG'
  ) NOT NULL DEFAULT 'NONE',
  `veh_reg_state` TEXT NOT NULL,
  `notes` TEXT DEFAULT NULL COMMENT 'Any special flags visible to dispatchers',
  `user_id` INT(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1 ROW_FORMAT = COMPACT;


-- --------------------------------------------------------

--
-- Table structure for table `ncic_warrants`
--

CREATE TABLE `ncic_warrants`(
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name_id` INT(11) NOT NULL COMMENT 'Key that pairs to the ncic_name id',
  `issued_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);


-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions`(
  `perm_id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `perm_desc` VARCHAR(50) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1 ROW_FORMAT = COMPACT;


-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses`(
  `status_id` INT(11) NOT NULL,
  `status_text` TEXT NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1 ROW_FORMAT = COMPACT;


--
-- Dumping data for table `statuses`
--

INSERT
INTO
  `statuses`(`status_id`,
  `status_text`)
VALUES(1, '10-8 | Available'),(2, '10-6 | Busy'),(4, '10-5 | Meal Break'),(5, 'Signal 11'),(6, '10-7 | Unavailable'),(7, '10-23 | Arrived on Scene'),(
  8,
  '10-65 | Transporting Prisoner'
);


-- --------------------------------------------------------

--
-- Table structure for table `streets`
--

CREATE TABLE `streets`(
  `id` INT(11) NOT NULL COMMENT 'Primary key for each street',
  `name` TEXT NOT NULL COMMENT 'Street name',
  `county` TEXT NOT NULL COMMENT 'County name'
) ENGINE = InnoDB DEFAULT CHARSET = latin1 ROW_FORMAT = COMPACT;


--
-- Dumping data for table `streets`
--

INSERT
INTO
  `streets`(`id`,
  `name`,
  `county`)
VALUES(
  1,
  'Abattoir Avenue',
  'Los Santos County'
),(
  2,
  'Abe Milton Parkway',
  'Los Santos County'
),(
  3,
  'Ace Jones Drive',
  'Los Santos County'
),(
  4,
  'Adam\'s Apple Boulevard',
  'Los Santos County'
),(
  5,
  'Aguja Street',
  'Los Santos County'
),(
  6,
  'Alta Place',
  'Los Santos County'
),(
  7,
  'Alta Street',
  'Los Santos County'
),(
  8,
  'Amarillo Vista',
  'Los Santos County'
),(
  9,
  'Amarillo Way',
  'Los Santos County'
),(
  10,
  'Americano Way',
  'Los Santos County'
),(
  11,
  'Atlee Street',
  'Los Santos County'
),(
  12,
  'Autopia Parkway',
  'Los Santos County'
),(
  13,
  'Banham Canyon Drive',
  'Los Santos County'
),(
  14,
  'Barbareno Road',
  'Los Santos County'
),(
  15,
  'Bay City Avenue',
  'Los Santos County'
),(
  16,
  'Bay City Incline',
  'Los Santos County'
),(
  17,
  'Baytree Canyon Road (City)',
  'Los Santos County'
),(
  18,
  'Boulevard Del Perro',
  'Los Santos County'
),(
  19,
  'Bridge Street',
  'Los Santos County'
),(
  20,
  'Brouge Avenue',
  'Los Santos County'
),(
  21,
  'Buccaneer Way',
  'Los Santos County'
),(
  22,
  'Buen Vino Road',
  'Los Santos County'
),(
  23,
  'Caesars Place',
  'Los Santos County'
),(
  24,
  'Calais Avenue',
  'Los Santos County'
),(
  25,
  'Capital Boulevard',
  'Los Santos County'
),(
  26,
  'Carcer Way',
  'Los Santos County'
),(
  27,
  'Carson Avenue',
  'Los Santos County'
),(
  28,
  'Chum Street',
  'Los Santos County'
),(
  29,
  'Chupacabra Street',
  'Los Santos County'
),(
  30,
  'Clinton Avenue',
  'Los Santos County'
),(
  31,
  'Cockingend Drive',
  'Los Santos County'
),(
  32,
  'Conquistador Street',
  'Los Santos County'
),(
  33,
  'Cortes Street',
  'Los Santos County'
),(
  34,
  'Cougar Avenue',
  'Los Santos County'
),(
  35,
  'Covenant Avenue',
  'Los Santos County'
),(36, 'Cox Way', 'Los Santos County'),(
  37,
  'Crusade Road',
  'Los Santos County'
),(
  38,
  'Davis Avenue',
  'Los Santos County'
),(
  39,
  'Decker Street',
  'Los Santos County'
),(
  40,
  'Didion Drive',
  'Los Santos County'
),(
  41,
  'Dorset Drive',
  'Los Santos County'
),(
  42,
  'Dorset Place',
  'Los Santos County'
),(
  43,
  'Dry Dock Street',
  'Los Santos County'
),(
  44,
  'Dunstable Drive',
  'Los Santos County'
),(
  45,
  'Dunstable Lane',
  'Los Santos County'
),(
  46,
  'Dutch London Street',
  'Los Santos County'
),(
  47,
  'Eastbourne Way',
  'Los Santos County'
),(
  48,
  'East Galileo Avenue',
  'Los Santos County'
),(
  49,
  'East Mirror Drive',
  'Los Santos County'
),(
  50,
  'Eclipse Boulevard',
  'Los Santos County'
),(
  51,
  'Edwood Way',
  'Los Santos County'
),(
  52,
  'Elgin Avenue',
  'Los Santos County'
),(
  53,
  'El Burro Boulevard',
  'Los Santos County'
),(
  54,
  'El Rancho Boulevard',
  'Los Santos County'
),(
  55,
  'Equality Way',
  'Los Santos County'
),(
  56,
  'Exceptionalists Way',
  'Los Santos County'
),(
  57,
  'Fantastic Place',
  'Los Santos County'
),(
  58,
  'Fenwell Place',
  'Los Santos County'
),(
  59,
  'Forum Drive',
  'Los Santos County'
),(
  60,
  'Fudge Lane',
  'Los Santos County'
),(
  61,
  'Galileo Road',
  'Los Santos County'
),(
  62,
  'Gentry Lane',
  'Los Santos County'
),(
  63,
  'Ginger Street',
  'Los Santos County'
),(
  64,
  'Glory Way',
  'Los Santos County'
),(
  65,
  'Goma Street',
  'Los Santos County'
),(
  66,
  'Greenwich Parkway',
  'Los Santos County'
),(
  67,
  'Greenwich Place',
  'Los Santos County'
),(
  68,
  'Greenwich Way',
  'Los Santos County'
),(
  69,
  'Grove Street',
  'Los Santos County'
),(
  70,
  'Hanger Way',
  'Los Santos County'
),(
  71,
  'Hangman Avenue',
  'Los Santos County'
),(
  72,
  'Hardy Way',
  'Los Santos County'
),(
  73,
  'Hawick Avenue',
  'Los Santos County'
),(
  74,
  'Heritage Way',
  'Los Santos County'
),(
  75,
  'Hillcrest Avenue',
  'Los Santos County'
),(
  76,
  'Hillcrest Ridge Access Road',
  'Los Santos County'
),(
  77,
  'Imagination Court',
  'Los Santos County'
),(
  78,
  'Industry Passage',
  'Los Santos County'
),(
  79,
  'Ineseno Road',
  'Los Santos County'
),(
  80,
  'Integrity Way',
  'Los Santos County'
),(
  81,
  'Invention Court',
  'Los Santos County'
),(
  82,
  'Innocence Boulevard',
  'Los Santos County'
),(
  83,
  'Jamestown Street',
  'Los Santos County'
),(
  84,
  'Kimble Hill Drive',
  'Los Santos County'
),(
  85,
  'Kortz Drive',
  'Los Santos County'
),(
  86,
  'Labor Place',
  'Los Santos County'
),(
  87,
  'Laguna Place',
  'Los Santos County'
),(
  88,
  'Lake Vinewood Drive',
  'Los Santos County'
),(
  89,
  'Las Lagunas Boulevard',
  'Los Santos County'
),(
  90,
  'Liberty Street',
  'Los Santos County'
),(
  91,
  'Lindsay Circus',
  'Los Santos County'
),(
  92,
  'Little Bighorn Avenue',
  'Los Santos County'
),(
  93,
  'Low Power Street',
  'Los Santos County'
),(
  94,
  'Macdonald Street',
  'Los Santos County'
),(
  95,
  'Mad Wayne Thunder Drive',
  'Los Santos County'
),(
  96,
  'Magellan Avenue',
  'Los Santos County'
),(
  97,
  'Marathon Avenue',
  'Los Santos County'
),(
  98,
  'Marlowe Drive',
  'Los Santos County'
),(
  99,
  'Melanoma Street',
  'Los Santos County'
),(
  100,
  'Meteor Street',
  'Los Santos County'
),(
  101,
  'Milton Road',
  'Los Santos County'
),(
  102,
  'Mirror Park Boulevard',
  'Los Santos County'
),(
  103,
  'Mirror Place',
  'Los Santos County'
),(
  104,
  'Morningwood Boulevard',
  'Los Santos County'
),(
  105,
  'Mount Haan Drive',
  'Los Santos County'
),(
  106,
  'Mount Haan Road',
  'Los Santos County'
),(
  107,
  'Mount Vinewood Drive',
  'Los Santos County'
),(
  108,
  'Movie Star Way',
  'Los Santos County'
),(
  109,
  'Mutiny Road',
  'Los Santos County'
),(
  110,
  'New Empire Way',
  'Los Santos County'
),(
  111,
  'Nikola Avenue',
  'Los Santos County'
),(
  112,
  'Nikola Place',
  'Los Santos County'
),(
  113,
  'Normandy Drive',
  'Los Santos County'
),(
  114,
  'North Archer Avenue',
  'Los Santos County'
),(
  115,
  'North Conker Avenue',
  'Los Santos County'
),(
  116,
  'North Sheldon Avenue',
  'Los Santos County'
),(
  117,
  'North Rockford Drive',
  'Los Santos County'
),(
  118,
  'Occupation Avenue',
  'Los Santos County'
),(
  119,
  'Orchardville Avenue',
  'Los Santos County'
),(
  120,
  'Palomino Avenue',
  'Los Santos County'
),(
  121,
  'Peaceful Street',
  'Los Santos County'
),(
  122,
  'Perth Street',
  'Los Santos County'
),(
  123,
  'Picture Perfect Drive',
  'Los Santos County'
),(
  124,
  'Plaice Place',
  'Los Santos County'
),(
  125,
  'Playa Vista',
  'Los Santos County'
),(
  126,
  'Popular Street',
  'Los Santos County'
),(
  127,
  'Portola Drive',
  'Los Santos County'
),(
  128,
  'Power Street',
  'Los Santos County'
),(
  129,
  'Prosperity Street',
  'Los Santos County'
),(
  130,
  'Prosperity Street Promenade',
  'Los Santos County'
),(
  131,
  'Red Desert Avenue',
  'Los Santos County'
),(
  132,
  'Richman Street',
  'Los Santos County'
),(
  133,
  'Rockford Drive',
  'Los Santos County'
),(
  134,
  'Roy Lowenstein Boulevard',
  'Los Santos County'
),(
  135,
  'Rub Street',
  'Los Santos County'
),(
  136,
  'Sam Austin Drive',
  'Los Santos County'
),(
  137,
  'San Andreas Avenue',
  'Los Santos County'
),(
  138,
  'Sandcastle Way',
  'Los Santos County'
),(
  139,
  'San Vitus Boulevard',
  'Los Santos County'
),(
  140,
  'Senora Road',
  'Los Santos County'
),(
  141,
  'Shank Street',
  'Los Santos County'
),(
  142,
  'Signal Street',
  'Los Santos County'
),(
  143,
  'Sinner Street',
  'Los Santos County'
),(
  144,
  'Sinners Passage',
  'Los Santos County'
),(
  145,
  'South Arsenal Street',
  'Los Santos County'
),(
  146,
  'South Boulevard Del Perro',
  'Los Santos County'
),(
  147,
  'South Mo Milton Drive',
  'Los Santos County'
),(
  148,
  'South Rockford Drive',
  'Los Santos County'
),(
  149,
  'South Shambles Street',
  'Los Santos County'
),(
  150,
  'Spanish Avenue',
  'Los Santos County'
),(
  151,
  'Steele Way',
  'Los Santos County'
),(
  152,
  'Strangeways Drive',
  'Los Santos County'
),(
  153,
  'Strawberry Avenue',
  'Los Santos County'
),(
  154,
  'Supply Street',
  'Los Santos County'
),(
  155,
  'Sustancia Road',
  'Los Santos County'
),(
  156,
  'Swiss Street',
  'Los Santos County'
),(
  157,
  'Tackle Street',
  'Los Santos County'
),(
  158,
  'Tangerine Street',
  'Los Santos County'
),(
  159,
  'Tongva Drive',
  'Los Santos County'
),(
  160,
  'Tower Way',
  'Los Santos County'
),(
  161,
  'Tug Street',
  'Los Santos County'
),(
  162,
  'Utopia Gardens',
  'Los Santos County'
),(
  163,
  'Vespucci Boulevard',
  'Los Santos County'
),(
  164,
  'Vinewood Boulevard',
  'Los Santos County'
),(
  165,
  'Vinewood Park Drive',
  'Los Santos County'
),(
  166,
  'Vitus Street',
  'Los Santos County'
),(
  167,
  'Voodoo Place',
  'Los Santos County'
),(
  168,
  'West Eclipse Boulevard',
  'Los Santos County'
),(
  169,
  'West Galileo Avenue',
  'Los Santos County'
),(
  170,
  'West Mirror Drive',
  'Los Santos County'
),(
  171,
  'Whispymound Drive',
  'Los Santos County'
),(
  172,
  'Wild Oats Drive',
  'Los Santos County'
),(
  173,
  'York Street',
  'Los Santos County'
),(
  174,
  'Zancudo Barranca',
  'LOS Santos'
),(
  175,
  'Algonquin Boulevard',
  'Blaine County'
),(
  176,
  'Alhambra Drive',
  'Blaine County'
),(
  177,
  'Armadillo Avenue',
  'Blaine County'
),(
  178,
  'Baytree Canyon Road (County)',
  'Blaine County'
),(
  179,
  'Calafia Road',
  'Blaine County'
),(
  180,
  'Cascabel Avenue',
  'Blaine County'
),(
  181,
  'Cassidy Trail',
  'Blaine County'
),(
  182,
  'Cat-Claw Avenue',
  'Blaine County'
),(
  183,
  'Chianski Passage',
  'Blaine County'
),(
  184,
  'Cholla Road',
  'Blaine County'
),(
  185,
  'Cholla Springs Avenue',
  'Blaine County'
),(
  186,
  'Duluoz Avenue',
  'Blaine County'
),(
  187,
  'East Joshua Road',
  'Blaine County'
),(
  188,
  'Fort Zancudo Approach Road',
  'Blaine County'
),(
  189,
  'Galileo Road',
  'Blaine County'
),(
  190,
  'Grapeseed Avenue',
  'Blaine County'
),(
  191,
  'Grapeseed Main Street',
  'Blaine County'
),(192, 'Joad Lane', 'Blaine County'),(
  193,
  'Joshua Road',
  'Blaine County'
),(
  194,
  'Lesbos Lane',
  'Blaine County'
),(
  195,
  'Lolita Avenue',
  'Blaine County'
),(
  196,
  'Marina Drive',
  'Blaine County'
),(
  197,
  'Meringue Lane',
  'Blaine County'
),(
  198,
  'Mount Haan Road',
  'Blaine County'
),(
  199,
  'Mountain View Drive',
  'Blaine County'
),(
  200,
  'Niland Avenue',
  'Blaine County'
),(
  201,
  'North Calafia Way',
  'Blaine County'
),(
  202,
  'Nowhere Road',
  'Blaine County'
),(
  203,
  'O\'Neil Way',
  'Blaine County'
),(
  204,
  'Paleto Boulevard',
  'Blaine County'
),(
  205,
  'Panorama Drive',
  'Blaine County'
),(
  206,
  'Procopio Drive',
  'Blaine County'
),(
  207,
  'Procopio Promenade',
  'Blaine County'
),(
  208,
  'Pyrite Avenue',
  'Blaine County'
),(209, 'Raton Pass', 'Blaine County'),(
  210,
  'Route 68 Approach',
  'Blaine County'
),(
  211,
  'Seaview Road',
  'Blaine County'
),(212, 'Senora Way', 'Blaine County'),(
  213,
  'Smoke Tree Road',
  'Blaine County'
),(214, 'Union Road', 'Blaine County'),(
  215,
  'Zancudo Avenue',
  'Blaine County'
),(
  216,
  'Zancudo Road',
  'Blaine County'
),(
  217,
  'Zancudo Trail',
  'Blaine County'
),(218, 'Interstate 1', 'State'),(219, 'Interstate 2', 'State'),(220, 'Interstate 4', 'State'),(221, 'Interstate 5', 'State'),(222, 'Route 1', 'State'),(223, 'Route 11', 'State'),(224, 'Route 13', 'State'),(225, 'Route 14', 'State'),(226, 'Route 15', 'State'),(227, 'Route 16', 'State'),(228, 'Route 17', 'State'),(229, 'Route 18', 'State'),(230, 'Route 19', 'State'),(231, 'Route 20', 'State'),(232, 'Route 22', 'State'),(233, 'Route 23', 'State'),(234, 'Route 68', 'State');


-- --------------------------------------------------------

--
-- Table structure for table `tones`
--

CREATE TABLE `tones`(
  `id` INT(11) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `active`
SET
  ('0',
  '1') NOT NULL DEFAULT '0' COMMENT '0 = inactive, 1 = active'
) ENGINE = InnoDB DEFAULT CHARSET = latin1 COMMENT = 'Tones table. DO NOT ADD ROWS TO THIS TABLE' ROW_FORMAT = COMPACT;


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users`(
  `id` INT(11) NOT NULL,
  `name` TEXT NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` TEXT DEFAULT NULL,
  `identifier` VARCHAR(255) DEFAULT NULL,
  `password_reset` INT(1) NOT NULL DEFAULT 0 COMMENT '1 means password reset required. 0 means it''s not.',
  `approved` INT(1) NOT NULL DEFAULT 0 COMMENT 'Three main statuses: 0 means pending approval. 1 means has access. 2 means banned'
) ENGINE = InnoDB DEFAULT CHARSET = latin1 COMMENT = 'User table' ROW_FORMAT = COMPACT;


--
-- Dumping data for table `users`
--

INSERT
INTO
  `users`(
    `id`,
    `name`,
    `email`,
    `password`,
    `identifier`,
    `password_reset`,
    `approved`
  )
VALUES(
  21,
  'Default Admin',
  'admin@test.com',
  '$2y$10$xHvogGcqQs8jhTPbFEDHJO9KWu2FCLgJ5XGxH.hHMA0BY1brgCkSG',
  '1A-98',
  0,
  1
);


-- --------------------------------------------------------

--
-- Table structure for table `user_departments`
--

CREATE TABLE `user_departments`(
  `user_id` INT(11) NOT NULL,
  `department_id` INT(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1 ROW_FORMAT = COMPACT;


--
-- Dumping data for table `user_departments`
--

INSERT
INTO
  `user_departments`(`user_id`,
  `department_id`)
VALUES(21, 0),(21, 1),(21, 2),(21, 3),(21, 4),(21, 5),(21, 6),(21, 7),(21, 8), (21, 9);


-- --------------------------------------------------------

--
-- Table structure for table `user_departments_temp`
--

CREATE TABLE `user_departments_temp`(
  `user_id` INT(11) NOT NULL,
  `department_id` INT(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1 COMMENT = 'Temporary table - stores user departments for non-approved users' ROW_FORMAT = COMPACT;


--
-- Dumping data for table `user_departments_temp`
--

INSERT
INTO
  `user_departments_temp`(`user_id`,
  `department_id`)
VALUES(21, 7),(21, 1),(21, 5),(24, 1),(26, 7);


--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_users`
--
ALTER TABLE
  `active_users` ADD PRIMARY KEY(`identifier`) USING BTREE,
  ADD UNIQUE KEY `callsign`(`callsign`) USING BTREE,
  ADD UNIQUE KEY `identifier`(`identifier`) USING BTREE;


--
-- Indexes for table `calls`
--
ALTER TABLE
  `calls` ADD PRIMARY KEY(`call_id`) USING BTREE;


--
-- Indexes for table `calls_users`
--
ALTER TABLE
  `calls_users` ADD PRIMARY KEY(`call_id`,
  `identifier`) USING BTREE;


--
-- Indexes for table `call_history`
--
ALTER TABLE
  `call_history` ADD PRIMARY KEY(`call_id`) USING BTREE;


--
-- Indexes for table `citations`
--
ALTER TABLE
  `citations` ADD PRIMARY KEY(`id`) USING BTREE,
  ADD UNIQUE KEY `citation_name`(`citation_name`) USING BTREE;


--
-- Indexes for table `civilian_names`
--
ALTER TABLE
  `civilian_names` ADD PRIMARY KEY(`user_id`,
  `names_id`) USING BTREE,
  ADD UNIQUE KEY `names_id`(`names_id`) USING BTREE;


--
-- Indexes for table `departments`
--
ALTER TABLE
  `departments` ADD PRIMARY KEY(`department_id`) USING BTREE;


--
-- Indexes for table `identity_requests`
--
ALTER TABLE
  `identity_requests` ADD PRIMARY KEY(`req_id`) USING BTREE;


--
-- Indexes for table `incident_type`
--
ALTER TABLE
  `incident_type` ADD PRIMARY KEY(`code_id`) USING BTREE,
  ADD UNIQUE KEY `code_name`(`code_name`) USING BTREE;


--
-- Indexes for table `ncic_names`
--
ALTER TABLE
  `ncic_names` ADD PRIMARY KEY(`id`) USING BTREE,
  ADD UNIQUE KEY `id_UNIQUE`(`id`) USING BTREE,
  ADD UNIQUE KEY `first_name`(`first_name`,
  `last_name`) USING BTREE;


--
-- Indexes for table `ncic_plates`
--
ALTER TABLE
  `ncic_plates` ADD PRIMARY KEY(`id`) USING BTREE,
  ADD UNIQUE KEY `veh_plate`(`veh_plate`(55)) USING BTREE,
  ADD KEY `name_id`(`name_id`) USING BTREE;


--
-- Indexes for table `statuses`
--
ALTER TABLE
  `statuses` ADD PRIMARY KEY(`status_id`) USING BTREE;


--
-- Indexes for table `streets`
--
ALTER TABLE
  `streets` ADD PRIMARY KEY(`id`);


--
-- Indexes for table `tones`
--
ALTER TABLE
  `tones` ADD PRIMARY KEY(`id`) USING BTREE,
  ADD UNIQUE KEY `name`(`name`) USING BTREE;


--
-- Indexes for table `users`
--
ALTER TABLE
  `users` ADD PRIMARY KEY(`id`) USING BTREE,
  ADD UNIQUE KEY `email`(`email`) USING BTREE,
  ADD UNIQUE KEY `identifier`(`identifier`) USING BTREE;


--
-- Indexes for table `user_departments`
--
ALTER TABLE
  `user_departments` ADD PRIMARY KEY(`user_id`,
  `department_id`) USING BTREE,
  ADD KEY `user_id`(`user_id`) USING BTREE,
  ADD KEY `department_id`(`department_id`) USING BTREE;


--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calls`
--
ALTER TABLE
  `calls` MODIFY `call_id` INT(4) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 2;

--
-- AUTO_INCREMENT for table `citations`
--
ALTER TABLE
  `citations` MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 23;

--
-- AUTO_INCREMENT for table `identity_requests`
--
ALTER TABLE
  `identity_requests` MODIFY `req_id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 3;

--
-- AUTO_INCREMENT for table `ncic_citations`
--
ALTER TABLE
  `ncic_citations` MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ncic_names`
--
ALTER TABLE
  `ncic_names` MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 175;

--
-- AUTO_INCREMENT for table `ncic_plates`
--
ALTER TABLE
  `ncic_plates` MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 74;

--
-- AUTO_INCREMENT for table `ncic_warrants`
--
ALTER TABLE
  `ncic_warrants` MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE
  `statuses` MODIFY `status_id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 9;

--
-- AUTO_INCREMENT for table `streets`
--
ALTER TABLE
  `streets` MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key for each street',
  AUTO_INCREMENT = 235;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE
  `users` MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `civilian_names`
--
ALTER TABLE
  `civilian_names` ADD CONSTRAINT `Name ID` FOREIGN KEY(`names_id`) REFERENCES `ncic_names`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `User ID` FOREIGN KEY(`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;


--
-- Constraints for table `ncic_plates`
--
ALTER TABLE
  `ncic_plates` ADD CONSTRAINT `Name Pair` FOREIGN KEY(`name_id`) REFERENCES `ncic_names`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;


--
-- Constraints for table `user_departments`
--
ALTER TABLE
  `user_departments` ADD CONSTRAINT `Department` FOREIGN KEY(`department_id`) REFERENCES `departments`(`department_id`) ON DELETE CASCADE ON UPDATE CASCADE;
