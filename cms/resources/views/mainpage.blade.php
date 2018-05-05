<!DOCTYPE html>
<html>
  <head>
    <title>Geocoding service</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
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
    
    @foreach ($shops as $shop)
    <div>{!!$shop->lng!!} </div>
    @endforeach
    <script>


    // 複数マーカー準備
    
        var latlng = @json($latlngs);　//lat lng json化
        console.log(latlng);　//確認
          
      
        
        var map;
        var marker = [];
        var infoWindow = [];
        var markerData = latlng;　//マーカーリスト　tableから全lat lngを取得してjsonで受け渡し

      //map表示
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 35.6811673, lng: 139.76705160000006},//初期表示　東京駅
          zoom: 16,
        });
        
        //geocoder準備
        var geocoder = new google.maps.Geocoder();
        
        //位置検索　発火
        document.getElementById('submit').addEventListener('click', function() {
          // maker reset
          geocodeAddress(geocoder, map);
        });
        
        //maker削除　発火
        document.getElementById('delete').addEventListener('click', function() {
          MarkerClear();
        });
        
      }

      // 位置検索　関数
      function geocodeAddress(geocoder, resultsMap) {

        var address = document.getElementById('address').value;　//inputタグ内容取得
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            var center_marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location
            });
            
             // マーカー毎の処理
                for (var i = 0; i < markerData.length; i++) {
                markerLatLng = new google.maps.LatLng({lat: markerData[i]['lat'], lng: markerData[i]['lng']});
                // 緯度経度のデータ作成
                marker[i] = new google.maps.Marker({ // マーカーの追加
                  position: markerLatLng, // マーカーを立てる位置を指定
                  map: resultsMap // マーカーを立てる地図を指定
                });
        }
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }
      
      //マーカー削除
      function MarkerClear() {
      //表示中のマーカーがあれば削除
        if(markerData.length > 0){
        //マーカー削除
          for (i = 0; i <markerData.length; i++) {
            marker[i].setMap();
          }
        //配列削除
          for (i = 0; i <=markerData.length; i++) {
            marker[i].shift();
          }
        }
      }
      

      
      

      
    </script>
    
    
    
    
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPJtfkTJKQR_tyfo8tcfyWZQQr3UPeIK0&callback=initMap"></script>
  </body>
</html>

<!--　参照　https://www.tam-tam.co.jp/tipsnote/javascript/post7755.html　-->
<!--　参照　http://mspec.jp/blog/archives/55　-->
<!--　参照　https://developers.google.com/maps/documentation/javascript/examples/geocoding-simple?hl=ja　-->

