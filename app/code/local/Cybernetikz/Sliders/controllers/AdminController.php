<?php
/*
Author: 		Md. Benzir Hasan
Author Email:   benzir@cybernetikz.com
Blog: 			http://blog.cybernetikz.com
Website: 		http://www.cybernetikz.com
*/


class Cybernetikz_Sliders_AdminController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
    {
		$this->loadLayout()
			->_addContent($this->getLayout()->createBlock('sliders/admin_main'))
			->renderLayout();
    }
 
	public function deleteAction()
    {
        $tipId = $this->getRequest()->getParam('id', false);
 
        try {
            Mage::getModel('sliders/tip')->setId($tipId)->delete();
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('sliders')->__('Slider successfully deleted'));
            $this->getResponse()->setRedirect($this->getUrl('*/*/'));
 
            return;
        } catch (Exception $e){
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
 
        $this->_redirectReferer();
    }
 
    public function newAction()
    {
        $this->loadLayout()
        ->_addContent($this->getLayout()->createBlock('sliders/admin_new'))
        ->renderLayout();
    }
 
    public function postAction()
    {
        if ($data = $this->getRequest()->getPost()) {
			//Slider Image file
        	if(isset($_FILES['main_file_url']['name']) && $_FILES['main_file_url']['name'] != '') {
				try {	
					/* Starting upload */	
					$uploader = new Varien_File_Uploader('main_file_url');
					// Any extention would work
	           		$uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
					$uploader->setAllowRenameFiles(false);
					$uploader->setFilesDispersion(false);
					// We set media as the upload dir
					$path = Mage::getBaseDir('media'). DS . "slider" . DS ;
				
					$filename = $_FILES['main_file_url']['name'];		
					$parts = explode('.',$filename);
					$file_type =  strtolower($parts[count($parts)-1]);
					$image_file_name = time().'_'.$filename;
					
					/*if($filename && ($file_type == "pdf")):
					   $im = new imagick( $file_path . $image_file_name . "[0]");						
					   $im->setimagebackgroundcolor("#FFFFFF");
					   $im->setCompression(Imagick::COMPRESSION_JPEG);
					   $im->setCompressionQuality(100);
					   $im->setImageFormat('jpeg');
									
					   $im->resizeImage(250, 250, imagick::FILTER_LANCZOS, 1);
				
					   //write image on server
					   $im->writeImage($file_path . "thumb_".$image_file_name.".jpg");
					   $im->clear();
					   $im->destroy();				   
					   $thumb_image_file_name = "thumb_".$image_file_name.".jpg";
					   
					endif;*/
					
					//$uploader->save($path, $thumb_image_file_name);
					$uploader->save($path, $_FILES['main_file_url']['name'] );
				} catch (Exception $e) {
    	            $this->_getSession()->addException($e, Mage::helper('sliders')->__('Error uploading file. Please try again later.'));
		        }
				//$data['thumb_image_url']= "slider/".$thumb_image_file_name;
	  			$data['main_file_url'] = "slider/".$_FILES['main_file_url']['name'];
			}
			else
			{
				if(isset($data['main_file_url']['delete']) && $data['main_file_url']['delete'] == 1):
					$data["main_file_url"]="";
					//$data['thumb_image_url'] = "";
				else:
					unset($data["main_file_url"]);
					//unset($data['thumb_image_url']);
				endif;
			}
            $tip = Mage::getModel('sliders/tip')->setData($data);
            try {
                $tip->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('sliders')->__('Slider was successfully saved'));
                $this->getResponse()->setRedirect($this->getUrl('*/*/'));
                return;
            } catch (Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->getResponse()->setRedirect($this->getUrl('*/*/'));
        return;
    }
    
    public function editAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('sliders/admin_edit'));
        $this->renderLayout();
    }
 
    public function saveAction()
    {
        $data = $this->getRequest()->getPost();
		$tipId = $data['slider_id'];
        if ($data = $this->getRequest()->getPost()) {
            //Slider Image file
        	if(isset($_FILES['main_file_url']['name']) && $_FILES['main_file_url']['name'] != '') {
				try {	
					/* Starting upload */	
					$uploader = new Varien_File_Uploader('main_file_url');
					// Any extention would work
	           		$uploader->setAllowedExtensions(array('pdf','jpg','jpeg','gif','png'));
					$uploader->setAllowRenameFiles(false);
					$uploader->setFilesDispersion(false);
					// We set media as the upload dir
					$path = Mage::getBaseDir('media'). DS . "slider" . DS ;
				
					$filename = $_FILES['main_file_url']['name'];		
					$parts = explode('.',$filename);
					$file_type =  strtolower($parts[count($parts)-1]);
					$image_file_name = time().'_'.$filename;
					
					/*if($filename && ($file_type == "pdf")):
					   $im = new imagick( $file_path . $image_file_name . "[0]");						
					   $im->setimagebackgroundcolor("#FFFFFF");
					   $im->setCompression(Imagick::COMPRESSION_JPEG);
					   $im->setCompressionQuality(100);
					   $im->setImageFormat('jpeg');
									
					   $im->resizeImage(250, 250, imagick::FILTER_LANCZOS, 1);
				
					   //write image on server
					   $im->writeImage($file_path . "thumb_".$image_file_name.".jpg");
					   $im->clear();
					   $im->destroy();				   
					   $thumb_image_file_name = "thumb_".$image_file_name.".jpg";
					   
					endif;*/
					
					//$uploader->save($path, $thumb_image_file_name);
					$uploader->save($path, $_FILES['main_file_url']['name'] );
				} catch (Exception $e) {
    	            $this->_getSession()->addException($e, Mage::helper('sliders')->__('Error uploading file. Please try again later.'));
		        }
				//$data['thumb_image_url']= "slider/".$thumb_image_file_name;
	  			$data['main_file_url'] = "slider/".$_FILES['main_file_url']['name'];
			}
			else
			{
				if(isset($data['main_file_url']['delete']) && $data['main_file_url']['delete'] == 1):
					$data["main_file_url"]="";
					//$data['thumb_image_url'] = "";
				else:
					unset($data["main_file_url"]);
					//unset($data['thumb_image_url']);
				endif;
			}
			
			$tip = Mage::getModel('sliders/tip')->load($tipId)->addData($data);
            try {
                $tip->setId($tipId)->save();
 
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('sliders')->__('Slider successfully updated'));
                $this->getResponse()->setRedirect($this->getUrl('*/*/'));
                return;
            } catch (Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirectReferer();
    }
	
}