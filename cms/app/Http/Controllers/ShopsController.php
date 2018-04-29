<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use Validator;

class ShopsController extends Controller
{

//-----------検索画面表示----------------------------------------

    public function search(){
        return view('shops'); //検索ページ
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
            $shops->formatted_address = "渋谷";
            $shops->place_id = "test_id";
            $shops->lat = '35';
            $shops->lng = '38';
            $shops->save();
            return redirect('/');
    }
    
    
    

}
