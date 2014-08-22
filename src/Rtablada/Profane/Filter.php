<?php namespace Rtablada\Profane;

use Illuminate\Support\Str;
use Config, Cache;

class Filter
{
	/**
	 * Limits amount of phrases per RegExp
	 * @var integer
	 */
	protected $wordsPerExp = 80;

	/**
	 * Array of Regular Expressions to Check
	 * @var array
	 */
	protected $regExps = [];

	/**
	 * Array of words grabbed from Config
	 * @var array
	 */
	protected $words;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->loadRegExps();
	}

	public function filter($string, $replacement = '')
	{
		foreach ($this->regExps as $regExp) {
			$string = preg_replace($regExp, $replacement, $string);
		}

		return trim($string);
	}

	/**
	 * Creates and stores regex
	 * @return [type] [description]
	 */
	protected function loadRegExps()
	{
		// Check if we are caching.
		if (Config::get('profane::cached') && Cache::has('profane::regExps')) {
			
			$this->regExps = Cache::get('profane::regExps');
		
		} else {
			
			$this->createRegExps();
			
		}
	}


	protected function createRegExps()
	{
		$this->words = Config::get('profane::words');

		foreach(array_chunk($this->words, $this->wordsPerExp) as $words)
		{
			$this->regExps[] = '/\b(' . implode('|', $words) . ')\b/i';
		}

		if (Config::get('profane::cached')) {
			Cache::forever('profane::regExps', $this->regExps);
		}
	}
}
