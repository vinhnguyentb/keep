<?php

Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@home',
]);
