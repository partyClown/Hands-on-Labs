@extends('layouts.app')

@section('title', 'Hands-on-Labs 1 Latihan')

@section('content')
<div class="container-fluid"> <!-- Info boxes -->
  <!--begin::Row-->
  <div class="row">
    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="card-title">Leaflet Map</h5>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse"> <i data-lte-icon="expand" class="bi bi-plus-lg"></i> <i data-lte-icon="collapse" class="bi bi-dash-lg"></i> </button>
            <button type="button" class="btn btn-tool" data-lte-toggle="card-remove"> <i class="bi bi-x-lg"></i> </button>
          </div>
        </div> <!-- /.card-header -->
        <div class="card-body"> <!--begin::Row-->
          <div class="row">
            <div class="col-md-12">
              <div id="leaflet-map"></div>
            </div> <!-- /.col -->
          </div> <!--end::Row-->
        </div> <!-- ./card-body -->
      </div> <!-- /.card-footer -->
    </div> <!-- /.card -->
  </div> <!-- /.col -->
  <div class="row">
    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="card-title">Google Map</h5>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse"> <i data-lte-icon="expand" class="bi bi-plus-lg"></i> <i data-lte-icon="collapse" class="bi bi-dash-lg"></i> </button>
            <button type="button" class="btn btn-tool" data-lte-toggle="card-remove"> <i class="bi bi-x-lg"></i> </button>
          </div>
        </div> <!-- /.card-header -->
        <div class="card-body"> <!--begin::Row-->
          <div class="row">
            <div class="col-md-12">
              <div id="google-map"></div>
            </div> <!-- /.col -->
          </div> <!--end::Row-->
        </div> <!-- ./card-body -->
      </div> <!-- /.card-footer -->
    </div> <!-- /.card -->
  </div> <!-- /.col -->
</div> <!--end::Container-->
@endsection

@prepend('style')
<style>
  #leaflet-map,
  #google-map {
    height: 400px;
    margin: auto;
  }
</style>
@endprepend

@push('scripts')
<script>
  const mapsObj = [{
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
  const INITPOS = {
    lat: -8.6509,
    lng: 115.2194
  };

  // Leaflet.js Map
  const leafletMap = L.map('leaflet-map').setView([INITPOS.lat, INITPOS.lng], zoomLeaflet);

  // const openStreetMap = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  //   attribution: '&copy; OpenStreetMap contributors'
  // }).addTo(leafletMap);

  const Esri_WorldImagery = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
  }).addTo(leafletMap);


  // Google Maps API Map
  const googleMapDiv = document.getElementById('google-map');
  const googleMap = new google.maps.Map(googleMapDiv, {
    center: {
      lat: INITPOS.lat,
      lng: INITPOS.lng,
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
@endpush