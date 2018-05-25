
 <!-- resources/views/shops.blade.php -->

 @extends('layouts.app') 
 @section('content') 
 <!-- バリデーションエラーの表示に使用 -->
 @include('common.errors') 
  <!-- バリデーションエラーの表示に使用 -->

    <!--検索ボックス -->
    <div class="search_wrap">
        <dl class="search">
            <dt class ="search_box"><input id="address" type="text" name="search" value="" placeholder="　エリア検索　/　例)渋谷駅" /></dt>
            <dd><button id="submit"><span></span></button></dd>
        </dl>
    </div>

    <div id="map"></div>
    
    <div id="legend">
        <!--<h3></h3>  凡例タイトル-->
    </div>
    
    <div>店舗一覧</div>

    <div class="container card_result"></div>
    
<script>
//------------- json受け取り　加工---------------------------------------------------------------

    // 複数マーカー準備
    /**
     * favorites:red
     * othersFavorites:yellow
     * commonFavorites:lightblue
    */
    
        
    var favorites = @json($favorites);　//自分がお気に入り登録済み json化
    var othersFavorites = @json($othersFavorites);　//他人の登録したお店 json化
    var commonFavorites = @json($commonFavorites);　//他人の登録したlat lng json化
    var windows = [];
    var currentInfoWindow = null;

    for (var i = 0; i < othersFavorites.length; i++) {
      //markerの色を指定：yellow
      othersFavorites[i].icon = '../image/yellow-dot.png';
      }
    console.log(othersFavorites);　//確認
     
     
    for (var i = 0; i < commonFavorites.length; i++) {
      //markerの色を指定：pink
      commonFavorites[i].icon = '../image/lightblue.png';
      }
    console.log(commonFavorites);　//確認
    
    for (var i = 0; i < favorites.length; i++) {
      //markerの色を指定：red
      favorites[i].icon = '../image/red-dot.png';
    }
    console.log(favorites);　//確認

    
    //json結合　戻り値はFavoritesに集約
    var totalFavorites = othersFavorites.concat(commonFavorites).concat(favorites);
    console.log(totalFavorites);　//確認

//------------- 変数---------------------------------------------------------------

    var map;
    var marker = [];
    var resultFavorites= [];
    var othersResultFavorites= [];
        
//------------- ここから　init map---------------------------------------------------------------

function initMap(){
    //map表示
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 35.6811673, lng: 139.76705160000006},//初期表示　東京駅
      zoom: 16,
      disableDefaultUI: true,
    });
    
    //-------------POI削除
     var styleOptions = [{
        featureType: "poi",
        elementType: "labels",
        stylers: [{visibility: "off"}]
     }];
     
    map.setOptions({styles: styleOptions});
    
    //-------------maker click event

    function markerEvent(i) {
        marker[i].addListener('click', function() { // マーカーをクリックしたとき
            if (currentInfoWindow) {
                currentInfoWindow.close();
            }
            windows[i].open(map, marker[i]); // 吹き出しの表示
            currentInfoWindow = windows[i];
            google.maps.event.addListener(map, "click", function() {windows[i].close();});

        });
    }

    
    //-------------地図の表示領域が変更されたらイベントを発生させる
    google.maps.event.addListener(map, 'idle', function() {
      
        MarkerClear();//表示中の旗を削除
        $(".card").remove();
        
        resultFavorites.length= 0;//取得した地点情報のリセット
        
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
        for (var i = 0, len = totalFavorites.length; i < len; i++) {
            if(
                totalFavorites[i].lat < neLat &&
                totalFavorites[i].lat > swLat &&
                totalFavorites[i].lng < neLng &&
                totalFavorites[i].lng > swLng 
            ){
                resultFavorites.push(totalFavorites[i]); 
            }
        }
        console.log(resultFavorites)//格納された地点情報の確認

        //格納された地点情報から複数の旗を立てる
        for (var i = 0; i < resultFavorites.length; i++) {
            var mp = {lat:resultFavorites[i].lat, lng:resultFavorites[i].lng};
            
            marker[i] = new google.maps.Marker({
                position: mp,
                map: map,
                icon:resultFavorites[i].icon
            });
            

            windows[i] = new google.maps.InfoWindow({ // 吹き出しの追加
                content: ""
                });
                markerEvent(i); // マーカーにクリックイベントを追加
        }
        


      
        // 取得リスト一覧表示
        for(let i = 0; i < resultFavorites.length; i++) {
            console.log(resultFavorites[i].shop_name)
            var name      = resultFavorites[i].shop_name
            var address   = resultFavorites[i].formatted_address
            var place_id  = resultFavorites[i].place_id

            $('.card_result').append(`
                <div class="row card">
                    <a class ="none-decoration" href="#">
                        <div class="col-xs-7 col-md-9">
                            <div class ="card_shop_name">${name}</div>
                            <hr class="card_hr">
                            <div class="card_shop_detail">${address}</div>
                        </div>
                        
                        <div class="col-xs-3 col-md-2 img_box">
                            <div class="testbox"></div>
                            <!--<img src="{{ asset('/image/test.jpg') }}" alt="test_phote">-->
                        </div>
                        
                        <div class="col-xs-2 col-md-1">
                            <img src="{{ asset('/image/add_nonactive.png') }}" alt="test_phote" width="50px" height="50px">
                        </div>
                    </a>
                </div>
            `);
        }
    });//ここまでidle
    
    //geocoder準備
    var geocoder = new google.maps.Geocoder();
    
    //位置検索　発火
    document.getElementById('submit').addEventListener('click', function() {
        geocodeAddress(geocoder, map);
    });
    
     //凡例準備
    var icons = {
        myFavorite: {
            name: 'オキニ',
            icon: '../image/red-dot-mini.png'
        },
        othersFavorites: {
            name: 'ミンナ',
            icon: '../image/lightblue-mini.png'
        },
        commonFavorites: {
            name: 'コモン',
            icon: '../image/yellow-dot-mini.png'
        }
    };
    
    var legend = document.getElementById('legend');
    for (var key in icons) {
        var type = icons[key];
        var name = type.name;
        var icon = type.icon;
        var div = document.createElement('div');
        div.innerHTML = '<img src="' + icon + '"> ' + name;
        legend.appendChild(div);
    }
    
    //凡例反映
    map.controls[google.maps.ControlPosition.LEFT_TOP].push(legend);
  
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
    if(resultFavorites.length > 0){
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
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPJtfkTJKQR_tyfo8tcfyWZQQr3UPeIK0&callback=initMap"></script>

@endsection 

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