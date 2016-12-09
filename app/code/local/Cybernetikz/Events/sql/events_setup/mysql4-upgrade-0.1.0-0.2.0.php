<?php
$installer = $this;
$installer->startSetup();
 
 $installer->run("
CREATE TABLE {$this->getTable('events')} (
  `slider_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `main_file_url` varchar(250) NOT NULL,
  `thumb_image_url` varchar(250) NOT NULL,
  `link_url` varchar(250) DEFAULT NULL,
  `cellege` varchar(255) DEFAULT NULL,
  `dated` DATETIME NOT NULL,
  PRIMARY KEY  (`slider_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  ");
$installer->endSetup();