<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use Validator;

class ShopsController extends Controller
{

//-----------検索画面表示----------------------------------------

    public function search(){
        return view('shops_search'); //検索ページ
    }
    
//-----------検索結果をお気に入りに追加----------------------------------------

    public function addShop(Request $request){
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
            $shops->user_id = '0';
            $shops->formatted_address = $request->formatted_address;
            $shops->place_id = $request->place_id;
            $shops->lat = $request->lat;
            $shops->lng = $request->lng;
            $shops->save();
            return redirect('/');
    }
    
//-----------お気に入りを表示----------------------------------------

    public function favorites(){
        $shops = Shop::all();
        return view('favorites', [
            'shops' => $shops
        ]);
    }
//-----------お気に入り削除----------------------------------------

    public function destroy(Shop $shop){
        $shop->delete();
        $shops = Shop::all();
        return view('favorites', [
            'shops' => $shops
        ]);
    }


}
