<?php


/** Static Routes */

//Route Defining Example

// Route::set('special', function ($args = []) {
//  ♥ Code here ♥
// 	Route::loadview('viewtarget');
// });

Route::set('static', function () {
    echo 'Code ♥';
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


/** Uncomment below & comment others to preview URI Request Pattern */
//Route::listRoutes();

?>