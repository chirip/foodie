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
          <li>testtest</li>
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





    // 複数マーカー準備
    
        var latlng = @json($latlngs);　//lat lng json化
        console.log(latlng);　//確認
        console.log(latlng[0].lat);　//確認
        
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
        
        //イベント登録　地図の表示領域が変更されたらイベントを発生させる
        google.maps.event.addListener(map, 'idle', function() {

          //地図の表示範囲を取得
          var bounds = map.getBounds();
          console.log(bounds);
          
          var northEastLatLng = bounds.getNorthEast();
          var neLat = northEastLatLng.lat();//→ajax送信
          var neLng = northEastLatLng.lng();//→ajax送信
    
          var southWestLatLng = bounds.getSouthWest();
          var swLat = southWestLatLng.lat();//→ajax送信
          var swLng = southWestLatLng.lng();//→ajax送信
          console.log(neLat,neLng,swLat,swLng);//変数取得確認
          
              
          $.ajaxSetup({
        　　headers: {
        　　    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        　　}
        　});

          //jsonファイルの取得
          $.ajax({
            url  : "{{url('mainpage/post')}}",
            type: 'post',
            data:{
              nelat:neLat,
              neLng:neLng,
              swLat:swLat,
              swLng:swLng
            },
            dataType: 'json',
      
            timeout: 1000,
            error: function(){
              alert("地図データの読み込みに失敗しました");
            },
            success: function(json){
            // //帰ってきた地点の数だけループ
              // var markerData = new Array();
              // $.each(json.points,function(){
              //   markerData.push({
              //     position: new google.maps.LatLng(this.lat,this.lng), 
              //     title: this.title,
              //     content:this.content
              //   });
              // });
              
              //         // マーカーデータをセット
              // if(markerArray){
              //   setMarkerData(markerData);
              // }      
            }
          });  
          
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
          
            
        google.maps.event.addListener(map, 'idle', function(){
        markerData.forEach(function(mk){
        if(map.getBounds().contains(mk.getPosition())){
            mk.setVisible(true);
        }else{
            mk.setVisible(false);
        }
        });
        });  
        
        // マーカー毎の処理
        for (var i = 0; i < markerData.length; i++) {
          markerLatLng = new google.maps.LatLng({lat: markerData[i]['lat'], lng: markerData[i]['lng']});
          
          // 緯度経度のデータ作成
          marker[i] = new google.maps.Marker({ // マーカーの追加
          
            position: markerLatLng, // マーカーを立てる位置を指定
            map: map // マーカーを立てる地図を指定
          });
          
          $('#pointlist > ul').append("<li>"+latlng[0].lat+"</li>");//リストにアペンド
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
          for (i = 0; i < markerData.length; i++) {
            marker[i].setMap();
          }
        //配列削除
          for (i = 0; i < markerData.length; i++) {
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

