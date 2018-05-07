<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use Auth; //ログイン認証
use Validator;

class ShopsController extends Controller
{

//-----------ログイン後有効化----------------------------------------

    public function __construct()
    {
        $this->middleware('auth');
    }

//-----------検索画面表示----------------------------------------

    public function search(){
        return view('shops_search'); //検索ページ
    }
    
    
//-----------メインページ表示----------------------------------------

    public function mainpage(){
        $shops = Shop::all();
        $latlngs = Shop::get(['lat','lng']);
        
        // $latlngs = Shop::all()->pluck('lat','lng'); 
        // if ( count($latlngs) == 0 ) { 
        // $latlngs = array(); 
        // } 

        return view('mainpage', [
            'shops' => $shops,
            'latlngs'=>$latlngs
        ]);//メインページ
        
    }
    
//-----------メインページajax----------------------------------------

    public function ajax(Request $request){
        
        return response()->json(
            [
                'neLat' => $request->neLat,
                'neLng' => $request->neLng,
                'swLat' => $request->swLat,
                'swLng' => $request->swLng
            ]
        );
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
            $shops->user_id = Auth::user()->id;
            $shops->formatted_address = $request->formatted_address;
            $shops->place_id = $request->place_id;
            $shops->lat = $request->lat;
            $shops->lng = $request->lng;
            $shops->save();
            return redirect('/');
    }
    
//-----------お気に入りを表示----------------------------------------

    public function favorites(){
        $shops = Shop::where('user_id',Auth::user()->id)
                ->orderBy('created_at','desc')
                ->paginate(10);//ページネーション数指定


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

    public function app(){

        return view('layouts/app');
    }



}


