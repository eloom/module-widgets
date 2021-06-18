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

namespace Eloom\Widgets\Model;

class Status {
	const ENABLED = 1;
	const DISABLED = 0;

	public static function getAvailableStatuses() {
		return [self::ENABLED => __('Enabled'), self::DISABLED => __('Disabled')];
	}
}
