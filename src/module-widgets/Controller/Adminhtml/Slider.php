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

abstract class Slider extends \Eloom\Widgets\Controller\Adminhtml\AbstractAction {

	protected function _isAllowed() {
		return $this->_authorization->isAllowed('Eloom_Widgets::slider');
	}
}