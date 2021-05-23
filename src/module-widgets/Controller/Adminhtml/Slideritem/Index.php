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

namespace Eloom\Widgets\Controller\Adminhtml\Slideritem;

class Index extends \Eloom\Widgets\Controller\Adminhtml\Slideritem {
	public function execute() {
		if ($this->getRequest()->getQuery('ajax')) {
			$resultForward = $this->resultForwardFactory->create();
			$resultForward->forward('grid');

			return $resultForward;
		}

		$resultPage = $this->resultPageFactory->create();

		return $resultPage;
	}
}
