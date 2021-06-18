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

namespace Eloom\Widgets\Block\Adminhtml\Slider\Edit\Tab;

use Eloom\Widgets\Model\ResourceModel\Slider\Item\CollectionFactory;
use Eloom\Widgets\Model\Status;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Helper\Data;

class Itens extends \Magento\Backend\Block\Widget\Grid\Extended {

	protected $itemCollectionFactory;

	public function __construct(Context $context, Data $backendHelper, CollectionFactory $itemCollectionFactory, array $data = []) {
		$this->itemCollectionFactory = $itemCollectionFactory;
		parent::__construct($context, $backendHelper, $data);
	}

	public function getGridUrl() {
		return $this->getUrl('*/*/itens', ['_current' => true]);
	}

	public function getRowUrl($row) {
		return '';
	}

	public function getTabLabel() {
		return __('Itens');
	}

	public function getTabTitle() {
		return __('Itens');
	}

	public function canShowTab() {
		return true;
	}

	public function isHidden() {
		return true;
	}

	protected function _construct() {
		parent::_construct();
		$this->setId('itemGrid');
		$this->setDefaultSort('item_id');
		$this->setDefaultDir('ASC');
		$this->setSaveParametersInSession(true);
		$this->setUseAjax(true);
	}

	protected function _addColumnFilterToCollection($column) {
		parent::_addColumnFilterToCollection($column);

		return $this;
	}

	public function getSelectedSliderItens() {
		$sliderId = $this->getRequest()->getParam('slider_id');
		if (!isset($sliderId)) {
			return [];
		}
		$itemCollection = $this->itemCollectionFactory->create();
		$itemCollection->addFieldToFilter('slider_id', $sliderId);

		$itemIds = [];
		foreach ($itemCollection as $item) {
			$itemIds[$item->getId()] = ['order_item_slider' => $item->getOrderItem()];
		}

		return $itemIds;
	}

	protected function _prepareCollection() {
		$collection = $this->itemCollectionFactory->create()->setStoreId(null);
		$collection->setIsLoadSliderTitle(TRUE);

		$this->setCollection($collection);

		return parent::_prepareCollection();
	}

	protected function _prepareColumns() {
		$this->addColumn(
			'item_id',
			[
				'header' => __('Item Id'),
				'type' => 'number',
				'index' => 'item_id',
				'header_css_class' => 'col-id',
				'column_css_class' => 'col-id',
			]
		);

		$this->addColumn(
			'image',
			[
				'header' => __('Image'),
				'filter' => false,
				'width' => '50px',
				'renderer' => 'Eloom\Widgets\Block\Adminhtml\Slider\Item\Helper\Renderer\Image',
			]
		);
		$this->addColumn(
			'title',
			[
				'header' => __('Title'),
				'index' => 'title',
				'width' => '50px',
			]
		);

		$this->addColumn(
			'status',
			[
				'header' => __('Status'),
				'index' => 'status',
				'type' => 'options',
				'filter_index' => 'main_table.status',
				'options' => Status::getAvailableStatuses(),
			]
		);

		$this->addColumn(
			'edit',
			[
				'header' => __('Edit'),
				'filter' => false,
				'sortable' => false,
				'index' => 'stores',
				'header_css_class' => 'col-action',
				'column_css_class' => 'col-action',
				'renderer' => 'Eloom\Widgets\Block\Adminhtml\Slider\Edit\Tab\Helper\Renderer\EditItem',
			]
		);

		$this->addColumn(
			'order',
			[
				'header' => __('Sort Order'),
				'name' => 'order',
				'index' => 'order',
				'width' => '50px',
				'editable' => true,
			]
		);

		return parent::_prepareColumns();
	}
}
