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

namespace Eloom\Widgets\Model;

use Eloom\Widgets\Model\ItemFactory;
use Eloom\Widgets\Model\ResourceModel\Slider\CollectionFactory;
use Eloom\Widgets\Model\ResourceModel\Slider\Item\Collection;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Magento\Store\Model\StoreManagerInterface;

class Item extends \Magento\Framework\Model\AbstractModel {

	const BASE_MEDIA_PATH = 'eloom/slider/images';

	const TARGET_SELF = 0;
	const TARGET_BLANK = 1;

	protected $sliderCollectionFactory;

	protected $storeId = null;

	protected $itemFactory;

	protected $formFieldHtmlIdPrefix = 'page_';

	protected $storeManager;

	public function __construct(Context $context,
	                            Registry $registry,
	                            \Eloom\Widgets\Model\ResourceModel\Slider\Item $resource,
	                            Collection $resourceCollection,
	                            ItemFactory $itemFactory,
	                            CollectionFactory $sliderCollectionFactory,
	                            StoreManagerInterface $storeManager) {
		parent::__construct($context, $registry, $resource, $resourceCollection);
		$this->itemFactory = $itemFactory;
		$this->storeManager = $storeManager;
		$this->sliderCollectionFactory = $sliderCollectionFactory;

		if ($storeId = $this->storeManager->getStore()->getId()) {
			$this->storeId = $storeId;
		}
	}

	public function getFormFieldHtmlIdPrefix() {
		return $this->formFieldHtmlIdPrefix;
	}

	public function getAvailableSlides() {
		$option[] = [
			'value' => '',
			'label' => __('Select a slider'),
		];

		$sliderCollection = $this->sliderCollectionFactory->create();
		foreach ($sliderCollection as $slider) {
			$option[] = [
				'value' => $slider->getId(),
				'label' => $slider->getTitle(),
			];
		}

		return $option;
	}

	public function beforeSave() {
		if ($this->getStoreViewId()) {
			$defaultStore = $this->itemFactory->create()->setStoreId(null)->load($this->getId());
			$storeAttributes = $this->getStoreAttributes();
			$data = $this->getData();
			foreach ($storeAttributes as $attribute) {
				if (isset($data['use_default']) && isset($data['use_default'][$attribute])) {
					$this->setData($attribute . '_in_store', false);
				} else {
					$this->setData($attribute . '_in_store', true);
					$this->setData($attribute . '_value', $this->getData($attribute));
				}
				$this->setData($attribute, $defaultStore->getData($attribute));
			}
		}

		return parent::beforeSave();
	}

	public function getStoreViewId() {
		return $this->storeId;
	}

	public function setStoreId($storeId) {
		$this->storeId = $storeId;

		return $this;
	}

	public function getStoreAttributes() {
		return array(
			'title',
			'status',
			'url',
			'target_url',
			'image',
			'mobile_image',
			'description'
		);
	}

	public function afterSave() {
		if ($storeId = $this->getStoreViewId()) {
			$storeAttributes = $this->getStoreAttributes();
		}

		return parent::afterSave();
	}

	public function load($id, $field = null) {
		parent::load($id, $field);
		if ($this->getStoreViewId()) {
			$this->getStoreViewValue();
		}

		return $this;
	}

	public function getStoreViewValue($storeId = null) {
		if (!$storeId) {
			$storeId = $this->getStoreViewId();
		}
		if (!$storeId) {
			return $this;
		}

		return $this;
	}

	public function getTargetValue() {
		switch ($this->getTarget()) {
			case self::TARGET_SELF:
				return '_self';
			case self::TARGET_BLANK:
				return '_parent';
		}
	}
}
