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

namespace Eloom\Widgets\Model\ResourceModel\Slider\Item\Grid;

class StatusesArray implements \Magento\Framework\Option\ArrayInterface {
	const ENABLED = 1;
	const DISABLED = 2;

	public function toOptionArray() {
		return [self::ENABLED => __('Enabled'), self::DISABLED => __('Disabled')];
	}
}
