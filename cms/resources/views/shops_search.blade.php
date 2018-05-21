 <!-- resources/views/shops.blade.php -->

 @extends('layouts.app') 
 @section('content') 
 <!-- バリデーションエラーの表示に使用 -->
 @include('common.errors') 
  <!-- バリデーションエラーの表示に使用 -->
 
     <div class="search_wrap">
        <dl class="search">
            <dt class ="search_box"><input id="pac-input"  type="text" class="controls" name="search" value="" placeholder="　店舗検索　/　例)渋谷駅　そば" /></dt>
            <dd><button id="submit"><span></span></button></dd>
        </dl>
    </div>
 
    <!--<input id="pac-input" class="controls" type="text" placeholder="エリア× ジャンル">-->
    <div id="map"></div>

    <div class="test">
    
    <div class="panel panel-default">
      <div class="panel-heading"> 
        店舗一覧
      
      </div>
        <div class="panel-body">
          <table class="table table-striped task-table">
            <!-- テーブルヘッダ -->
            <!--<thead>-->
            <!--  <th>店舗一覧</th>-->
            <!--  <th>&nbsp;</th>-->
            <!--</thead>  -->
            
            <tr></tr>
            
          </table>
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
          $("tr").remove();
          
          // 取得リスト一覧表示
          for(let i of Object.keys(places)) {
            var name      = places[i].name
            var address   = places[i].formatted_address
            var place_id  = places[i].id  
            var lat       = places[i].geometry.location.lat()
            var lng       = places[i].geometry.location.lng()
            var photo     = places[i].photos[0].getUrl({maxWidth: 300})

            $('tbody').append(`
                <tr>
                    <td>${name}</td>
                    <td>${address}</td>
  
                    <td>
                        <form action="{{ url('shops') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="shop_name" id="shop_name" value="${name}">
                            <input type="hidden" name="formatted_address" id="address" value="${address}">
                            <input type="hidden" name="place_id" id="place_id" value="${place_id}">
                            <input type="hidden" name="lat" id="lat" value="${lat}">
                            <input type="hidden" name="lng" id="lng" value="${lng}">
                            {{--// <input type="hidden" name="photo" id="photo" value="${photo}">--}}

                            

                            <button type="submit" class="btn btn-plus">
                                 <i class="glyphicon glyphicon-pencil"></i> save
                            </button>
                        </form>
                    {{--//   <td>
                    //         <form action="{{ url('detail/'.${place_id}) }}" method="get">
                    //           {{ csrf_field() }}
                    //             <button type="submit" class="btn btn-primary">
                    //                 <i class="glyphicon glyphicon-pencil"></i> 詳細
                    //             </button>
                    //         </form>
                    //     </td>
                    // </td>
                    --}}
                    
                </tr>`);

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