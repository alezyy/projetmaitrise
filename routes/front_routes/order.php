<?php

/* * ******** OrderController ************ */
Route::get('order-free-package/{id}', 'OrderController@orderFreePackage')->name('order.free.package');

Route::get('order-package/{id}', 'OrderController@orderPackage')->name('order.package');
Route::get('order-premium-package/{id}/{jobId}', 'OrderController@orderPremiumPackage')->name('order.premium.package');
Route::get('order-upgrade-package/{id}', 'OrderController@orderUpgradePackage')->name('order.upgrade.package');
Route::get('paypal-payment-status/{id}', 'OrderController@getPaymentStatus')->name('payment.status');
Route::get('paypal-payment-premium-status/{id}/42', 'OrderController@getPaymentPremiumStatus')->name('payment.premium.status');
Route::get('paypal-upgrade-payment-status/{id}', 'OrderController@getUpgradePaymentStatus')->name('upgrade.payment.status');
Route::get('stripe-order-form/{id}/{new_or_upgrade}', 'StripeOrderController@stripeOrderForm')->name('stripe.order.form');
Route::get('stripe-order-premium-form/{id}/{new_or_upgrade}/{jobId}', 'StripeOrderController@stripeOrderPremiumForm')->name('stripe.order.premium.form');
Route::post('stripe-order-package', 'StripeOrderController@stripeOrderPackage')->name('stripe.order.package');
Route::post('stripe-order-upgrade-package', 'StripeOrderController@stripeOrderUpgradePackage')->name('stripe.order.upgrade.package');
Route::post('stripe-order-premium-package', 'StripeOrderController@stripeOrderPremiumPackage')->name('stripe.order.premium.package');
