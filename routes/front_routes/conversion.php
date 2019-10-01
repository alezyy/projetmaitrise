<?php
Route::get('conversion-site-live', 'Conversion\ConversionController@conversionSiteLive')->name('site.live');
Route::get('conversion-server-dev', 'Conversion\ConversionController@serverParameter')->name('server.dev');
Route::get('conversion-start', 'Conversion\ConversionController@startConversion')->name('conversion.start');