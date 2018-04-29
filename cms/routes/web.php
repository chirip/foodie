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
use Illuminate\Http\Request;

/*** 店舗検索のダッシュボード表示 */
Route::get('/', 'ShopsController@search');

/*** お気に入りに新「shop」を追加 */
Route::post('/shops','ShopsController@addShop');

/*** 本を削除 */
Route::post('/book/{book}', function (Book $book) {
});


/*** ログイン機能 */
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
