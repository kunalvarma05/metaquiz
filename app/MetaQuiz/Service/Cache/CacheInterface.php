<?php
namespace MetaQuiz\Service\Cache;

interface CacheInterface {

	/**
	 * Get
	 * Retrive data from cache
	 * @param string Cache Item Key
	 * @return mixed PHP Data result of Cache
	 */
	public function get($key);

	/**
	 * Put
	 * Add data from cache
	 * @param string Cache Item Key
	 * @param mixed PHP Data to Cache
	 * @param integer The number of minutes to store the cache
	 * @return mixed PHP Data result of Cache
	 */
	public function put($key, $value, $minutes = null);

	/**
	 * Has
	 * Returns true if data exists in cache, else return false
	 * @param string Cache Item Key
	 * @return bool If Cache Item Exists
	 */
	public function has($key);

}
