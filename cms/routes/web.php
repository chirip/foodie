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

/**
* 店舗検索のダッシュボード表示 
*/
Route::get('/', function () {
    return view('shops'); //検索ページ
});

/**
* 新「shop」を追加 
*/
Route::post('/shops', function (Request $request) {
//バリデーション
    $validator = Validator::make($request->all(), [
        'shop_name' => 'required|max:191',
    ]);

    //バリデーション:エラー 
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    //以下に登録処理を記述（Eloquentモデル）
    // Eloquent モデル
        $shops = new Shop;
        $shops->shop_name = $request->shop_name;
        $shops->formatted_address = "渋谷";
        $shops->place_id = "test_id";
        $shops->lat = '35';
        $shops->lng = '38';
        $shops->save();
        return redirect('/');
});

/**
* 本を削除 
*/
Route::post('/book/{book}', function (Book $book) {
    //
});
