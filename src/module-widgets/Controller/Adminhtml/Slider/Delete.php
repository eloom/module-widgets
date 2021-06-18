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

class Delete extends \Eloom\Widgets\Controller\Adminhtml\Slider {

	public function execute() {
		$sliderId = $this->getRequest()->getParam(static::PARAM_CRUD_ID);
		try {
			$slider = $this->sliderFactory->create()->setId($sliderId);
			$slider->delete();
			$this->messageManager->addSuccess(__('Delete successfully!'));
		} catch (\Exception $e) {
			$this->messageManager->addError($e->getMessage());
		}
		$resultRedirect = $this->resultRedirectFactory->create();

		return $resultRedirect->setPath('*/*/');
	}
}
