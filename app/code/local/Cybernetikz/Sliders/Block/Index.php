<?php
/*
Author: 		Md. Benzir Hasan
Author Email:   benzir@cybernetikz.com
Blog: 			http://blog.cybernetikz.com
Website: 		http://www.cybernetikz.com
*/

class Cybernetikz_Sliders_Block_Index extends Mage_Core_Block_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('sliders/tip_list.phtml');
    }
    
    public function getTips()
    {
    	$model = Mage::getModel('sliders/tip');
    	$collection = $model
    	    	->getCollection()
    	    	->load();
        return $collection->getItems();
    }
} 