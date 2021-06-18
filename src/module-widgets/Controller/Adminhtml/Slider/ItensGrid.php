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

namespace Eloom\Widgets\Controller\Adminhtml\Slider;

class ItensGrid extends \Eloom\Widgets\Controller\Adminhtml\Slider {
	public function execute() {
		$resultLayout = $this->resultLayoutFactory->create();
		$resultLayout->getLayout()->getBlock('itenslider.slider.edit.tab.itens');//->setInItem($this->getRequest()->getPost('item', null));

		return $resultLayout;
	}
}
