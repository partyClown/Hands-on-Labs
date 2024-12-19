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
  const mapObj = [{
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
    center: mapObj[0].pos,
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
@endpush