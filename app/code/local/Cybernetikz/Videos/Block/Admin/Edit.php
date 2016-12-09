<?php
/*
Author: 		Md. Benzir Hasan
Author Email:   benzir@cybernetikz.com
Blog: 			http://blog.cybernetikz.com
Website: 		http://www.cybernetikz.com
*/


class Cybernetikz_Videos_Block_Admin_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
 
        $this->_blockGroup = 'videos';
        $this->_mode = 'edit';
        $this->_controller = 'admin';
 
        if( $this->getRequest()->getParam($this->_objectId) ) {
            $tip = Mage::getModel('videos/tip')
                ->load($this->getRequest()->getParam($this->_objectId));
            Mage::register('frozen_tip', $tip);
        }
    }
 
    public function getHeaderText()
    {
        return Mage::helper('videos')->__("Edit Video'%s'", $this->htmlEscape(Mage::registry('frozen_tip')->getName()));
    }
}