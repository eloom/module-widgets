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

namespace Eloom\Widgets\Controller\Adminhtml\Slideritem;

use Magento\Framework\App\Filesystem\DirectoryList;

class ExportExcel extends \Eloom\Widgets\Controller\Adminhtml\Slideritem {
	public function execute() {
		$fileName = 'itens.xls';

		$resultPage = $this->resultPageFactory->create();
		$content = $resultPage->getLayout()->createBlock('Eloom\Widgets\Block\Adminhtml\Slider\Item\Grid')->getExcel();

		return $this->fileFactory->create($fileName, $content, DirectoryList::VAR_DIR);
	}
}
