function initAutocomplete() {
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: -33.8688, lng: 151.2195},
      zoom: 13,
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
        // var id = places[i].id  
        var photo =places[i].photos[0].getUrl({maxWidth: 300})
        
        $('table').append(`
        <tr>
        <td>${name}</td>
        <td>${address}</td>
        <td><img src="${photo}" alt="shop_photo"></td>
        <td><a href="">add</a></td>

        </tr>
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