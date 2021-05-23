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

namespace Eloom\Widgets\Block\Adminhtml\Slider\Edit\Tab\Helper\Renderer;

use Magento\Backend\Block\Context;

class EditItem extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer {

	public function __construct(Context $context, array $data = []) {
		parent::__construct($context, $data);
	}

	public function render(\Magento\Framework\DataObject $row) {
		return '<a href="' . $this->getUrl('*/slideritem/edit', ['_current' => FALSE, 'item_id' => $row->getId()]) . '" target="_blank">Edit</a> ';
	}
}