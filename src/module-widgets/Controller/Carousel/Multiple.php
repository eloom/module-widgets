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

namespace Eloom\Widgets\Controller\Carousel;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\View\Result\PageFactory;

class Multiple extends Action {
	
	/**
	 * @var PageFactory
	 */
	protected $resultPageFactory;
	
	/**
	 * @var JsonFactory
	 */
	protected $resultJsonFactory;
	
	
	/**
	 * View constructor.
	 * @param Context $context
	 * @param PageFactory $resultPageFactory
	 * @param JsonFactory $resultJsonFactory
	 */
	public function __construct(Context $context,
	                            PageFactory $resultPageFactory,
	                            JsonFactory $resultJsonFactory) {
		$this->resultPageFactory = $resultPageFactory;
		$this->resultJsonFactory = $resultJsonFactory;
		
		parent::__construct($context);
	}
	
	
	/**
	 * @return \Magento\Framework\Controller\Result\Json
	 */
	public function execute() {
		$result = $this->resultJsonFactory->create();
		$resultPage = $this->resultPageFactory->create();
		$data = [];
		foreach ($this->getRequest()->getParams() as $key => $value) {
			$data[$key] = $value;
		}
		
		$html = $resultPage->getLayout()
			->createBlock('Eloom\Widgets\Block\Widget\MultipleCarousel')
			->setData($data)
			->setTemplate('Eloom_Widgets::' . $data['template'])
			->toHtml();
		
		$result->setData(['output' => $html]);
		
		return $result;
	}
}