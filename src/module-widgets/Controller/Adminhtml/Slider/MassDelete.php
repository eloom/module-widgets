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

namespace Eloom\Widgets\Controller\Adminhtml\Slider;

use Magento\Framework\Controller\ResultFactory;

class MassDelete extends \Eloom\Widgets\Controller\Adminhtml\AbstractAction {

	public function execute() {
		$sliderIds = $this->getRequest()->getParam('slider');
		if (!is_array($sliderIds) || empty($sliderIds)) {
			$this->messageManager->addErrorMessage(__('Please select slider(s).'));
		} else {
			try {
				foreach ($sliderIds as $sliderUd) {
					$slider = $this->_objectManager->create('Eloom\Widgets\Model\Slider')
						->load($sliderUd);
					$slider->delete();
				}
				$this->messageManager->addSuccessMessage(
					__('A total of %1 record(s) have been deleted.', count($sliderIds))
				);
			} catch (\Exception $e) {
				$this->messageManager->addErrorMessage($e->getMessage());
			}
		}
		$resultRedirect = $this->resultRedirectFactory->create();
		return $resultRedirect->setPath('*/*/');
	}
}
