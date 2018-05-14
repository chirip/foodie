<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Shop;
use Auth;
use Illuminate\Http\Request;

/*** 店舗検索　表示 */
Route::get('/', 'ShopsController@search');

/*** お気に入り表示 */
Route::get('/favorites', 'ShopsController@favorites');

/*** メインページ　表示 */
Route::get('/mainpage', 'ShopsController@mainpage');

/*** お気に入りに新「shop」を追加 */
Route::post('/shops','ShopsController@addShop');

/*** 店舗詳細 */
Route::get('/detail/{place_id}','ShopsController@detail');


/*** 店舗を削除 */
Route::post('/favorites/delete/{shop}','ShopsController@destroy');

/*** ajax */
Route::post('/mainpage/post','ShopsController@ajax');


/*** ログイン機能 */
Auth::routes();
Route::get('/home', 'ShopsController@index')->name('home');

Route::get('/layouts/app', 'ShopsController@app');

