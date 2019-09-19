<?php

/* * ******  NEWS Field Start ********** */
Route::get('list-news', array_merge(['uses' => 'Admin\NewsController@indexNews'], $all_users))->name('list.news');
Route::get('create-news', array_merge(['uses' => 'Admin\NewsController@createNews'], $all_users))->name('create.news');
Route::post('store-news', array_merge(['uses' => 'Admin\NewsController@storeNews'], $all_users))->name('store.news');
Route::get('edit-news/{id}/{industry_id?}', array_merge(['uses' => 'Admin\NewsController@editNews'], $all_users))->name('edit.news');
Route::put('update-news/{id}', array_merge(['uses' => 'Admin\NewsController@updateNews'], $all_users))->name('update.news');
Route::delete('delete-news', array_merge(['uses' => 'Admin\NewsController@deleteNews'], $all_users))->name('delete.news');
Route::get('fetch-news', array_merge(['uses' => 'Admin\NewsController@fetchNewsData'], $all_users))->name('fetch.data.news');
/* * ****** End NEWS Field ********** */
/* * ******  NewsContent Field Start ********** */
Route::get('list-newsContent', array_merge(['uses' => 'Admin\NewsContentController@indexNewsContent'], $all_users))->name('list.newsContent');
Route::get('create-newsContent', array_merge(['uses' => 'Admin\NewsContentController@createNewsContent'], $all_users))->name('create.newsContent');
Route::post('store-newsContent', array_merge(['uses' => 'Admin\NewsContentController@storeNewsContent'], $all_users))->name('store.newsContent');
Route::get('edit-newsContent/{id}/{industry_id?}', array_merge(['uses' => 'Admin\NewsContentController@editNewsContent'], $all_users))->name('edit.newsContent');
Route::put('update-newsContent/{id}', array_merge(['uses' => 'Admin\NewsContentController@updateNewsContent'], $all_users))->name('update.newsContent');
Route::delete('delete-newsContent', array_merge(['uses' => 'Admin\NewsContentController@deleteNewsContent'], $all_users))->name('delete.newsContent');
Route::get('fetch-newsContent', array_merge(['uses' => 'Admin\NewsContentController@fetchNewsContentData'], $all_users))->name('fetch.data.newsContent');
/* * ****** End NewsContent Field ********** */
?>