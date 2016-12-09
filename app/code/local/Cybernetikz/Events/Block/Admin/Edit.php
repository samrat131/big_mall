<?php
/*
Author: 		Md. Benzir Hasan
Author Email:   benzir@cybernetikz.com
Blog: 			http://blog.cybernetikz.com
Website: 		http://www.cybernetikz.com
*/


class Cybernetikz_Events_Block_Admin_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
 
        $this->_blockGroup = 'events';
        $this->_mode = 'edit';
        $this->_controller = 'admin';
 
        if( $this->getRequest()->getParam($this->_objectId) ) {
            $tip = Mage::getModel('events/tip')
                ->load($this->getRequest()->getParam($this->_objectId));
            Mage::register('frozen_tip', $tip);
        }
    }
 
    public function getHeaderText()
    {
        return Mage::helper('events')->__("Edit Event'%s'", $this->htmlEscape(Mage::registry('frozen_tip')->getName()));
    }
}