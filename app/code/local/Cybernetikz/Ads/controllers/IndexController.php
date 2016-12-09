<?php
/*
Author: 		Md. Benzir Hasan
Author Email:   benzir@cybernetikz.com
Blog: 			http://blog.cybernetikz.com
Website: 		http://www.cybernetikz.com
*/


class Cybernetikz_Ads_IndexController extends Mage_Core_Controller_Front_Action
{
 
    public function indexAction()
    {
		$this->loadLayout();
		$this->getLayout()->getBlock('content')->append(
			$this->getLayout()->createBlock('ads/index')
    	);
        $this->renderLayout();
    }
    public function updateviewcount2s3fsd4sd32Action()
    {
		$id = $this->getRequest()->getParam('id', false);
		
		$db = Mage::getSingleton('core/resource')->getConnection('core_read');
		$result = $db->query("SELECT * FROM ads WHERE ads_id=".$id);
		if ($result)
		{
			while ($row = $result->fetch(PDO::FETCH_ASSOC))
			{
				$number_view = $row['number_of_view'];
			}
		}
		$number_view = $number_view+1;
		
		$w = Mage::getSingleton('core/resource')->getConnection('core_write');
		$update = "UPDATE ads SET number_of_view=$number_view WHERE ads_id=".$id;
		$result = $w->query($update);
		if (!$result) {
			return false;
		} 
		/*else 
		{
			echo 'update';
		}*/
    }
	
}