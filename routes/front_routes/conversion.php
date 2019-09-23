<?php
Route::get('conversion-site-live', 'Conversion\ConversionController@conversionSiteLive')->name('site.live');
Route::get('conversion-server-dev', 'Conversion\ConversionController@serverParameter')->name('server.dev');