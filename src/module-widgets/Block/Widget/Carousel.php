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

namespace Eloom\Widgets\Block\Widget;

use Eloom\Widgets\Helper\Data;
use Eloom\Widgets\Model\SliderFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\StoreManagerInterface;

class Carousel extends AbstractSlider {
	
	protected $_template = "lazy/widget/carousel.phtml";
	
	private $sliderHtmlId = null;
	
	private $sliderHtmlIdWrapper = null;
	
	public function __construct(Context $context,
	                            SliderFactory $sliderFactory,
	                            Data $sliderHelper,
	                            StoreManagerInterface $storeManager,
	                            array $data = []) {
		
		parent::__construct($context, $sliderFactory, $sliderHelper, $storeManager, $data);
	}
	
	public function renderCarousel() {
		if (null == $this->sliderHtmlId) {
			$this->sliderHtmlId = "widget-carousel-{$this->getAlias()}";
		}
		$this->sliderHtmlIdWrapper = "{$this->sliderHtmlId}_wrapper";
		
		$width = $this->getData('width');
		$height = $this->getData('height');
		
		$sliderWrapperClass = 'widget widget-carousel';
		$sliderClass = 'owl-carousel owl-theme';
		
		$sliderType = $this->getData('layout');
		$bannerStyle = '';
		$containerStyle = '';
		
		switch ($sliderType) {
			default:
			case 'fixed':
				$bannerStyle .= "height:{$height}px;width:{$width}px;";
				$containerStyle .= "height:{$height}px;width:{$width}px;";
				break;
			case 'fullwidth':
				$sliderWrapperClass .= ' fullwidthbanner-container';
				$sliderClass .= ' fullwidthabanner';
				$bannerStyle .= "max-height:{$height}px;height:{$height}px;";
				$containerStyle .= "max-height:{$height}px;";
				break;
			case 'fullscreen':
				$sliderWrapperClass .= ' fullscreen-container';
				$sliderClass .= ' fullscreenbanner';
				$bannerStyle .= "min-height:100vh";
				break;
		}
		
		$output = '';
		$output .= "<div id='{$this->sliderHtmlIdWrapper}' class='{$sliderWrapperClass}' style='{$containerStyle}'>";
		$output .= "<div id='{$this->sliderHtmlId}' class='{$sliderClass}' style='{$bannerStyle}'>";
		$output .= $this->renderSlides($bannerStyle);
		$output .= "</div>";
		$output .= "</div>";
		
		return $output;
	}
	
	private function renderSlides($bannerStyle = '') {
		$html = '';
		foreach ($this->getItensCollection() as $item) {
			$imgUrl = $this->getItemImageUrl($item);
			$mobileImgUrl = $this->getItemMobileImageUrl($item);
			
			$html .= "<div class='item overlay' style='{$bannerStyle}'>
				<img class='large' src='{$imgUrl}' loading='lazy'/>
				<img class='mobile' src='{$mobileImgUrl}' loading='lazy'/>
				<a href='{$item->getUrl()}' target='{$item->getTargetUrl()}'>
					<div class='container-fluid'>
						<div class='row'>
							<div>
								<h2>{$item->getTitle()}</h2>
								<div class='description'>{$item->getDescription()}</div>
							</div>
						</div>
					</div>
				</a>
			</div>";
		}
		
		return $html;
	}
	
	public function getSliderHtmlId() {
		return $this->sliderHtmlId;
	}
	
	public function getSliderHtmlIdWrapper() {
		return $this->sliderHtmlIdWrapper;
	}
}