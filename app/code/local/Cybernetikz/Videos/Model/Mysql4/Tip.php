<?php
/*
Author: 		Md. Benzir Hasan
Author Email:   benzir@cybernetikz.com
Blog: 			http://blog.cybernetikz.com
Website: 		http://www.cybernetikz.com
*/


class Cybernetikz_Videos_Model_Mysql4_Tip extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('videos/tip', 'video_id');
    }
}