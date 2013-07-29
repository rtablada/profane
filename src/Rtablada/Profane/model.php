<?php namespace Rtablada\Profane;

use Illuminate\Database\Eloquent\Model as Eloquent;
use App;

abstract class Model extends Eloquent
{
	/**
	 * Attributes to filter profanity of
	 * @var array
	 */
	protected $filtered = array();

	protected $filterReplace = '';

	/**
	 * Set a given attribute on the model.
	 * Check if filtered first.
	 *
	 * @param  string  $key
	 * @param  mixed   $value
	 * @return void
	 */
	public function setAttribute($key, $value)
	{
		if (in_array($key, $this->filtered)) {
			$value = \Filter::filter($value, $this->filterReplace);
		}

		parent::setAttribute($key, $value);
	}
}
