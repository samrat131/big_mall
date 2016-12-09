<?php
$installer = $this;
$installer->startSetup();
 
 $installer->run("
CREATE TABLE {$this->getTable('ads')} (
  `ads_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `main_file_url` varchar(250) NOT NULL,
  `thumb_image_url` varchar(250) NOT NULL,
  `link_url` varchar(250) DEFAULT NULL,
  PRIMARY KEY  (`ads_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  ");
$installer->endSetup();