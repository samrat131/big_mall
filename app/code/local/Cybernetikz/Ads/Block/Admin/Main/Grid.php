<?php
/*
Author: 		Md. Benzir Hasan
Author Email:   benzir@cybernetikz.com
Blog: 			http://blog.cybernetikz.com
Website: 		http://www.cybernetikz.com
*/


class Cybernetikz_Ads_Block_Admin_Main_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
 
    public function __construct()
    {
        parent::__construct();
        $this->setId('adsGrid');
        $this->_controller = 'ads';
    }
 
    protected function _prepareCollection()
    {
        $model = Mage::getModel('ads/tip');
        $collection = $model->getCollection();
		$this->setCollection($collection);
 
        return parent::_prepareCollection();
    }
 
 
 
    protected function _prepareColumns()
    {
 
        $this->addColumn('ads_id', array(
            'header'        => Mage::helper('ads')->__('ID'),
            'align'         => 'right',
            'width'         => '50px',
            'filter'    	=> false,
            'index'         => 'ads_id',
        ));
 
        $this->addColumn('name', array(
            'header'        => Mage::helper('ads')->__('Ads Name'),
            'align'         => 'left',
            'width'         => '400px',
            'filter'    	=> false,
            'index'         => 'name',
            'truncate'      => 50,
            'escape'        => false,
        ));
		
		$this->addColumn('link_url', array(
            'header'    	=> Mage::helper('ads')->__('Link Url'),
            'align'         => 'left',
			'width'         => '300px',
			'index'         => 'link_url',
            'filter'    	=> false,
            'escape'		=> true,
        ));
 
        $this->addColumn('place', array(
            'header'    	=> Mage::helper('ads')->__('Place'),
            'align'         => 'left',
			'width'         => '400px',
			'index'         => 'place',
            'filter'    	=> false,
            'escape'		=> true,
        ));
		
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
		
		
        $this->addColumn('number_of_view', array(
            'header'    	=> Mage::helper('ads')->__('Number of click'),
            'align'         => 'left',
			'width'         => '400px',
			'index'         => 'number_of_view',
            'filter'    	=> false,
            'escape'		=> true,
        ));
		
        $this->addColumn('action',
            array(
                'header'    => Mage::helper('ads')->__('Action'),
                'width'     => '150px',
                'type'      => 'action',
                'getter'	=> 'getAdsId',
                'actions'   => array(
                    array(
                        'caption' => Mage::helper('ads')->__('Edit'),
                        'url'     => array(
                            'base'=>'*/*/edit'
                         ),
                         'field'   => 'id'
                    ),
                    array(
                        'caption' => Mage::helper('ads')->__('Delete'),
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
            'id' => $row->getAdsId(),
        ));
    }
}