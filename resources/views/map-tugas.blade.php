<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tugas Hands-on 1</title>
  <!-- Leaflet.js CDN -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <!-- Google Maps API -->
  <script src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_maps_api_key') }}"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    h1 {
      text-align: center;
      padding: 10px;
    }

    #leaflet-map,
    #google-map {
      height: 400px;
      margin: 20px auto;
      max-width: 90%;
    }
  </style>
</head>

<body>
  <h1>Tugas 1</h1>

  <div id="leaflet-map"></div>
  <div id="google-map"></div>

  <script>
    
    const mapObj = [
      {
        pos: {
          lat: -8.7984047,
          lng: 115.1698715,
        },
        caption: "<b>Kantor:</b> Rektorat Universitas Udayana."
      },
      {
        pos: {
          lat: -8.656023429787052, 
          lng: 115.21631667750822,
        },
        caption: "<b>Kantor:</b> Wali Kota Denpasar."
      }
    ];
    
    const ZOOM = 11;

    // leaflet
    const leafletMap = L.map('leaflet-map').setView(mapObj[1].pos, ZOOM);

    const mapTile = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(leafletMap);

    const leafletMarker = mapObj.map((x) => {
      const lMarker = L.marker(x.pos).addTo(leafletMap).bindPopup(x.caption);

      lMarker.on('click', () => {
        lMarker.openPopup();
      });
    });


    // google map
    const googleMapElement = document.getElementById('google-map');
    const googleMap = new google.maps.Map(googleMapElement, {
      center : mapObj[0].pos,
      zoom: ZOOM,
    });

    const googleMapMarker = new google.maps.Marker({
      position: mapObj[0].pos,
      map: googleMap,
    });

    const infoWindow = new google.maps.InfoWindow();

    googleMapMarker.addListener('click', () => {
      infoWindow.close();
      infoWindow.setContent(mapObj[0].caption);
      infoWindow.open({
        anchor: googleMapMarker,
        googleMap,
      });
    })
  </script>
</body>

</html>