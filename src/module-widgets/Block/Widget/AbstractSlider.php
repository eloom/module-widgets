<?php
/**
* 
* Widgets para Magento 2
* 
* @category     Ã©lOOm
* @package      Modulo Widgets
* @copyright    Copyright (c) 2021 Ã©lOOm (https://www.eloom.com.br)
* @version      1.0.0
* @license      https://www.eloom.com.br/license/
*
*/
declare(strict_types=1);

namespace Eloom\Widgets\Block\Widget;

use Eloom\Widgets\Helper\Data;
use Eloom\Widgets\Model\SliderFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Widget\Block\BlockInterface;

class AbstractSlider extends Template implements BlockInterface {

	protected $sliderFactory;

	protected $slider;

	protected $sliderHelper;

	protected $scopeConfig;

	protected $itens;
	
	protected $storeManager;

	public function __construct(Context $context,
	                            SliderFactory $sliderFactory,
	                            Data $sliderHelper,
	                            StoreManagerInterface $storeManager,
	                            array $data = []) {
		parent::__construct($context, $data);

		$this->sliderFactory = $sliderFactory;
		$this->sliderHelper = $sliderHelper;
		$this->scopeConfig = $context->getScopeConfig();
		$this->storeManager = $storeManager;
	}

	protected function getStoreId() {
		return $this->storeManager->getStore()->getId();
	}

	public function getSlider() {
		$sliderId = $this->getData('slider');
		if (!$this->slider) {
			$this->slider = $this->sliderFactory->create()->load($sliderId);
		}
		if ($this->slider->getSliderId() != $sliderId) {
			$this->slider = $this->sliderFactory->create()->load($sliderId);
		}
		return $this->slider;
	}

	public function getItemImageUrl(\Eloom\Widgets\Model\Item $item) {
		return $this->sliderHelper->getBaseUrlMedia($item->getImage());
	}
	
	public function getItemMobileImageUrl(\Eloom\Widgets\Model\Item $item) {
		return $this->sliderHelper->getBaseUrlMedia($item->getMobileImage());
	}

	protected function _toHtml() {
		if (!$this->getSlider() || !$this->getItensCollection()->getSize()) {
			return '';
		}

		return parent::_toHtml();
	}

	public function getItensCollection() {
		if (!$this->itens) {
			$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
			$itemCollectionFactory = $objectManager->create('Eloom\Widgets\Model\ResourceModel\Slider\Item\Collection');
			$this->itens = $itemCollectionFactory->getItemCollection($this->getSlider()->getSliderId());
		}

		return $this->itens;
	}

	public function getAlias() {
		return md5(uniqid('', true));
	}
}