<?php
namespace MetaQuiz\Repositories\Chapter;

use MetaQuiz\Repositories\AbstractEloquentRepository;
use MetaQuiz\Service\Cache\CacheInterface;
use Illuminate\Database\Eloquent\Model;

class EloquentChapter extends AbstractEloquentRepository implements ChapterInterface {

	/**
	 * $model The Eloquent model
	 * @var Illuminate\Database\Eloquent\Model
	 */
	protected $model;

	/**
	 * $cache The Cache Interface
	 * @var MetaQuiz\Service\Cache\CacheInterface
	 */
	protected $cache;

	/**
	 * __construct Create a new Eloquent Chapter
	 * @param Illuminate\Database\Eloquent\Model          $model The Eloquent Model
	 * @param MetaQuiz\Service\Cache\CacheInterface $cache The Cache Interface
	 * @return void
	 */
	public function __construct(Model $model, CacheInterface $cache) {
		//Set the object
		$this -> model = $model;
		$this -> cache = $cache;
	}

	/**
	 * all Fetch all the Chapters
	 * @param  array $with Related Models for Eager Loading
	 * @return Object The Chapter Collection
	 */
	public function all($with = array()) {
		//Generate the key
		$key = md5('Chapters.all');
		//Check if it already exists
		if ($this -> cache -> has($key)) {
			//Return from cache
			return $this -> cache -> get($key);
		}
		//Else query the data source
		$chapters = parent::all($with);
		//Store Cache
		$this -> cache -> put($key, $chapters);
		//And return
		return $chapters;
	}

	/**
	 * bySlug Get a Single Chapter by Slug
	 * @param string $slug Slug of the Chapter
	 * @return Object Chapter Collection
	 */
	public function bySlug($slug, $with = array()) {
		//Else query the data source
		$chapter = $this -> getFirstBy('slug', $slug, $with);
		//Return
		return $chapter;
	}

	/**
	 * create Create a Chapter
	 * @param Array $input Input Data to be stored
	 * @return The Newly created Chapter Model Instance
	 */
	public function create(array $input) {
		//Return the Model Create method
		return $this -> model -> create($input);
	}

}
