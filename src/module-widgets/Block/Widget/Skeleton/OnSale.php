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

class OnSale extends AbstractSkeleton {
	
	public function getJsonConfig() {
		if (!$this->hasData('template')) {
			$this->setData('template', 'widget/on-sale/grid.phtml');
		}
		
		return $this->jsonEncoder->encode([
			'products_count' => $this->getData('products_count'),
			'template' => 'lazy/' . $this->getData('template')
		]);
	}
}