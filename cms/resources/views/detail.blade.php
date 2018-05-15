 <!-- resources/views/shops.blade.php -->

 @extends('layouts.app') 
 @section('content') 
 <!-- バリデーションエラーの表示に使用 -->
 @include('common.errors') 
  <!-- バリデーションエラーの表示に使用 -->
<div id="detail_wrapper">
<div id="detail_content" class="container">
    <div class="row">
        <div id="shop_name"  class="col-md-8 col-md-offset-2 under">
            <h2>{{$shop->shop_name}}</h2>
        </div>

    </div>
    <div class="row">
        <div class="col-md-2 photo col-md-offset-2">photo_1</div>
        <div class="col-md-2 photo">photo_2</div>
        <div class="col-md-2 photo">photo_3</div>
        <div class="col-md-2 photo">photo_4</div>

    </div>

    <div class="row">
        <div   class="col-md-8 col-md-offset-2">
            <h5>店舗詳細</h5>
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
    <div class="row">
        <div   class="col-md-8 col-md-offset-2">
            <h5>Map</h5>
            <div id="detail_map"></div>
        </div>
    </div>

</div>

<div id="map"></div>

</div>

<script>
        var shop = @json($shop);　//自分がお気に入り登録済み json化

        var mylat = shop.lat;
        var mylng = shop.lng;
        console.log(mylat);
        
      function initMap() {
        var uluru = {lat:mylat, lng:mylng};
        var map = new google.maps.Map(document.getElementById('detail_map'), {
          zoom: 16,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
        var infoWnd = new google.maps.InfoWindow();

      }
      
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPJtfkTJKQR_tyfo8tcfyWZQQr3UPeIK0&callback=initMap"></script>


  
 @endsection 