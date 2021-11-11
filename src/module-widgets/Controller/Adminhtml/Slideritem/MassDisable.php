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

use Eloom\Widgets\Model\ResourceModel\Slider\Item\Grid\StatusesArray;
use Magento\Framework\Controller\ResultFactory;

class MassDisable extends \Eloom\Widgets\Controller\Adminhtml\AbstractAction {

	public function execute() {

		$collection = $this->massActionFilter->getCollection($this->_createMainCollection());
		$collectionSize = $collection->getSize();
		$storeId = $this->getRequest()->getParam('store');
		$collection->setStoreId($storeId);
		foreach ($collection as $item) {
			$item->setStoreId($storeId);
			$item->setStatus(StatusesArray::DISABLED);
			try {
				$item->save();

			} catch (\Exception $e) {
				$this->messageManager->addError($e->getMessage());
			}
		}

		$this->messageManager->addSuccess(__('A total of %1 record(s) have been disabled.', $collectionSize));

		$resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

		return $resultRedirect->setPath('*/*/');
	}
}
