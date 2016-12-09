<?php
/*
Author: 		Md. Benzir Hasan
Author Email:   benzir@cybernetikz.com
Blog: 			http://blog.cybernetikz.com
Website: 		http://www.cybernetikz.com
*/


class Cybernetikz_Sliders_Block_Admin_Main_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
 
    public function __construct()
    {
        parent::__construct();
        $this->setId('slidersGrid');
        $this->_controller = 'sliders';
    }
 
    protected function _prepareCollection()
    {
        $model = Mage::getModel('sliders/tip');
        $collection = $model->getCollection();
		$this->setCollection($collection);
 
        return parent::_prepareCollection();
    }
 
 
 
    protected function _prepareColumns()
    {
 
        $this->addColumn('slider_id', array(
            'header'        => Mage::helper('sliders')->__('ID'),
            'align'         => 'right',
            'width'         => '50px',
            'filter'    	=> false,
            'index'         => 'slider_id',
        ));
 
        $this->addColumn('name', array(
            'header'        => Mage::helper('sliders')->__('Slider Name'),
            'align'         => 'left',
            'width'         => '400px',
            'filter'    	=> false,
            'index'         => 'name',
            'truncate'      => 50,
            'escape'        => false,
        ));
		
		$this->addColumn('link_url', array(
            'header'    	=> Mage::helper('sliders')->__('Link Url'),
            'align'         => 'left',
			'width'         => '300px',
			'index'         => 'link_url',
            'filter'    	=> false,
            'escape'		=> true,
        ));
 
        /*$this->addColumn('content', array(
            'header'    	=> Mage::helper('sliders')->__('Content'),
            'align'         => 'left',
			'width'         => '400px',
			'index'         => 'content',
            'filter'    	=> false,
            'escape'		=> true,
        ));*/
 
        $this->addColumn('start_date', array(
            'header'    	=> Mage::helper('ads')->__('Start date'),
            'align'         => 'left',
			'width'         => '400px',
			'index'         => 'start_date',
            'filter'    	=> false,
            'escape'		=> true,
        ));
        $this->addColumn('end_date', array(
            'header'    	=> Mage::helper('ads')->__('End date'),
            'align'         => 'left',
			'width'         => '400px',
			'index'         => 'end_date',
            'filter'    	=> false,
            'escape'		=> true,
        ));
 
		
        $this->addColumn('action',
            array(
                'header'    => Mage::helper('sliders')->__('Action'),
                'width'     => '150px',
                'type'      => 'action',
                'getter'	=> 'getSliderId',
                'actions'   => array(
                    array(
                        'caption' => Mage::helper('sliders')->__('Edit'),
                        'url'     => array(
                            'base'=>'*/*/edit'
                         ),
                         'field'   => 'id'
                    ),
                    array(
                        'caption' => Mage::helper('sliders')->__('Delete'),
                        'url'     => array(
                            'base'=>'*/*/delete'
                         ),
                         'field'   => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false
        ));
 
        return parent::_prepareColumns();
    }
 
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array(
            'id' => $row->getSliderId(),
        ));
    }
}