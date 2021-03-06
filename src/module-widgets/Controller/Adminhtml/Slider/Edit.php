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

class Edit extends \Eloom\Widgets\Controller\Adminhtml\Slider {

	public function execute() {
		$resultPage = $this->resultPageFactory->create();

		$id = $this->getRequest()->getParam('slider_id');
		$model = $this->sliderFactory->create();

		if ($id) {
			$model->load($id);
			if (!$model->getId()) {
				$this->messageManager->addError(__('This slider no longer exists.'));

				$resultRedirect = $this->resultRedirectFactory->create();

				return $resultRedirect->setPath('*/*/');
			}
		}

		$data = $this->_getSession()->getFormData(true);

		if (!empty($data)) {
			$model->setData($data);
		}
		$this->coreRegistry->register('slider', $model);

		return $resultPage;
	}
}
