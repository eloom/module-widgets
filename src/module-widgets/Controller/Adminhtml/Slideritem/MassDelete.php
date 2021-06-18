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

use Magento\Framework\Controller\ResultFactory;

class MassDelete extends \Eloom\Widgets\Controller\Adminhtml\AbstractAction {

	public function execute() {
		$collection = $this->massActionFilter->getCollection($this->_createMainCollection());

		$collectionSize = $collection->getSize();
		foreach ($collection as $item) {
			$item->delete();
		}

		$this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $collectionSize));

		$resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
		return $resultRedirect->setPath('*/*/');
	}
}
