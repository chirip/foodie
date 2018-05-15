 <!-- resources/views/shops.blade.php -->

 @extends('layouts.app') 
 @section('content') 
 <!-- バリデーションエラーの表示に使用 -->
 @include('common.errors') 
  <!-- バリデーションエラーの表示に使用 -->

<div id="detail_wrap" class="container">
    <div class="row">
        <div id="shop_name"  class="col-md-10 col-md-offset-1 under">
            <h2>{{$shop->shop_name}}</h2>
        </div>

    </div>
    <div class="row">
        <div class="col-md-4 photo">photo_1</div>
        <div class="col-md-4 photo">photo_2</div>
        <div class="col-md-4 photo">photo_3</div>
    </div>

    <div class="row">
        <div   class="col-md-10 col-md-offset-1">
            <h3>店舗詳細</h3>
            <br>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                    <th class="info">住所</th>
                    <td>{{$shop->formatted_address}}</td>
                    </tr>
                    <tr>
                    <th class="info">電話番号</th>
                    <td>03-3333-3333</td>
                    </tr>
                    <tr>
                    <th class="info">営業日</th>
                    <td>平日</td>
                  </tr>
                </table>
            </div>

        </div>
    </div>
</div>


  
 @endsection 