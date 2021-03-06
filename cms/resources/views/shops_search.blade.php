 <!-- resources/views/shops.blade.php -->

 @extends('layouts.app') 
 @section('content') 
 <!-- バリデーションエラーの表示に使用 -->
 @include('common.errors') 
  <!-- バリデーションエラーの表示に使用 -->
 
     <div class="search_wrap">
        <dl class="search">
            <dt class ="search_box"><input id="pac-input"  type="text" class="controls" name="search" value="" placeholder="　店舗検索　/　例)渋谷駅　そば" /></dt>
            <!--<dd><button id="submit"><span></span></button></dd>-->
        </dl>
    </div>
 
    <!--<input id="pac-input" class="controls" type="text" placeholder="エリア× ジャンル">-->
    <div id="map"></div>


    <div class="panel panel-default">
        <div class="head-object"></div>
        <div class="panel-heading"> 
            店舗一覧
        </div>
        <div class="panel-body">
            <div class="container card_result">
                
            </div>
        </div>
    </div>

    <script>
      // This example adds a search box to a map, using the Google Place Autocomplete
      // feature. People can enter geographical searches. The search box will return a
      // pick list containing a mix of places and predicted search terms.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 35.6811673, lng: 139.76705160000006},
          zoom: 16,
          mapTypeId: 'roadmap',
          disableDefaultUI: true
        });
        
        //-------------POI削除
         var styleOptions = [{
            featureType: "poi",
            elementType: "labels",
            stylers: [{visibility: "off"}]
         }];
        map.setOptions({styles: styleOptions});
        
        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);

        // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();
          
          console.log(places[0].id);
          console.log(places[0].name);
          console.log(places[0].formatted_phone_number);
          console.log(places[0].opening_hours);
          console.log(places[0].geometry.location.lat());
          console.log(places[0].geometry.location.lng());
          console.log(places[0].photos[0].getUrl({
            maxHeight: 200
          }));

          console.log(places);
          
          // 表示中リスト　リセット
          $(".card").remove();
          
          // 取得リスト一覧表示
          for(let i of Object.keys(places)) {
            var name      = places[i].name
            var address   = places[i].formatted_address
            var place_id  = places[i].id  
            var lat       = places[i].geometry.location.lat()
            var lng       = places[i].geometry.location.lng()
            var photo     = typeof places[i].photos !== 'undefined' 
       ? places[i].photos[0].getUrl({'maxWidth': 200, 'maxHeight': 200}): '' 
       //alternative a "nophoto.jpg"
       
            // places[i].photos[0].getUrl({maxWidth: 300})

            $('.card_result').append(`
                <div class="row card">
                    <a class ="none-decoration" href="#">
                        <div class="col-xs-7 col-md-9 card-content">
                            <div class ="card_shop_name">${name}</div>
                            <hr class="card_hr">
                            <div class="card_shop_detail">${address}</div>
                        </div>
                        
                        <div class="col-xs-3 col-md-2 card-img-box">
                              <div class="card-img" style="background-image: url('${photo}')"></div>
                        </div>
                        
                        <div class="col-xs-2 col-md-1 add-btn">
                             <form action="{{ url('shops') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="shop_name" id="shop_name" value="${name}">
                                <input type="hidden" name="formatted_address" id="address" value="${address}">
                                <input type="hidden" name="place_id" id="place_id" value="${place_id}">
                                <input type="hidden" name="lat" id="lat" value="${lat}">
                                <input type="hidden" name="lng" id="lng" value="${lng}">
                                <input type="hidden" name="photo" id="photo" value="${photo}">
                                <button type="submit">
                                    <img src="{{ asset('/image/add_nonactive.png') }}" calss="btn-img" alt="shop_phote" width="30px" height="30px">
                                </button>
                            </form>
                        </div>
                    </a>
                </div>
            
                       
            `);

          }



          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });

      }

      

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPJtfkTJKQR_tyfo8tcfyWZQQr3UPeIK0&libraries=places&callback=initAutocomplete"
         async defer></script>

 @endsection 

<!--なぜかマップ表示にこれが必要-->