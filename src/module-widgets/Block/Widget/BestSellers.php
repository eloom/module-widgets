<?php
/**
* 
* Widgets para Magento 2
* 
* @category     Ã©lOOm
* @package      Modulo Widgets
* @copyright    Copyright (c) 2021 Ã©lOOm (https://eloom.tech)
* @version      1.0.0
* @license      https://eloom.tech/license/
*
*/
declare(strict_types=1);

namespace Eloom\Widgets\Block\Widget;

use Magento\Catalog\Block\Product\AbstractProduct;
use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Sales\Model\ResourceModel\Report\Bestsellers\CollectionFactory as BestSellersCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Widget\Block\BlockInterface;

class BestSellers extends AbstractProduct  implements BlockInterface {

	const PRODUCTS_COUNT = 12;

	private $productCollectionFactory;

	private $bestSellersCollectionFactory;

	private $itemCollection;

	public function __construct(Context $context,
	                            StoreManagerInterface $storeManager,
	                            CollectionFactory $productCollectionFactory,
	                            BestSellersCollectionFactory $bestSellersCollectionFactory,
	                            array $data = []) {
		parent::__construct($context, $data);

		$this->storeManager = $storeManager;
		$this->productCollectionFactory = $productCollectionFactory;
		$this->bestSellersCollectionFactory = $bestSellersCollectionFactory;
	}

	private function getStoreId() {
		return $this->storeManager->getStore()->getId();
	}

	public function getProductsCount() {
		if ($this->hasData('products_count')) {
			return $this->getData('products_count');
		}
		if (null === $this->getData('products_count')) {
			$this->setData('products_count', self::PRODUCTS_COUNT);
		}
		
		return $this->getData('products_count');
	}
	
	public function getProductCollection() {
		if (!$this->itemCollection) {
			$productIds = [];
			$bestSellers = $this->bestSellersCollectionFactory->create()->setPeriod('month');
			foreach ($bestSellers as $product) {
				$productIds[] = $product->getProductId();
			}
			$collection = $this->productCollectionFactory->create();
			$collection->addIdFilter($productIds);
			$collection->addMinimalPrice()
				->addFinalPrice()
				->addTaxPercents()
				->addAttributeToSelect('*')
				->addAttributeToFilter('status', \Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED)
				->addAttributeToFilter('visibility', 4)
				->addStoreFilter($this->getStoreId())
				->setPageSize($this->getProductsCount());
			
			$this->itemCollection = $collection;
		}

		return $this->itemCollection;
	}

	public function getAlias() {
		return md5(uniqid('', true));
	}
}