<?php
/*
Author: 		Md. Benzir Hasan
Author Email:   benzir@cybernetikz.com
Blog: 			http://blog.cybernetikz.com
Website: 		http://www.cybernetikz.com
*/


class Cybernetikz_Events_Block_Admin_New extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
 
        $this->_blockGroup = 'events';
        $this->_mode = 'new';
        $this->_controller = 'admin';
    }
 
    public function getHeaderText()
    {
        return Mage::helper('events')->__('Add New Event');
    }
}