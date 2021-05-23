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

namespace Eloom\Widgets\Controller\Adminhtml\Slideritem;

use Magento\Framework\App\Filesystem\DirectoryList;

class ExportXml extends \Eloom\Widgets\Controller\Adminhtml\Slideritem {
	public function execute() {
		$fileName = 'itens.xml';

		$resultPage = $this->resultPageFactory->create();
		$content = $resultPage->getLayout()->createBlock('Eloom\Widgets\Block\Adminhtml\Slider\Item\Grid')->getXml();

		return $this->fileFactory->create($fileName, $content, DirectoryList::VAR_DIR);
	}
}
