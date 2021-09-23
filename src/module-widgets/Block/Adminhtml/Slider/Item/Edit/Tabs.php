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

class Tabs extends \Magento\Backend\Block\Widget\Tabs {
	
	protected function _construct() {
		parent::_construct();
		$this->setId('slideritem_tabs');
		$this->setDestElementId('edit_form');
		$this->setTitle(__('Slider item Information'));
	}
}