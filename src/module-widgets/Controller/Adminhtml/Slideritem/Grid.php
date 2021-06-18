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

namespace Eloom\Widgets\Controller\Adminhtml\Slideritem;

class Grid extends \Eloom\Widgets\Controller\Adminhtml\Slideritem {
	public function execute() {
		$resultLayout = $this->resultLayoutFactory->create();

		return $resultLayout;
	}
}
