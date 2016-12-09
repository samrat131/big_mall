<?php
/*
Author: 		Md. Benzir Hasan
Author Email:   benzir@cybernetikz.com
Blog: 			http://blog.cybernetikz.com
Website: 		http://www.cybernetikz.com
*/


class Cybernetikz_Sliders_Block_Admin_Main extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_addButtonLabel = Mage::helper('sliders')->__('Add New Slider');
        parent::__construct();
 
        $this->_blockGroup = 'sliders';
        $this->_controller = 'admin_main';
        $this->_headerText = Mage::helper('sliders')->__('Slider(s)');
    }
}