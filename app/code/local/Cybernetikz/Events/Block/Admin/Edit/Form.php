<?php
/*
Author: 		Md. Benzir Hasan
Author Email:   benzir@cybernetikz.com
Blog: 			http://blog.cybernetikz.com
Website: 		http://www.cybernetikz.com
*/


class Cybernetikz_Events_Block_Admin_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
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
 
        $fieldset = $form->addFieldset('edit_tip', array('legend' => Mage::helper('events')->__('Event Details')));
 
        $fieldset->addField('slider_id', 'hidden', array(
            'name'      => 'slider_id'
        ));
		
		$fieldset->addField('name', 'text', array(
            'name'      => 'name',
            'title'     => Mage::helper('events')->__('Name'),
            'label'     => Mage::helper('events')->__('Name'),
            'maxlength' => '250',
            'required'  => true,
        ));
 
        /*$fieldset->addField('main_file_url', 'image', array(
            'name'      => 'main_file_url',
            'title'     => Mage::helper('events')->__('Upload Event Image'),
            'label'     => Mage::helper('events')->__('Upload Event Image'),
            'maxlength' => '250',
            'required'  => true,
        ));*/
		
		/*$fieldset->addField('link_url', 'text', array(
            'name'      => 'link_url',
            'title'     => Mage::helper('events')->__('Image Link'),
            'label'     => Mage::helper('events')->__('Image Link'),
            'maxlength' => '250',
            'required'  => false,
        ));*/
		
		$fieldset->addField('cellege', 'text', array(
            'name'      => 'cellege',
            'title'     => Mage::helper('events')->__('College'),
            'label'     => Mage::helper('events')->__('College'),
            'maxlength' => '255',
            'required'  => false,
        ));	
		
		$fieldset->addField('dated', 'date', array(
          'label'     => Mage::helper('events')->__('Event Date'),
          'title'     => Mage::helper('events')->__('Event Date'),
          'required'  => true,
          'name'      => 'dated',
		  'image'    => $this->getSkinUrl('images/grid-cal.gif'),
		  'input_format' => Varien_Date::DATE_INTERNAL_FORMAT,
          'format'   => Varien_Date::DATE_INTERNAL_FORMAT,
        ));	
		
		$fieldset->addField('showdate', 'select', array(
          'label'     => Mage::helper('events')->__('Show Date'),
          'name'      => 'showdate',
          'values' => array('1' => 'Yes','0' => 'No'),
        ));
		
		$wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig(
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
			'title'     => Mage::helper('events')->__('Event Content'),
            'label'     => Mage::helper('events')->__('Event Content'),
            'style'     => 'height:20em; width:50em;',
            'required'  => true,
            'config'    => $wysiwygConfig
        ));
 
 		$form->setMethod('post');
        $form->setUseContainer(true);
        $form->setId('edit_form');
		$form->setEnctype('multipart/form-data');
        $form->setAction($this->getUrl('*/*/save'));
        $form->setValues(Mage::registry('frozen_tip')->getData());
        
        $this->setForm($form);
    }
}