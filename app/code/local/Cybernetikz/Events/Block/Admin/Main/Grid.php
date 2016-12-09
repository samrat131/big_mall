<?php
/*
Author: 		Md. Benzir Hasan
Author Email:   benzir@cybernetikz.com
Blog: 			http://blog.cybernetikz.com
Website: 		http://www.cybernetikz.com
*/


class Cybernetikz_Events_Block_Admin_Main_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
 
    public function __construct()
    {
        parent::__construct();
        $this->setId('eventsGrid');
        $this->_controller = 'events';
    }
 
    protected function _prepareCollection()
    {
        $model = Mage::getModel('events/tip');
        $collection = $model->getCollection();
		$this->setCollection($collection);
 
        return parent::_prepareCollection();
    }
 
 
 
    protected function _prepareColumns()
    {
 
        $this->addColumn('slider_id', array(
            'header'        => Mage::helper('events')->__('ID'),
            'align'         => 'right',
            'width'         => '50px',
            'filter'    	=> false,
            'index'         => 'slider_id',
        ));
 
        $this->addColumn('name', array(
            'header'        => Mage::helper('events')->__('Event Name'),
            'align'         => 'left',
            'width'         => '400px',
            'filter'    	=> false,
            'index'         => 'name',
            'truncate'      => 50,
            'escape'        => false,
        ));
		
		$this->addColumn('cellege', array(
            'header'    	=> Mage::helper('events')->__('College'),
            'align'         => 'left',
			'width'         => '300px',
			'index'         => 'cellege',
            'filter'    	=> false,
            'escape'		=> true,
        ));
		
		$this->addColumn('dated', array(
            'header'    	=> Mage::helper('events')->__('Date'),
            'align'         => 'left',
			'width'         => '300px',
			'index'         => 'dated',
            'filter'    	=> false,
            'escape'		=> true,
        ));
		
 
        /*$this->addColumn('content', array(
            'header'    	=> Mage::helper('events')->__('Content'),
            'align'         => 'left',
			'width'         => '400px',
			'index'         => 'content',
            'filter'    	=> false,
            'escape'		=> true,
        ));*/
 
		
        $this->addColumn('action',
            array(
                'header'    => Mage::helper('events')->__('Action'),
                'width'     => '150px',
                'type'      => 'action',
                'getter'	=> 'getSliderId',
                'actions'   => array(
                    array(
                        'caption' => Mage::helper('events')->__('Edit'),
                        'url'     => array(
                            'base'=>'*/*/edit'
                         ),
                         'field'   => 'id'
                    ),
                    array(
                        'caption' => Mage::helper('events')->__('Delete'),
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