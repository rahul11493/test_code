-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `tree_entry`;
CREATE TABLE `tree_entry` (
  `entry_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_entry_id` int(11) NOT NULL DEFAULT '0' COMMENT '0 if its on the root level otherwise refering to another entry in this table',
  PRIMARY KEY (`entry_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='table holding all the tree nodes';

INSERT INTO `tree_entry` (`entry_id`, `parent_entry_id`) VALUES
(1,	0),
(2,	0),
(3,	0),
(4,	9),
(5,	9),
(6,	9),
(7,	5),
(8,	5),
(9,	1),
(10,	1),
(11,	10),
(12,	11),
(13,	3),
(14,	2),
(15,	13),
(19,	13),
(17,	13),
(18,	5);

DROP TABLE IF EXISTS `tree_entry_lang`;
CREATE TABLE `tree_entry_lang` (
  `entry_id` int(11) NOT NULL,
  `lang` varchar(3) NOT NULL COMMENT 'language for the translation (eng/ger)',
  `name` varchar(255) NOT NULL COMMENT 'translated name for the given entry'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='translation table for tree_entry';

INSERT INTO `tree_entry_lang` (`entry_id`, `lang`, `name`) VALUES
(1,	'eng',	'Prio 1 Tasks'),
(2,	'eng',	'Prio 2 Tasks'),
(3,	'eng',	'Prio 3 Tasks'),
(4,	'eng',	'Point ABC123'),
(5,	'eng',	'Point BCD123'),
(6,	'eng',	'Point UARGH123'),
(7,	'eng',	'Task 22222'),
(8,	'eng',	'Task 566'),
(9,	'eng',	'Supplier'),
(10,	'eng',	'Customer'),
(11,	'eng',	'204. Task'),
(12,	'eng',	'209. Task'),
(13,	'eng',	'123. Task'),
(14,	'eng',	'asdasd. Task'),
(15,	'eng',	'nomnom. Task'),
(19,	'eng',	'mimimi. Task'),
(17,	'eng',	'Gedöns Task'),
(18,	'eng',	'ZOMG Task');

-- 2022-07-28 07:42:30
