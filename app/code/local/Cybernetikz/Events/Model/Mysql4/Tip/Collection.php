<?php
/*
Author: 		Md. Benzir Hasan
Author Email:   benzir@cybernetikz.com
Blog: 			http://blog.cybernetikz.com
Website: 		http://www.cybernetikz.com
*/


class Cybernetikz_Events_Model_Mysql4_Tip_Collection extends Varien_Data_Collection_Db
{
    protected $_tipTable;
 
    public function __construct()
    {
        $resources = Mage::getSingleton('core/resource');
        parent::__construct($resources->getConnection('events_read'));
        $this->_tipTable= $resources->getTableName('events/tip');
 
        $this->_select->from(
        		array('tip'=>$this->_tipTable),
 		       	array('*')
        		);
        $this->setItemObjectClass(Mage::getConfig()->getModelClassName('events/tip'));
    }
}