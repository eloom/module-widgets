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

class Carousel extends AbstractSkeleton {
	
	protected $_template = "widget/carousel.phtml";
	
	public function getJsonConfig() {
		return $this->jsonEncoder->encode([
			'layout' => $this->getData('layout'),
			'slider' => $this->getData('slider'),
			'width' => $this->getData('width'),
			'height' => $this->getData('height')
		]);
	}
}