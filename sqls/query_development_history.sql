CREATE TABLE `query_development_history` (
  `history_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'History ID',
  `subdomain_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'For which Subdomain ID?',
  `added_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Added on',
  `fixed_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Last time when CRON executed on this record',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Modified on',
  `modified_counter` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Number of total modifications',
  `sink_weight` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Sorting weight',
  `is_active` enum('N','Y') NOT NULL DEFAULT 'N' COMMENT 'Active record?',
  `is_approved` enum('N','Y') NOT NULL DEFAULT 'N' COMMENT 'Approved history?',
  `history_title` varchar(255) NOT NULL DEFAULT '' COMMENT 'Quick title',
  `history_text` text NOT NULL COMMENT 'Development Message',
  PRIMARY KEY (`history_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Records of what we did while developing things';