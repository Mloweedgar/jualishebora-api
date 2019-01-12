<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');




Route::resource('users', 'UserAPIController');

Route::post('users/signup', 'UserAPIController@signup');

Route::post('users/signin', 'UserAPIController@signin');

Route::resource('passwordRessets', 'PasswordRessetAPIController');

Route::resource('teachers', 'TeacherAPIController');

Route::resource('wazazis', 'WazaziAPIController');

Route::resource('foods', 'FoodAPIController');

Route::resource('topics', 'TopicAPIController');

Route::resource('posts', 'PostAPIController');
Route::get('search/{title?}','PostAPIController@search');

Route::resource('comments', 'CommentAPIController');



Route::resource('darasas', 'DarasaAPIController');

Route::resource('feedback', 'FeedbackAPIController');

Route::resource('subscribers', 'SubscriberAPIController');

Route::resource('topicCategories', 'TopicCategoryAPIController');
Route::get('topicsByCategory/{id}','TopicCategoryAPIController@topicsByCategory');

Route::resource('images', 'ImageAPIController');


Route::post('avatar', 'ImageAPIController@upload');



Route::resource('productsCategories', 'productsCategoryAPIController');  

Route::get('productsByCategory/{id}','productsCategoryAPIController@productsByCategory');

Route::resource('products', 'ProductsAPIController');

Route::resource('audio', 'audioAPIController'); 

Route::resource('orders', 'OrderAPIController');