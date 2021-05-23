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

use Eloom\Widgets\Model\ResourceModel\Slider\Item\Grid\StatusesArray;
use Magento\Framework\Controller\ResultFactory;

class MassEnable extends \Eloom\Widgets\Controller\Adminhtml\AbstractAction {

	public function execute() {
		$sliderCollection = $this->_objectManager->create('Eloom\Widgets\Model\ResourceModel\Slider\Collection');
		$collection = $this->massActionFilter->getCollection($sliderCollection);
		$collectionSize = $collection->getSize();
		foreach ($collection as $item) {
			$item->setStatus(StatusesArray::STATUS_ENABLED);
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
