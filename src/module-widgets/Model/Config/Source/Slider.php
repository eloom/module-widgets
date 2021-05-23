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

namespace Eloom\Widgets\Model\Config\Source;

use Eloom\Widgets\Model\SliderFactory;

class Slider implements \Magento\Framework\Option\ArrayInterface {
	protected $sliderFactory;

	public function __construct(SliderFactory $sliderFactory) {
		$this->sliderFactory = $sliderFactory;
	}

	public function getSliders() {
		$sliderModel = $this->sliderFactory->create();
		return $sliderModel->getCollection()->getData();
	}

	public function toOptionArray() {
		$options = [];
		foreach ($this->getSliders() as $slider) {
			array_push($options, ['value' => $slider['slider_id'], 'label' => $slider['title']]);
		}

		return $options;
	}
}