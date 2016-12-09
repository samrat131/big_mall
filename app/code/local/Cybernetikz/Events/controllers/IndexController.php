<?php
/*
Author: 		Md. Benzir Hasan
Author Email:   benzir@cybernetikz.com
Blog: 			http://blog.cybernetikz.com
Website: 		http://www.cybernetikz.com
*/


class Cybernetikz_Events_IndexController extends Mage_Core_Controller_Front_Action
{
 
    public function indexAction()
    {
		$this->loadLayout();
		$this->getLayout()->getBlock('content')->append(
			$this->getLayout()->createBlock('events/index')
    	);
        $this->renderLayout();
    }
	
	public function collegeAction() {
		$db = Mage::getSingleton('core/resource')->getConnection('core_read');
		$result = $db->query("SELECT * FROM events WHERE cellege='".trim($_REQUEST['college'])."'");
		if ($result)
		{
			echo '<select style="width:230px" title="event college" class="validate-select" id="billing:EventId" name="billing[EventId]">';
			$out ='';
			while ($row = $result->fetch(PDO::FETCH_ASSOC))
			{
				$out .= '<option value="'.$row['slider_id'].'">'.$row['name'];
				if($row['showdate']==1)
					$out .= ' &ndash; '.$row['dated'].'</option>';
				else
					$out .= '</option>';
			}
			echo $out.'</select>';
		}
	} 	
}