<?php
/*
Author: 		Md. Benzir Hasan
Author Email:   benzir@cybernetikz.com
Blog: 			http://blog.cybernetikz.com
Website: 		http://www.cybernetikz.com
*/


class Cybernetikz_Videos_Block_Admin_Main_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
 
    public function __construct()
    {
        parent::__construct();
        $this->setId('videosGrid');
        $this->_controller = 'videos';
    }
 
    protected function _prepareCollection()
    {
        $model = Mage::getModel('videos/tip');
        $collection = $model->getCollection();
		$this->setCollection($collection);
 
        return parent::_prepareCollection();
    }
 
 
 
    protected function _prepareColumns()
    {
 
        $this->addColumn('video_id', array(
            'header'        => Mage::helper('videos')->__('ID'),
            'align'         => 'right',
            'width'         => '50px',
            'filter'    	=> false,
            'index'         => 'video_id',
        ));
 
        $this->addColumn('name', array(
            'header'        => Mage::helper('videos')->__('Video Name'),
            'align'         => 'left',
            'width'         => '400px',
            'filter'    	=> false,
            'index'         => 'name',
            'truncate'      => 50,
            'escape'        => false,
        ));
		
		$this->addColumn('end_date', array(
            'header'    	=> Mage::helper('videos')->__('End Date'),
            'align'         => 'left',
			'width'         => '300px',
			'index'         => 'end_date',
            'filter'    	=> false,
            'escape'		=> true,
        ));
 
        /*$this->addColumn('content', array(
            'header'    	=> Mage::helper('videos')->__('Content'),
            'align'         => 'left',
			'width'         => '400px',
			'index'         => 'content',
            'filter'    	=> false,
            'escape'		=> true,
        ));*/
 
		
        $this->addColumn('action',
            array(
                'header'    => Mage::helper('videos')->__('Action'),
                'width'     => '150px',
                'type'      => 'action',
                'getter'	=> 'getVideoId',
                'actions'   => array(
                    array(
                        'caption' => Mage::helper('videos')->__('Edit'),
                        'url'     => array(
                            'base'=>'*/*/edit'
                         ),
                         'field'   => 'id'
                    ),
                    array(
                        'caption' => Mage::helper('videos')->__('Delete'),
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
            'id' => $row->getVideoId(),
        ));
    }
}