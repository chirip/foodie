<!--<!DOCTYPE html>-->
<!--<html>-->
<!--  <head>-->
<!--    <title>Geocoding service</title>-->
<!--    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">-->
<!--    <meta charset="utf-8">-->
    <!--ajax　POST準備-->
<!--    <meta name="csrf-token" content="{{ csrf_token() }}">-->

<!--  </head>-->

 <!-- resources/views/shops.blade.php -->

 @extends('layouts.app') 
 @section('content') 
 <!-- バリデーションエラーの表示に使用 -->
 @include('common.errors') 
  <!-- バリデーションエラーの表示に使用 -->

  <body>
    <div id="floating-panel">
      <input id="address" type="textbox" value="東京駅">
      <button id="submit" type="submit" value="Geocode">submit</button>
      <button id="delete" type="submit" value="delete">delete</button>


    </div>
    <div id="map"></div>
    
    <div id="shoplist">
      <table>
        @foreach($latlngs as $latlng)
              <tr>{{$latlng->shop_name}}
              </tr>
        @endforeach

              
      </table>
    </div>
    

      
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPJtfkTJKQR_tyfo8tcfyWZQQr3UPeIK0&callback=initMap"></script>

    <script>

//------------- json受け取り　加工---------------------------------------------------------------

        // 複数マーカー準備
        var latlngs = @json($latlngs);　//自分がお気に入り登録済みlat lng json化
        for (var i = 0; i < latlngs.length; i++) {
          //markerの色を指定：yellowに変更
          latlngs[i].icon = '../image/yellow-dot.png';
        }
        console.log(latlngs);　//確認

        
        var othersLatlngs = @json($othersLatlngs);　//他人の登録したlat lng json化
        for (var i = 0; i < othersLatlngs.length; i++) {
          //markerの色を指定：pinkに変更
          othersLatlngs[i].icon = '../image/pink-dot.png';
          }
         console.log(othersLatlngs);　//確認

        
        //json結合　戻り値はlatlngsに集約
        var totalLatlngs = latlngs.concat(othersLatlngs);
        console.log(totalLatlngs);　//確認




//------------- 変数---------------------------------------------------------------

        var map;
        var marker = [];
        // var markerData = latlngs;　//マーカーリスト　tableから全lat lngを取得してjsonで受け渡し
        var resultLatlngs= [];
        var othersResultLatlngs= [];

        
//------------- ここから　init map---------------------------------------------------------------

      function initMap(){
        //map表示
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 35.6811673, lng: 139.76705160000006},//初期表示　東京駅
          zoom: 16,
        });
        
        //-------------地図の表示領域が変更されたらイベントを発生させる
        google.maps.event.addListener(map, 'idle', function() {
          
          MarkerClear();//表示中の旗を削除
          $("tr").remove();


          resultLatlngs.length= 0;//取得した地点情報のリセット
           
          //地図の表示範囲を取得
          var bounds = map.getBounds();
          var northEastLatLng = bounds.getNorthEast();//画面右上の座標
          var neLat = northEastLatLng.lat();
          var neLng = northEastLatLng.lng();
    
          var southWestLatLng = bounds.getSouthWest();//画面左下の座標
          var swLat = southWestLatLng.lat();
          var swLng = southWestLatLng.lng();
          console.log("変数取得確認:"+neLat,neLng,swLat,swLng);//変数取得確認
          
      　　//データベース上の座標と表示範囲内の座標を比較して、表示範囲内に店舗情報がある場合は配列に格納
      　　//lat lngは左、下に行くと数値が下がる
      　　//自分のお気に入り
          for (var i = 0, len = totalLatlngs.length; i < len; i++) {
            if(totalLatlngs[i].lat < neLat &&
               totalLatlngs[i].lat > swLat &&
               totalLatlngs[i].lng < neLng &&
               totalLatlngs[i].lng > swLng 
            ){ resultLatlngs.push(totalLatlngs[i]); 
            }
          }
          console.log(resultLatlngs)//格納された地点情報の確認

          
          //格納された地点情報から複数の旗を立てる
          for (var i = 0; i < resultLatlngs.length; i++) {
            var mp = {lat:resultLatlngs[i].lat, lng:resultLatlngs[i].lng};

            marker[i] = new google.maps.Marker({
              position: mp,
              map: map,
              icon:resultLatlngs[i].icon
            });
          }
          
           // 取得リスト一覧表示

          for(let i = 0; i < resultLatlngs.length; i++) {
            console.log(resultLatlngs[i].shop_name)
                      var name      = resultLatlngs[i].shop_name
                      var address   = resultLatlngs[i].formatted_address
                      var place_id  = resultLatlngs[i].place_id
          
                      $('tbody').append(`
                          <tr>resultLatlngs
                              <td>${name}</td>
                              <td>${address}</td>
                              <td>${place_id}</td>
          
                          </tr>`);
                    }
          });
        
        //ここまでidle
        
        //geocoder準備
        var geocoder = new google.maps.Geocoder();
        
        //位置検索　発火
        document.getElementById('submit').addEventListener('click', function() {
          geocodeAddress(geocoder, map);
        });
        
        //maker削除　発火
        document.getElementById('delete').addEventListener('click', function() {
          MarkerClear();
        });

      }
//------------------ここまで　initMap------------------------------------------------------------
//------------------ここから geocode検索------------------------------------------------------------

      // 位置検索
      function geocodeAddress(geocoder, resultsMap) {

        var address = document.getElementById('address').value;　//inputタグ内容取得
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            // 地名検索結果にマーカーを表示
            // var center_marker = new google.maps.Marker({
            //   map: resultsMap,
            //   position: results[0].geometry.location
            // });
          
          }else {
              alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }
      
      
      
//------------------ここまで geocode検索------------------------------------------------------------
//------------------ここからマーカー削除------------------------------------------------------------

      
      //マーカー削除
    function MarkerClear(){
      var i;
        //表示中のマーカーがあれば削除
        if(resultLatlngs.length > 0){
            //マーカー削除
            for (i = 0 ; i < marker.length; i++) {
                marker[i].setMap();
            }
            //配列削除
            for (i = 0; i <=  marker.length; i++) {
                marker.shift();
            }
        }else{
          console.log("no maker");
        }
    }
//------------------ここまでマーカー削除------------------------------------------------------------


  
    </script>
  @endsection 
<!--なぜかマップ表示にこれが必要-->
</html>

<!--　参照　https://www.tam-tam.co.jp/tipsnote/javascript/post7755.html　-->
<!--　参照　http://mspec.jp/blog/archives/55　-->
<!--　参照　https://developers.google.com/maps/documentation/javascript/examples/geocoding-simple?hl=ja　-->

<!--
//画像マーカーを作成
// icon_image = new google.maps.MarkerImage();
// //laravel の　publicのimageフォルダにgreen-dot.png画像を入れた場合
// icon_image.url = '../image/green-dot.png';
// icon: icon_image
-->