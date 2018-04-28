 <!-- resources/views/shops.blade.php -->

<!-- @extends('layouts.app') -->
<!-- @section('content') -->
 <!-- バリデーションエラーの表示に使用 -->
<!-- @include('common.errors') -->
  <!-- バリデーションエラーの表示に使用 -->


<link rel="{{asset('css/search.css')}}" href="" type="text/css" />



<!-- @endsection -->
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Places Searchbox</title>
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
      .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      .pac-container {
        font-family: Roboto;
      }

      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }
      #target {
        width: 345px;
      }
      .test{
        background-color:antiquewhite;
      }
    </style>
  </head>
  <body>
    <input id="pac-input" class="controls" type="text" placeholder="Search Box">
    <div id="map"></div>
    <div class="test">
    
    <table>
            <tr></tr>
    </table>
    
    </div>
    <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>

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
          mapTypeId: 'roadmap'
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);

        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

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
          console.log(places[0].geometry.location.lat());
          console.log(places[0].geometry.location.lng());
          console.log(places[0].photos[0].getUrl({
            maxHeight: 200
          }));

          console.log(places);
          
          // 表示中リストリセット
          $("tr").remove();
          
          // 取得リスト一覧表示
          for(let i of Object.keys(places)) {
            var name = places[i].name
            var address = places[i].formatted_address
            var place_id = places[i].id  
            var photo =places[i].photos[0].getUrl({maxWidth: 300})
            
            $('tbody').append(`
                <tr>
                    <td>${name}</td>
                    <td>${address}</td>
                    <td>
                        <form action="{{ url('shops') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="shop_name" id="shop_name" value="${name}">
                            <button type="submit" class="btn btn-danger">
                                 <i class="glyphicon glyphicon-trash"></i> save
                            </button>
                        </form>
                    </td>   
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
    <script src="https://maps.googleapis.com/maps/api/js?key=      &libraries=places&callback=initAutocomplete"
         async defer></script>

  </body>
</html>