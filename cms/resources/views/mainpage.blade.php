<!DOCTYPE html>
<html>
  <head>
    <title>Geocoding service</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <!--ajax　POST準備-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
    </style>
  </head>
  <body>
    <div id="floating-panel">
      <input id="address" type="textbox" value="東京駅">
      <button id="submit" type="submit" value="Geocode">submit</button>
      <button id="delete" type="submit" value="delete">delete</button>


    </div>
    <div id="map"></div>
    
    <div id="pointlist">
      <ul>
          <li>{{$latlngs}}</li>
      </ul>
    </div>
    
    <!--ajaxでのエラー回避にためjqueryの src httpsは削除-->
    <script
      src="//code.jquery.com/jquery-3.3.1.js"
      integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
      crossorigin="anonymous">
    </script>
      
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPJtfkTJKQR_tyfo8tcfyWZQQr3UPeIK0&callback=initMap"></script>

    <script>

//------------- 変数---------------------------------------------------------------

        // 複数マーカー準備
        var latlngs = @json($latlngs);　//お気に入り登録済みlat lng json化
        console.log(latlngs);　//確認
        // console.log(latlngs[0].lat);　//確認
        
        var map;
        var marker = [];
        var markerData = latlngs;　//マーカーリスト　tableから全lat lngを取得してjsonで受け渡し
        var resultLatlngs= [];
        
//------------- ここから　init map---------------------------------------------------------------

      function initMap(){
        //map表示
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 35.6811673, lng: 139.76705160000006},//初期表示　東京駅
          zoom: 16,
        });
        
        //地図の表示領域が変更されたらイベントを発生させる
        google.maps.event.addListener(map, 'idle', function() {
          
          resultLatlngs.length= 0;//取得した地点情報のリセット
           
          MarkerClear();//表示中の旗を削除

          
          //地図の表示範囲を取得
          var bounds = map.getBounds();
          // console.log(bounds);
          
          var northEastLatLng = bounds.getNorthEast();//画面右上の座標
          var neLat = northEastLatLng.lat();
          var neLng = northEastLatLng.lng();
    
          var southWestLatLng = bounds.getSouthWest();//画面左下の座標
          var swLat = southWestLatLng.lat();
          var swLng = southWestLatLng.lng();
          console.log(neLat,neLng,swLat,swLng);//変数取得確認
          
      　　//データベース上の座標と表示範囲内の座標を比較して、表示範囲内に店舗情報がある場合は配列に格納
      　　//lat lngは左、下に行くと数値が下がる
          for (var i = 0, len = latlngs.length; i < len; i++) {
            if(latlngs[i].lat < neLat &&
               latlngs[i].lat > swLat &&
               latlngs[i].lng < neLng &&
               latlngs[i].lng > swLng 
            ){ resultLatlngs.push(latlngs[i]); 
            }
          }
          console.log(resultLatlngs)//格納された地点情報の確認

        
          //格納された地点情報から複数の旗を立てる
          var marker = [];
          for (var i = 0; i < 10; i++) {
            marker[i] = new google.maps.Marker({
              position: resultLatlngs[i],
              map: map
            });
          }
        });
        
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
            var center_marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location
            });
          
          }else {
              alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }
      
      console.log(resultLatlngs.length)
      //マーカー削除
      function MarkerClear() {
      //表示中のマーカーがあれば削除
        if(resultLatlngs.length > 0){
        //マーカー削除
          for (var i = 0; i < resultLatlngs.length; i++) {
            marker[i].setMap();
          }
        //配列削除
          for (i = 0; i < resultLatlngs.length; i++) {
            marker[i].shift();
          }
        }
      }

  
    </script>
  </body>
</html>

<!--　参照　https://www.tam-tam.co.jp/tipsnote/javascript/post7755.html　-->
<!--　参照　http://mspec.jp/blog/archives/55　-->
<!--　参照　https://developers.google.com/maps/documentation/javascript/examples/geocoding-simple?hl=ja　-->