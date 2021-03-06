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

namespace Eloom\Widgets\Block\Adminhtml\Widget\Form;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Data\Form\Element\Factory;

class Textarea extends Template {

	protected $elementFactory;

	public function __construct(Context $context, Factory $elementFactory, array $data = []) {
		$this->elementFactory = $elementFactory;
		parent::__construct($context, $data);
	}

	public function prepareElementHtml(AbstractElement $element) {
		$input = $this->elementFactory->create("textarea", ['data' => $element->getData()]);
		$input->setId($element->getId());
		$input->setForm($element->getForm());
		$input->setClass("widget-option input-textarea admin__control-text");
		if ($element->getRequired()) {
			$input->addClass('required-entry');
		}
		$element->setData('after_element_html', $input->getElementHtml());
		$element->setValue('');

		return $element;
	}
}