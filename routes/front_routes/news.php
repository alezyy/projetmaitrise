<?php
Route::get('news/jobs', 'NewsController@news_listing')->name('news.listing');
Route::get('nouvelles/jobs', 'Company\CompaniesController@company_listing')->name('news.listing');
Route::get('news/jobs/{slug}', 'NewsController@getPage')->name('news');
