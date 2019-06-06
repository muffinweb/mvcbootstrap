<?php


/** Static Routes */

//Route Defining Example

// Route::set('special', function ($args = []) {
//  ♥ Code here ♥
// 	Route::loadview('specialview');
// });

Route::set('hakkimizda', function ($args = []) {
    Route::loadview('hakkimizda');
});

Route::set('myproject', function($args = []){
	echo 'MY PROJECT VIEW BURAYA GELCEK';
});

 /*
 |
 |------------------------------------------------------
 |  Dynamic Routes rely on uri and controllers
 |------------------------------------------------------
 |
 */

/** Dynamic Routes */
Route::handleURI();


//Route::listRoutes();

?>