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

namespace Eloom\Widgets\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class Slider extends Container {

	protected function _construct() {
		$this->_controller = 'adminhtml_slider';
		$this->_blockGroup = 'Eloom_Widgets';
		$this->_headerText = __('Sliders');
		$this->_addButtonLabel = __('Add Slider');

		parent::_construct();
	}
}
