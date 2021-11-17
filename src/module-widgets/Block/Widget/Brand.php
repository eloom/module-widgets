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

use Magento\Widget\Block\BlockInterface;
use Magento\Framework\DataObject\IdentityInterface;

class Brand extends \Eloom\ThemeFrontend\Block\Brand\Brand implements BlockInterface, IdentityInterface {

	const DEFAULT_CACHE_TAG = 'ELOOM_BRAND_WIDGET';

	protected $_template = "lazy/widget/brand.phtml";

	protected function _construct() {
		parent::_construct();
	}

	protected function getCacheLifetime() {
		return parent::getCacheLifetime() ?: 86400;
	}

	public function getCacheKeyInfo() {
		$keyInfo = parent::getCacheKeyInfo();
		$keyInfo[] = $this->_storeManager->getStore()->getStoreId();

		return $keyInfo;
	}

	/**
	 * @return array
	 */
	public function getIdentities() {
		return [self::DEFAULT_CACHE_TAG, self::DEFAULT_CACHE_TAG . '_' . $this->_storeManager->getStore()->getStoreId()];
	}

	public function getItems() {
		return $this->getBrandCollection();
	}

	public function getUrlBrand($brand) {
		return $this->helper->getLink($brand);
	}
}
