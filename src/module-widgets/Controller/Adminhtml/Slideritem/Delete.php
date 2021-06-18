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

class Delete extends \Eloom\Widgets\Controller\Adminhtml\Slideritem {
	public function execute() {
		$itemId = $this->getRequest()->getParam(static::PARAM_CRUD_ID);
		try {
			$item = $this->itemFactory->create()->setId($itemId);
			$item->delete();
			$this->messageManager->addSuccess(__('Delete successfully!'));
		} catch (\Exception $e) {
			$this->messageManager->addError($e->getMessage());
		}

		$resultRedirect = $this->resultRedirectFactory->create();

		return $resultRedirect->setPath('*/*/');
	}
}
