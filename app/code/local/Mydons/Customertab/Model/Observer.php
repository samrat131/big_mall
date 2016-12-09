<?php
class Mydons_Customertab_Model_Observer
{
    /**
     * Flag to stop observer executing more than once
     *
     * @var static bool
     */
    static protected $_singletonFlag = false;
 
    /**
     * This method will run when the product is saved from the Magento Admin
     * Use this function to update the product model, process the 
     * data or anything you like
     *
     * @param Varien_Event_Observer $observer
     */
    public function saveProductTabData(Varien_Event_Observer $observer)
    { 
	
        if (!self::$_singletonFlag) {
            self::$_singletonFlag = true;
             
            $customer = $observer->getEvent()->getCustomer();
			
			$customer_id = $this->_getRequest()->getPost('customer_id');
			$cat_id = $this->_getRequest()->getPost('cat_id');
			$shop_name = $this->_getRequest()->getPost('shop_name');
			$description = $this->_getRequest()->getPost('description');
			
			$credit = $this->_getRequest()->getPost('credit')?$this->_getRequest()->getPost('credit'):0;
			$points = $this->_getRequest()->getPost('points')?$this->_getRequest()->getPost('points'):0;
			$crown_rating = $this->_getRequest()->getPost('crown_rating')?$this->_getRequest()->getPost('crown_rating'):0;
			
			if(is_numeric($customer_id))
			{
				try {
					/**
					 * Perform any actions you want here
					 *
					 */
					$filepath='';
					if(isset($_FILES['image_url']['name']) and $_FILES['image_url']['name']!='' ) 
					{
						try {
							 $uploader = new Varien_File_Uploader('image_url');
							 $uploader->setAllowedExtensions(array('jpg','gif','png'));
							 $uploader->setAllowRenameFiles(false);
							 $uploader->setFilesDispersion(false);
							 
							 $path = Mage::getBaseDir('media').DS."catalog".DS."category".DS;
							 $file_name = str_replace(" ","_",$_FILES['image_url']['name']);
							 $file_name = $customer_id.'_'.time().'_'.strtolower($file_name);
							 $uploader->save($path, $file_name);
							 
						} catch (Exception $e) {
							  
						}
						$filepath = str_replace('&','_',$file_name);
					}
					
					$con_r = Mage::getSingleton('core/resource')->getConnection('core_read');
					$sql = "SELECT * FROM member_info WHERE customer_id=".$customer_id;
					$result = $con_r->query($sql);
					$row = $result->fetch(PDO::FETCH_ASSOC);
					if(!$row)
					{
						$storeId = Mage::app()->getStore()->getId();
						$category = Mage::getModel('catalog/category');
						$category->setStoreId($storeId);
						$parentId = $cat_id; //Mage::app()->getStore($storeId)->getRootCategoryId();
						$parentCategory = Mage::getModel('catalog/category')->load($parentId);
						$category->setPath($parentCategory->getPath());
						
						if($filepath=='') {
							$data = array('name'=>$shop_name, 'description'=>$description, 'is_active'=>'1');
						} else {
							$data = array('name'=>$shop_name, 'description'=>$description, 'is_active'=>'1', 'image'=>$filepath, 'thumbnail'=>$filepath);
						}
						
						$category->addData($data);
						$category->setAttributeSetId($category->getDefaultAttributeSetId());
						try {
							$category->save();
							$child_cat_id = $category->getId();
							$sql = "INSERT INTO `member_info` (`id` ,`customer_id` ,`cat_id`, `image_url`,`child_cat_id`,`shop_name`,`description`,`credit`,`points`,`crown_rating`) VALUES (NULL , ".$customer_id.",".$cat_id.", '".$filepath."', ".$child_cat_id.", '".$shop_name."', '".$description."', ".$credit.", ".$points.", ".$crown_rating.");";
							//echo $sql;
							$con_w = Mage::getSingleton('core/resource')->getConnection('core_write');
							$con_w->query($sql);
						  
						}
						catch (Exception $e){
							echo "Failed <br />";
						}
					} 
					else 
					{
					
						if($filepath=='')
						{
							$sql = "UPDATE `member_info` SET `cat_id`=".$cat_id.", `shop_name` = '".$shop_name."', `description` = '".$description."', `credit` = ".$credit.", `points` = ".$points.", `crown_rating` = ".$crown_rating." WHERE `member_info`.`customer_id`=".$customer_id;
							$data = array('description'=>$description);
						}
						else
						{
							$sql = "UPDATE `member_info` SET `cat_id`=".$cat_id.", `image_url` = '".$filepath."', `shop_name` = '".$shop_name."', `description` = '".$description."', `credit` = ".$credit.", `points` = ".$points.", `crown_rating` = ".$crown_rating." WHERE `member_info`.`customer_id`=".$customer_id;
							$data = array('description'=>$description, 'image'=>$filepath, 'thumbnail'=>$filepath);
						}
						
						//echo $sql;
						$con_w = Mage::getSingleton('core/resource')->getConnection('core_write');
						$con_w->query($sql);
						
						$category = Mage::getModel('catalog/category')->load($row['child_cat_id']);
						$category->addData($data);
						try {
							$category->save();
						} catch (Exception $e){
							echo "Failed <br />";
						}
					}
					 
				}
				catch (Exception $e) {
					Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				}
			}
        }
    }
      
    /**
     * Retrieve the product model
     *
     * @return Mage_Catalog_Model_Product $product
     */
    public function getCustomer()
    {
        return Mage::registry('customer');
    }
     
    /**
     * Shortcut to getRequest
     *
     */
    protected function _getRequest()
    {
        return Mage::app()->getRequest();
    }
}