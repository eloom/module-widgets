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

class MultipleCarousel extends AbstractSkeleton {
	
	public function getJsonConfig() {
		return $this->jsonEncoder->encode([
			'slider' => $this->getData('slider'),
			'bg_color' => $this->getData('bg_color'),
			'color' => $this->getData('color'),
			'template' => 'lazy/' . $this->getData('template')
		]);
	}
}