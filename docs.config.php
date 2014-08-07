<?php

use Symfony\Component\Finder\Finder;

$iterator = Finder::create() -> files() -> name('*.php') -> exclude('migrations') -> exclude('tests') -> exclude('storage') -> exclude('lang') -> exclude('assets') -> in($dir = 'X:/xampp/htdocs/metaquiz/app');

return new Sami\Sami($iterator, array('title' => 'MetaQuiz API', 'build_dir' => __DIR__ . '/api', 'cache_dir' => __DIR__ . '/api/cache', 'default_opened_level' => 2, ));
