<?php namespace Rtablada\Profane\Facades;

use Illuminate\Support\Facades\Facade;

class Filter extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'profane.filter'; }

}
