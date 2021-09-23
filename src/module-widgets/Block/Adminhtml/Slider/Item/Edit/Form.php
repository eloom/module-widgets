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

namespace Eloom\Widgets\Block\Adminhtml\Slider\Item\Edit;

class Form extends \Magento\Backend\Block\Widget\Form\Generic {
	
	protected function _prepareForm() {
		$form = $this->_formFactory->create(
			array(
				'data' => array(
					'id' => 'edit_form',
					'action' => $this->getUrl('*/*/save', ['store' => $this->getRequest()->getParam('store')]),
					'method' => 'post',
					'enctype' => 'multipart/form-data',
				),
			)
		);
		$form->setUseContainer(true);
		$this->setForm($form);

		return parent::_prepareForm();
	}
}
