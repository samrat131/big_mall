<?php
class Excellence_Collection_Block_Collection extends Mage_Catalog_Block_Product_List
{

	protected function _getProductCollection()
	{
	
		//Mage::getSingleton('catalogsearch/fulltext')->rebuildIndex();
		//Mage::getSingleton('cataloginventory/stock_status')->rebuild();
		//Mage::getResourceModel('catalog/category_flat')->rebuild();
		//Mage::getResourceModel('catalog/product_flat_indexer')->rebuild();
		//Mage::getSingleton('catalog/index')->rebuild();
		
		
		if (is_null($this->_productCollection)) {
			$collection = Mage::getModel('catalog/product')->getCollection();
			$collection
			->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes())
			->addAttributeToFilter('attribute_set_id', 4)
			->setOrder('created_at', 'desc')
			->addMinimalPrice()
			->addFinalPrice()
			->addTaxPercents();

			//Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
			//Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);
			$this->_productCollection = $collection;

		}
		return $this->_productCollection;
	}
}