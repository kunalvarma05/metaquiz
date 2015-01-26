<?php
namespace MetaQuiz\Repositories\Question;

use MetaQuiz\Repositories\AbstractEloquentRepository;
use MetaQuiz\Service\Cache\CacheInterface;
use Illuminate\Database\Eloquent\Model;

class EloquentQuestion extends AbstractEloquentRepository implements QuestionInterface {

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
	 * __construct Create a new Eloquent Question
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
	 * byChapterID Find Question by ChapterID
	 * @param  Integer $chapter_id   The ChapterID of the Question
	 * @param  array  $with Related Models for Eager Loading
	 * @return Object The Question Collection
	 */
	public function byChapterID($chapter_id, $with = array()){
		//Else query the data source
		$chapter = $this -> getFirstBy('chapter_id', $chapter_id, $with);
		//Return
		return $chapter;
	}

}
