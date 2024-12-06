<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dasar Peta Interaktif</title>

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
  <h1>Peta Interaktif dengan Laravel</h1>

  <div id="leaflet-map"></div>
  <div id="google-map"></div>

  <script>
    const mapsObj = [
      {
        lat: -8.6509,
        lng: 115.2194,
        caption: "<b>Universitas Udayana</b><br>Denpasar, Bali",
        title: "Universitas Udayana",
      },
      {
        lat: -8.635599413914395,
        lng: 115.231830902144,
        caption: "<b>Living World</b><br>Denpasar, Bali",
        title: "Living World",
      },
      {
        lat: -8.656362810443232,
        lng: 115.2177578258145,
        caption: "<b>Lapangan Puputan Badung (I Gusti Ngurah Made Agung)</b><br>Denpasar, Bali",
        title: "Lapangan Puputan Badung (I Gusti Ngurah Made Agung)",
      },
      {
        lat: -8.810300111629076,
        lng: 115.16760910543631,
        caption: "<b>Taman Budaya Garuda Wisnu Kencana</b><br>Badung, Bali",
        title: "Taman Budaya Garuda Wisnu Kencana",
      },
    ];

    // global var
    let zoomGmaps = 10;
    let zoomLeaflet = 10;
    const INIT_POS = {
      lat: -8.6509,
      lng: 115.2194
    };

    // Leaflet.js Map
    const leafletMap = L.map('leaflet-map').setView([INIT_POS.lat, INIT_POS.lng], zoomLeaflet);

    const Esri_WorldImagery = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
      attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
    }).addTo(leafletMap);


    // Google Maps API Map
    const googleMapDiv = document.getElementById('google-map');
    const googleMap = new google.maps.Map(googleMapDiv, {
      center: {
        lat: INIT_POS.lat,
        lng: INIT_POS.lng,
      },
      zoom: zoomGmaps,
    });

    const infoWindow = new google.maps.InfoWindow();

    // gmaps Marker
    const gmapsMarker = mapsObj.map((x) => {
      const marker = new google.maps.Marker({
        position: {
          lat: x.lat,
          lng: x.lng,
        },
        map: googleMap,
        title: x.title,
      });

      marker.addListener('click', () => {
        infoWindow.close();

        infoWindow.setContent(x.caption);

        infoWindow.open({
          anchor: marker,
          googleMap,
        });

        zoomGmaps = 13;
        googleMap.setZoom(zoomGmaps);
        googleMap.panTo(marker.position);
      });

      infoWindow.addListener('closeclick', () => {
        zoomGmaps = 10;
        googleMap.setZoom(zoomGmaps);
        googleMap.panTo(INITPOS);
      });


    });

    //  leaflet Marker
    const leafletMarker = mapsObj.map((x) => {
      const leafletMarker = L.marker([x.lat, x.lng]).bindPopup(x.caption).addTo(leafletMap);

      leafletMarker.on('click', () => {
        zoomLeaflet = 15;
        leafletMap.flyTo(leafletMarker.getLatLng(), zoomLeaflet);
        leafletMarker.openPopup();
      });

      leafletMarker.getPopup().on('remove', () => {
        zoomLeaflet = 10;
        leafletMap.flyTo(INITPOS, zoomLeaflet);
      });

    });
  </script>
</body>

</html>