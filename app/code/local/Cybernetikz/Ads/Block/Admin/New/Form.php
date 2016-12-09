<?php
/*
Author: 		Md. Benzir Hasan
Author Email:   benzir@cybernetikz.com
Blog: 			http://blog.cybernetikz.com
Website: 		http://www.cybernetikz.com
*/


class Cybernetikz_Ads_Block_Admin_New_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Load Wysiwyg on demand and Prepare layout
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
    }
	
	protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
 
        $fieldset = $form->addFieldset('new_tip', array('legend' => Mage::helper('ads')->__('Ads Details')));
 
        $fieldset->addField('name', 'text', array(
            'name'      => 'name',
            'title'     => Mage::helper('ads')->__('Name'),
            'label'     => Mage::helper('ads')->__('Name'),
            'maxlength' => '250',
            'required'  => true,
        ));
 
        $fieldset->addField('main_file_url', 'image', array(
            'name'      => 'main_file_url',
            'title'     => Mage::helper('ads')->__('Upload Ads Image'),
            'label'     => Mage::helper('ads')->__('Upload Ads Image'),
            'maxlength' => '250',
            'required'  => true,
        ));
		
		$fieldset->addField('link_url', 'text', array(
            'name'      => 'link_url',
            'title'     => Mage::helper('ads')->__('Image Link'),
            'label'     => Mage::helper('ads')->__('Image Link'),
            'maxlength' => '250',
            'required'  => false,
        ));
		
		$fieldset->addField('start_date', 'date', array(
          'label'     => Mage::helper('ads')->__('Start Date'),
          'title'     => Mage::helper('ads')->__('Start Date'),
          'required'  => true,
          'name'      => 'start_date',
		  'image'    => $this->getSkinUrl('images/grid-cal.gif'),
		  'input_format' => Varien_Date::DATE_INTERNAL_FORMAT,
          'format'   => Varien_Date::DATE_INTERNAL_FORMAT,
        ));	
		
		$fieldset->addField('end_date', 'date', array(
          'label'     => Mage::helper('ads')->__('End Date'),
          'title'     => Mage::helper('ads')->__('End Date'),
          'required'  => true,
          'name'      => 'end_date',
		  'image'    => $this->getSkinUrl('images/grid-cal.gif'),
		  'input_format' => Varien_Date::DATE_INTERNAL_FORMAT,
          'format'   => Varien_Date::DATE_INTERNAL_FORMAT,
        ));	
		
		/*$fieldset->addField('place', 'text', array(
            'name'      => 'place',
            'title'     => Mage::helper('ads')->__('Place'),
            'label'     => Mage::helper('ads')->__('Place'),
            'maxlength' => '255',
            'required'  => false,
        ));*/
		
		$fieldset->addField('place', 'select', array(
          'label'     => Mage::helper('ads')->__('Select Place'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'place',
          'onclick' => "",
          'onchange' => "",
          'value'  => '1',
          'values' => array(
		  '-1'=>'Please Select',
		  'top-header' => 'Top Header Place (Size 611px x 81px)',
		  'mid-body' => 'Mid Body Place (Size 188px x 109px)',
		  'under-mid-body' => 'Under Mid Body Place (Size 750px x 115px)'),
          'disabled' => false,
          'readonly' => false,
        ));	
		
		$fieldset->addField('sort_order', 'text', array(
            'name'      => 'sort_order',
            'title'     => Mage::helper('ads')->__('Order'),
            'label'     => Mage::helper('ads')->__('Order'),
            'required'  => false,
        ));
		
		/*$wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig(
            );
        //make Wysiwyg Editor integrate in the form
        $wysiwygConfig["files_browser_window_url"] = Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/cms_wysiwyg_images/index');
        $wysiwygConfig["directives_url"] = Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/cms_wysiwyg/directive');
        $wysiwygConfig["directives_url_quoted"] = Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/cms_wysiwyg/directive');
        $wysiwygConfig["widget_window_url"] = Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/widget/index');
        $plugins = $wysiwygConfig->getData("plugins");
        $plugins[0]["options"]["url"] = Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/system_variable/wysiwygPlugin');
        $plugins[0]["options"]["onclick"]["subject"] = "MagentovariablePlugin.loadChooser('".Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/system_variable/wysiwygPlugin')."', '{{html_id}}');";
        $plugins = $wysiwygConfig->setData("plugins",$plugins);
        $contentField = $fieldset->addField('content', 'editor', array(
            'name'      => 'content',
			'title'     => Mage::helper('ads')->__('Ads Content'),
            'label'     => Mage::helper('ads')->__('Ads Content'),
            'style'     => 'height:20em; width:50em;',
            'required'  => true,
            'config'    => $wysiwygConfig
        ));*/
 
        $form->setMethod('post');
        $form->setUseContainer(true);
        $form->setId('edit_form');
		$form->setEnctype('multipart/form-data');
        $form->setAction($this->getUrl('*/*/post'));
 
        $this->setForm($form);
    }
}