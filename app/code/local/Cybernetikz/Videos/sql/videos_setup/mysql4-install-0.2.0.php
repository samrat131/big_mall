<?php
$installer = $this;
$installer->startSetup();
  
 $installer->run("
CREATE TABLE {$this->getTable('videos')} (
  `video_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `main_file_url` varchar(250) NOT NULL,
  `thumb_image_url` varchar(250) NOT NULL,
  `link_url` varchar(250) DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY  (`video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  ");
$installer->endSetup();