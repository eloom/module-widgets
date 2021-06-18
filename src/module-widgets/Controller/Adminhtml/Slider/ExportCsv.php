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

namespace Eloom\Widgets\Controller\Adminhtml\Slider;

use Magento\Framework\App\Filesystem\DirectoryList;

class ExportCsv extends \Eloom\Widgets\Controller\Adminhtml\Slider {

	public function execute() {
		$fileName = 'sliders.csv';

		$resultPage = $this->resultPageFactory->create();
		$content = $resultPage->getLayout()->createBlock('Eloom\Widgets\Block\Adminhtml\Slider\Grid')->getCsv();

		return $this->fileFactory->create($fileName, $content, DirectoryList::VAR_DIR);
	}
}
