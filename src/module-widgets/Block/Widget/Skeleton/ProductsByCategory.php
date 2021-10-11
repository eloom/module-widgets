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

namespace Eloom\Widgets\Block\Widget\Skeleton;

class ProductsByCategory extends AbstractSkeleton {
	
	public function getJsonConfig() {
		if (!$this->hasData('template')) {
			$this->setData('template', 'widget/product/grid.phtml');
		}
		if (!$this->hasData('products_per_page')) {
			$this->setData('products_per_page', \Eloom\Widgets\Block\Widget\ProductsByCategory::DEFAULT_PRODUCTS_PER_PAGE);
		}
		/**
		 * load all for carousel
		 */
		if (strpos($this->getData('template'), 'carousel')) {
			$this->setData('products_per_page', $this->getData('products_count'));
		}
		
		return $this->jsonEncoder->encode([
			'id_path' => $this->getData('id_path'),
			'title' => $this->getData('title'),
			'products_count' => $this->getData('products_count'),
			'products_per_page' => $this->getData('products_per_page'),
			'page_var_name' => 'np',
			'template' => 'lazy/' . $this->getData('template')
		]);
	}
}