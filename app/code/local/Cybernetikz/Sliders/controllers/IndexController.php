<?php
/*
Author: 		Md. Benzir Hasan
Author Email:   benzir@cybernetikz.com
Blog: 			http://blog.cybernetikz.com
Website: 		http://www.cybernetikz.com
*/


class Cybernetikz_Sliders_IndexController extends Mage_Core_Controller_Front_Action
{
 
    public function indexAction()
    {
		$this->loadLayout();
		$this->getLayout()->getBlock('content')->append(
			$this->getLayout()->createBlock('sliders/index')
    	);
        $this->renderLayout();
    }
}