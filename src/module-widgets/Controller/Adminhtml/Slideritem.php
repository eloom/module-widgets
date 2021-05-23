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

namespace Eloom\Widgets\Controller\Adminhtml;

abstract class Slideritem extends \Eloom\Widgets\Controller\Adminhtml\AbstractAction {
	const PARAM_CRUD_ID = 'item_id';

	protected function _isAllowed() {
		return $this->_authorization->isAllowed('Eloom_Widgets::slider_itens');
	}

	protected function _getBackResultRedirect(\Magento\Framework\Controller\Result\Redirect $resultRedirect, $paramCrudId = null) {
		switch ($this->getRequest()->getParam('back')) {
			case 'edit':
				$resultRedirect->setPath(
					'*/*/edit',
					[
						static::PARAM_CRUD_ID => $paramCrudId,
						'_current' => true,
						'store' => $this->getRequest()->getParam('store'),
						'current_slider_id' => $this->getRequest()->getParam('current_slider_id'),
						'saveandclose' => $this->getRequest()->getParam('saveandclose'),
					]
				);
				break;
			case 'new':
				$resultRedirect->setPath('*/*/new', ['_current' => true]);
				break;
			default:
				$resultRedirect->setPath('*/*/');
		}

		return $resultRedirect;
	}
}
