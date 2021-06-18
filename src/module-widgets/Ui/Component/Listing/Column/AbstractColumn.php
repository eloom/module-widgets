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

namespace Eloom\Widgets\Ui\Component\Listing\Column;

abstract class AbstractColumn extends \Magento\Ui\Component\Listing\Columns\Column {

	public function prepareDataSource(array $dataSource) {
		if (isset($dataSource['data']['items'])) {
			foreach ($dataSource['data']['items'] as &$item) {
				$this->_prepareItem($item);
			}
		}

		return $dataSource;
	}

	abstract protected function _prepareItem(array & $item);
}
