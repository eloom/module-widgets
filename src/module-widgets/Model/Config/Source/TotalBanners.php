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

class TotalBanners implements \Magento\Framework\Option\ArrayInterface {

	public function toOptionArray() {
		return [
			['value' => 1, 'label' => __('1 banner for line')],
			['value' => 2, 'label' => __('2 banners for line')],
			['value' => 3, 'label' => __('3 banners for line')],
			['value' => 4, 'label' => __('4 banners for line')]
		];
	}
}