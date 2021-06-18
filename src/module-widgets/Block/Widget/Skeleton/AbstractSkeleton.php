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

namespace Eloom\Widgets\Block\Widget\Skeleton;

use Magento\Framework\Json\EncoderInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Widget\Block\BlockInterface;

abstract class AbstractSkeleton extends Template implements BlockInterface {
	
	protected $jsonEncoder;
	
	public function __construct(Context $context,
	                            EncoderInterface $jsonEncoder,
	                            array $data = []) {
		$this->jsonEncoder = $jsonEncoder;
		
		parent::__construct($context, $data);
	}
	
	public abstract function getJsonConfig();
}