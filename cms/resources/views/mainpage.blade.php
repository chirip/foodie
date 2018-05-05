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
    </div>
    <div id="map"></div>
    
    <script>
    
    // 複数マーカー準備
        var map;
        var marker = [];
        var infoWindow = [];
        var markerData = [ 
          // マーカーを立てる場所名・緯度・経度
          {
            name: 'TAM 東京',
            lat: 35.6954806,
            lng: 139.76325010000005,
            icon: 'tam.png' // TAM 東京のマーカーだけイメージを変更する
          }, {
            name: '小川町駅',
            lat: 35.6951212,
            lng: 139.76610649999998
         }, {
            name: '淡路町駅',
            lat: 35.69496,
            lng: 139.76746000000003
         }, {
            name: '御茶ノ水駅',
            lat: 35.6993529,
            lng: 139.76526949999993
         }, {
            name: '神保町駅',
            lat: 35.695932,
            lng: 139.75762699999996
         }, {
            name: '新御茶ノ水駅',
            lat: 35.696932,
            lng: 139.76543200000003
         }
        ];
        
        
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 35.6811673, lng: 139.76705160000006},
          zoom: 16,
        });
        var geocoder = new google.maps.Geocoder();

        document.getElementById('submit').addEventListener('click', function() {
          geocodeAddress(geocoder, map);
        });
        

        
        
      }

      function geocodeAddress(geocoder, resultsMap) {
        var mapLatLng = new google.maps.LatLng({lat: markerData[0]['lat'], lng: markerData[0]['lng']});// 緯度経度のデータ作成

        var address = document.getElementById('address').value;
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
      
      

      
    </script>
    
    
    
    
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPJtfkTJKQR_tyfo8tcfyWZQQr3UPeIK0&callback=initMap">
    </script>
  </body>
</html>