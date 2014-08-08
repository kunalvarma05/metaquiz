<?php
namespace MetaQuiz\Service\Cache;

use Illuminate\Cache\CacheManager;

class AppCache implements CacheInterface {

	protected $cache;
	protected $minutes;

	/**
	 * Constructor
	 * @param CacheManager The CacheManager Class
	 * @param Integer The default number of minutes to store the cache
	 */
	public function __construct(CacheManager $cache, $minutes = null) {
		$this -> cache = $cache;
		$this -> minutes = $minutes;
	}

	/**
	 * Get
	 * Retrive data from cache
	 * @param string Cache Item Key
	 * @return mixed PHP Data result of Cache
	 */
	public function get($key) {
		return $this -> cache -> get($key);
	}

	/**
	 * Put
	 * Add data from cache
	 * @param string Cache Item Key
	 * @param mixed PHP Data to Cache
	 * @param integer The number of minutes to store the cache
	 * @return mixed PHP Data result of Cache
	 */
	public function put($key, $value, $minutes = null) {
		if (is_null($minutes)) {
			$minutes = $this -> minutes;
		}
		return $this -> cache -> put($key, $value, $minutes);
	}

	/**
	 * Has
	 * Returns true if data exists in cache, else return false
	 * @param string Cache Item Key
	 * @return bool If Cache Item Exists
	 */
	public function has($key) {
		return $this -> cache -> has($key);
	}

}
