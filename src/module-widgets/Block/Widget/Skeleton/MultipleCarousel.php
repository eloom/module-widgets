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

class MultipleCarousel extends AbstractSkeleton {
	
	public function getJsonConfig() {
		$template = $this->getData('template') ?? 'widget/multiple-carousel/on-left.phtml';
		
		return $this->jsonEncoder->encode([
			'slider' => $this->getData('slider'),
			'bg_color' => $this->getData('bg_color'),
			'color' => $this->getData('color'),
			'template' => 'lazy/' . $template
		]);
	}
}