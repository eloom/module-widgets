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

use Eloom\Widgets\Helper\Data;
use Eloom\Widgets\Model\SliderFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\StoreManagerInterface;

class MultipleCarousel extends AbstractSlider {

	public function __construct(Context $context,
	                            SliderFactory $sliderFactory,
	                            Data $sliderHelper,
	                            StoreManagerInterface $storeManager,
	                            array $data = []) {
		parent::__construct($context, $sliderFactory, $sliderHelper, $storeManager, $data);
	}

	public function getCssStyle() {
		$bgColor = $this->getData('bg_color');
		$color = $this->getData('color');

		$style = [];
		if(!empty($bgColor)) {
			$style[] = 'background-color:' . $bgColor;
		}
		if(!empty($color)) {
			$style[] = 'color:' . $color;
		}

		return implode(';', $style);
	}
}