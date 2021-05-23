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

namespace Eloom\Widgets\Block\Widget\Skeleton;

class NewProduct extends AbstractSkeleton {
	
	public function getJsonConfig() {
		return $this->jsonEncoder->encode([
			'display_type' => $this->getData('display_type'),
			'products_count' => $this->getData('products_count'),
			'products_per_page' => $this->getData('products_per_page'),
			'template' => 'lazy/' . $this->getData('template')
		]);
	}
}