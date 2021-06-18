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

namespace Eloom\Widgets\Block\Adminhtml\Slider\Item\Edit\Tab;

use Eloom\Widgets\Model\SliderFactory;
use Eloom\Widgets\Model\Status;
use Magento\Backend\Block\Template\Context;
use Magento\Cms\Model\Wysiwyg\Config;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\DataObjectFactory;
use Magento\Framework\Registry;

class Item extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface {

	protected $objectFactory;

	protected $sliderFactory;

	protected $item;

	protected $wysiwygConfig;

	public function __construct(Context $context,
	                            Registry $registry,
	                            FormFactory $formFactory,
	                            DataObjectFactory $objectFactory,
	                            \Eloom\Widgets\Model\Item $item,
	                            SliderFactory $sliderFactory,
	                            Config $wysiwygConfig,
	                            array $data = []) {
		$this->objectFactory = $objectFactory;
		$this->item = $item;
		$this->sliderFactory = $sliderFactory;
		$this->wysiwygConfig = $wysiwygConfig;
		parent::__construct($context, $registry, $formFactory, $data);
	}

	public function getTabLabel() {
		return __('Slider Item Information');
	}

	public function getTabTitle() {
		return __('Slider Item Information');
	}

	/**
	 * {@inheritdoc}
	 */
	public function canShowTab() {
		return true;
	}

	/**
	 * {@inheritdoc}
	 */
	public function isHidden() {
		return false;
	}

	protected function _prepareLayout() {
		$this->getLayout()->getBlock('page.title')->setPageTitle($this->getPageTitle());

		\Magento\Framework\Data\Form::setFieldsetElementRenderer(
			$this->getLayout()->createBlock('Eloom\Widgets\Block\Adminhtml\Form\Renderer\Fieldset\Element',
				$this->getNameInLayout() . '_fieldset_element'
			)
		);

		return $this;
	}

	public function getPageTitle() {
		return $this->getItem()->getId() ? __("Edit Slider item '%1'", $this->escapeHtml($this->getItem()->getName())) : __('Add Slider item');
	}

	public function getItem() {
		return $this->_coreRegistry->registry('item');
	}

	protected function _prepareForm() {
		$itemAttributes = $this->item->getStoreAttributes();
		$itemAttributesInStores = ['store_id' => ''];

		foreach ($itemAttributes as $itemAttribute) {
			$itemAttributesInStores[$itemAttribute . '_in_store'] = '';
		}

		$dataObj = $this->objectFactory->create(['data' => $itemAttributesInStores]);
		$model = $this->_coreRegistry->registry('item');

		if ($sliderId = $this->getRequest()->getParam('current_slider_id')) {
			$model->setSliderId($sliderId);
		}
		$dataObj->addData($model->getData());

		$storeId = $this->getRequest()->getParam('store');

		$form = $this->_formFactory->create();

		$form->setHtmlIdPrefix($this->item->getFormFieldHtmlIdPrefix());

		$fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Slider item Information')]);

		if ($model->getId()) {
			$fieldset->addField('item_id', 'hidden', ['name' => 'item_id']);
		}

		$elements = [];

		$slider = $this->sliderFactory->create()->load($sliderId);
		if ($slider->getId()) {
			$elements['slider_id'] = $fieldset->addField(
				'slider_id',
				'select',
				[
					'label' => __('Slider'),
					'name' => 'slider_id',
					'values' => [
						[
							'value' => $slider->getId(),
							'label' => $slider->getTitle(),
						],
					],
				]
			);
		} else {
			$elements['slider_id'] = $fieldset->addField(
				'slider_id',
				'select',
				[
					'label' => __('Slider'),
					'name' => 'slider_id',
					'values' => $model->getAvailableSlides(),
				]
			);
		}

		$elements['title'] = $fieldset->addField(
			'title',
			'text',
			[
				'name' => 'title',
				'label' => __('Title'),
				'title' => __('Title')
			]
		);

		$elements['description'] = $fieldset->addField(
			'description',
			'text',
			[
				'title' => __('Description'),
				'label' => __('Description'),
				'name' => 'description'
			]
		);

		$elements['image'] = $fieldset->addField(
			'image',
			'image',
			[
				'title' => __('Desktop Image'),
				'label' => __('Desktop Image'),
				'name' => 'image',
				'note' => __('Allow image type: jpg, jpeg, gif, png'),
			]
		);
		
		$elements['mobile_image'] = $fieldset->addField(
			'mobile_image',
			'image',
			[
				'title' => __('Mobile Image'),
				'label' => __('Mobile Image'),
				'name' => 'mobile_image',
				'note' => __('Allow image type: jpg, jpeg, gif, png'),
			]
		);

		$elements['url'] = $fieldset->addField(
			'url',
			'text',
			[
				'title' => __('URL'),
				'label' => __('URL'),
				'name' => 'url',
			]
		);

		$elements['target_url'] = $fieldset->addField(
			'target_url',
			'select',
			[
				'label' => __('Target'),
				'name' => 'target_url',
				'values' => [
					[
						'value' => \Eloom\Widgets\Model\Item::TARGET_SELF,
						'label' => __('Opens the linked document in the same frame as it was clicked'),
					],
					[
						'value' => \Eloom\Widgets\Model\Item::TARGET_PARENT,
						'label' => __('Opens the linked document in the parent frame'),
					],
					[
						'value' => \Eloom\Widgets\Model\Item::TARGET_BLANK,
						'label' => __('Opens the linked document in a new window or tab'),
					],
				],
			]
		);

		$elements['order'] = $fieldset->addField(
			'order',
			'text',
			[
				'title' => __('Sort Order'),
				'label' => __('Sort Order'),
				'name' => 'order'
			]
		);

		$elements['status'] = $fieldset->addField(
			'status',
			'select',
			[
				'label' => __('Status'),
				'title' => __('Item Status'),
				'name' => 'status',
				'options' => Status::getAvailableStatuses(),
			]
		);

		$form->addValues($dataObj->getData());
		$this->setForm($form);

		return parent::_prepareForm();
	}
}