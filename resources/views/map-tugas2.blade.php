@extends('layouts.app')

@section('title', 'Hands-on Lab 2,3,4 Tugas')


@section('content')
<div class="container-fluid"> <!-- Info boxes -->
  <!--begin::Row-->
  <div class="row">
    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="card-title">Map</h5>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse"> <i data-lte-icon="expand" class="bi bi-plus-lg"></i> <i data-lte-icon="collapse" class="bi bi-dash-lg"></i> </button>
            <button type="button" class="btn btn-tool" data-lte-toggle="card-remove"> <i class="bi bi-x-lg"></i> </button>
          </div>
        </div> <!-- /.card-header -->
        <div class="card-body"> <!--begin::Row-->
          <div class="row">
            <div class="col-md-12 text-black">
              <div id="map"></div>
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
          <h5 class="card-title">Google maps</h5>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse"> <i data-lte-icon="expand" class="bi bi-plus-lg"></i> <i data-lte-icon="collapse" class="bi bi-dash-lg"></i> </button>
            <button type="button" class="btn btn-tool" data-lte-toggle="card-remove"> <i class="bi bi-x-lg"></i> </button>
          </div>
        </div> <!-- /.card-header -->
        <div class="card-body"> <!--begin::Row-->
          <div class="row">
            <div class="col-md-12">
              <div id="google-map"></div>
              <div id="sidebar"></div>
            </div> <!-- /.col -->
          </div> <!--end::Row-->
        </div> <!-- ./card-body -->
      </div> <!-- /.card-footer -->
    </div> <!-- /.card -->
  </div>
  <div class="row"> <!-- Start col -->
    <div class="col-md-12"> <!--begin::Row-->
      <div class="row g-4 mb-4">
        <div class="col-md-6"> <!-- DIRECT CHAT -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Tambahin Marker</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse"> <i data-lte-icon="expand" class="bi bi-plus-lg"></i> <i data-lte-icon="collapse" class="bi bi-dash-lg"></i> </button>
                <button type="button" class="btn btn-tool" data-lte-toggle="card-remove"> <i class="bi bi-x-lg"></i> </button>
              </div>
            </div> <!-- /.card-header -->
            <div class="card-body"> <!-- Conversations are loaded here -->
              <form id="markerForm" method="post" action="{{ url('api/markers') }}">
                @csrf
                <div class="mb-2">
                  <label for="name" class="form-label">Nama Lokasi</label>
                  <input type="text" class="form-control" id="name" required>
                </div>
                <div class="mb-2">
                  <label for="latitude" class="form-label">Latitude</label>
                  <input type="number" step="any" class="form-control" id="latitude" required>
                </div>
                <div class="mb-2">
                  <label for="longitude" class="form-label">Longitude</label>
                  <input type="number" step="any" class="form-control" id="longitude" required>
                </div>
                <div class="d-flex gap-3">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-danger">Reset</button>
                </div>
              </form>
            </div> <!-- /.card-body -->
          </div> <!-- /.direct-chat -->
        </div> <!-- /.col -->
        <div class="col-md-6"> <!-- USERS LIST -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Tambahkan Poligon</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse"> <i data-lte-icon="expand" class="bi bi-plus-lg"></i> <i data-lte-icon="collapse" class="bi bi-dash-lg"></i> </button>
                <button type="button" class="btn btn-tool" data-lte-toggle="card-remove"> <i class="bi bi-x-lg"></i> </button>
              </div>
            </div> <!-- /.card-header -->
            <div class="card-body">
              <form id="polygonForm" method="post" action="{{ url('api/polygons') }}">
                @csrf
                <div class="mb-4">
                  <label for="polygon" class="form-label">Koordinat Poligon (JSON)</label>
                  <textarea class="form-control" id="polygon" rows="7"></textarea>
                </div>
                <div class="d-flex gap-3">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-danger">Reset</button>
                </div>
              </form>
            </div> <!-- /.card-body -->
          </div> <!-- /.card -->
        </div> <!-- /.col -->
      </div> <!--end::Row--> <!--begin::Latest Order Widget-->
    </div> <!-- /.col -->
  </div>
  <div class="row"> <!-- Start col -->
    <div class="col-md-12"> <!--begin::Row-->
      <!--begin::Latest Order Widget-->
      <div class="card mb-4">
        <div class="card-header">
          <h3 class="card-title">Marker list</h3>
          <div class="card-tools"> <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse"> <i data-lte-icon="expand" class="bi bi-plus-lg"></i> <i data-lte-icon="collapse" class="bi bi-dash-lg"></i> </button> <button type="button" class="btn btn-tool" data-lte-toggle="card-remove"> <i class="bi bi-x-lg"></i> </button> </div>
        </div> <!-- /.card-header -->
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table m-0">
              <thead>
                <tr>
                  <th class="text-center">ID</th>
                  <th class="text-center">Name</th>
                  <th class="text-center">Latitude</th>
                  <th class="text-center">Longitude</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($markerDatas as $data)
                <tr>
                  <td class="text-center align-middle">{{ $data->id }}</td>
                  <td class="text-center align-middle">{{ $data->name }}</td>
                  <td class="text-center align-middle">
                    {{ $data->latitude }}
                  </td>
                  <td class="text-center align-middle">
                    {{ $data->longitude }}
                  </td>
                  <td class="d-flex gap-3 justify-content-center">
                    <button class="btn btn-danger" onclick="deleteMarker('{{ $data->id }}')">Delete</button>
                    <button class="btn btn-warning" onclick="editMarker('{{ $data->id }}')">Edit</button>
                    <button class="btn btn-info" onclick="viewMarker('{{ $data->latitude }}', '{{ $data->longitude }}')">View</button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div> <!-- /.table-responsive -->
        </div> <!-- /.card-body -->
        <div class="card-footer clearfix"></div> <!-- /.card-footer -->
      </div> <!-- /.card -->
    </div> <!-- /.col -->
  </div> <!--end::Row-->
  <div class="row"> <!-- Start col -->
    <div class="col-md-12"> <!--begin::Row-->
      <!--begin::Latest Order Widget-->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Polygon list</h3>
          <div class="card-tools"> <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse"> <i data-lte-icon="expand" class="bi bi-plus-lg"></i> <i data-lte-icon="collapse" class="bi bi-dash-lg"></i> </button> <button type="button" class="btn btn-tool" data-lte-toggle="card-remove"> <i class="bi bi-x-lg"></i> </button> </div>
        </div> <!-- /.card-header -->
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table m-0">
              <thead>
                <tr>
                  <th class="text-center">ID</th>
                  <th class="text-center">Coordinates</th>
                  <th class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($polygonDatas as $data)
                <tr>
                  <td class="text-center align-center"> {{ $data->id }} </td>
                  <td class="text-center align-center"> {{ $data->coordinates }} </td>
                  <td class="d-flex gap-3 justify-content-center">
                    <button class="btn btn-danger" onclick="deletePolygon('{{ $data->id }}')">Delete</button>
                    <button class="btn btn-warning" onclick="editPolygon('{{ $data->id }}')">Edit</button>
                    <button class="btn btn-info" onclick="viewPolygon('{{ $data->id }}')">View</button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div> <!-- /.table-responsive -->
        </div> <!-- /.card-body -->
        <div class="card-footer clearfix"></div> <!-- /.card-footer -->
      </div> <!-- /.card -->
    </div> <!-- /.col -->
  </div> <!--end::Row-->
</div> <!--end::Container-->
@endsection

@push('scripts')
<script>
  const INIT_POS = {
    center: {
      lat: -8.668610512035432,
      lng: 115.21912340905781,
    },
    zoom: 10,
  };

  const zoomIn = 15;

  let markerMap = new Map();
  let polygonMap = new Map();
  let currentPosition = {};

  const googleMapElement = document.getElementById('google-map');
  const sideBar = document.getElementById('sidebar');
  const googleMap = new google.maps.Map(googleMapElement, {
    center: {
      lat: -8.7984047,
      lng: 115.1698715,
    },
    zoom: 11,
    mapId: "DEMO_MAP_ID",
  });

  // Layanan Directions
  let directionsService = new google.maps.DirectionsService();
  let directionsRenderer = new google.maps.DirectionsRenderer({
    suppressMarkers: true,
    preserveViewport: true,
  });
  const infoWindow = new google.maps.InfoWindow();

  // Tampilkan rute di peta
  directionsRenderer.setMap(googleMap);
  directionsRenderer.setPanel(sideBar);

  const map = L.map('map').setView([INIT_POS.center.lat, INIT_POS.center.lng], INIT_POS.zoom);

  const tile = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  function getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);
    } else {
      alert("Geolocation is not supported by this browser.");
    }
  }

  

  function showPosition(pos) {
    const crd = pos.coords;
    Object.assign(currentPosition, {
      latitude: crd.latitude,
      longitude: crd.longitude
    });
    const leafletMarker = L.marker([crd.latitude, crd.longitude])
      .bindPopup(`<b>Current Position</b>`)
      .addTo(map);
    const gmapsMarker = new google.maps.marker.AdvancedMarkerElement({
      position: {
        lat: crd.latitude,
        lng: crd.longitude,
      },
      map: googleMap,
    });

    gmapsMarker.addListener('click', () => {
      infoWindow.close();
      infoWindow.setContent("<b style='color: black;'>Current Position</b>");
      infoWindow.open({
        anchor: gmapsMarker,
        googleMap,
      });
    });
    return crd;
  }

  function smoothZoom(map, targetZoom, currentZoom) {
    if (currentZoom === targetZoom) {
      return;
    }

    let zoomStep = targetZoom > currentZoom ? 1 : -1;

    google.maps.event.addListenerOnce(map, 'zoom_changed', function() {
      smoothZoom(map, targetZoom, currentZoom + zoomStep);
    });

    const delay = 150;

    setTimeout(function() {
      map.setZoom(currentZoom);
    }, delay);
  }

  function showLeafletRoute(key) {
    const leafletMarker = markerMap.get(key);

    leafletMarker.openPopup();
    map.flyTo(leafletMarker.getLatLng(), 15);

    const startPoint = L.latLng(currentPosition.latitude, currentPosition.longitude);
    const endPoint = L.latLng(leafletMarker.getLatLng());

    leafletRoute = L.Routing.control({
      waypoints: [startPoint, endPoint],
      routeWhileDragging: false,
      createMarker: () => null,
      fitSelectedRoutes: false,
      lineOptions: {
        styles: [{
          color: 'blue',
          weight: 5
        }],
        interactive: true
      },
    }).addTo(map);
  }

  function showGmapsRoute(key) {
    const gmapsInfo = markerMap.get(key);
    const gmapsMarker = gmapsInfo.getLatLng();
    const {
      marker,
      info
    } = gmapsInfo;

    directionsRenderer.setMap(null);
    directionsRenderer.setPanel(null);
    directionsRenderer.setMap(googleMap);
    directionsRenderer.setPanel(sideBar);
    smoothZoom(googleMap, 16, googleMap.getZoom());
    setTimeout(() => {
      googleMap.panTo({
        lat: parseFloat(gmapsMarker.lat),
        lng: parseFloat(gmapsMarker.lng)
      });
    }, 300);

    infoWindow.close();
    infoWindow.setContent(`
    <h4>
      <b style='color: black;'>${info.name}</b>
    </h4>
    `);

    infoWindow.open({
      anchor: marker,
      map: googleMap,
    });

    directionsService.route({
      origin: {
        lat: parseFloat(currentPosition.latitude),
        lng: parseFloat(currentPosition.longitude),
      },
      destination: {
        lat: parseFloat(gmapsMarker.lat),
        lng: parseFloat(gmapsMarker.lng),
      },
      travelMode: google.maps.TravelMode.DRIVING,
    }).then((response) => {
      directionsRenderer.setDirections(response);
    }).catch((e) => window.alert(e.message));
  }


  function addMarkerToMap(markers, map) {
    markers.forEach((marker) => {
      const leafletMarker = L.marker([marker.latitude, marker.longitude])
        .bindPopup(`<b>${marker.name}</b>`)
        .addTo(map);

      // Google Maps Marker
      const gmapsMarker = new google.maps.marker.AdvancedMarkerElement({
        position: {
          lat: parseFloat(marker.latitude),
          lng: parseFloat(marker.longitude)
        },
        map: googleMap,
      });

      const key = `${marker.latitude},${marker.longitude}`;
      leafletMarker["marker"] = gmapsMarker;
      leafletMarker["info"] = {
        name: marker.name,
        description: marker.description
      };
      markerMap.set(key, leafletMarker);

      leafletMarker.on('click', () => {
        showLeafletRoute(key);
      });

      leafletMarker.on('popupclose', () => {
        map.flyTo(INIT_POS.center, INIT_POS.zoom);
        leafletRoute.remove();
      });

      // marker listener & route
      gmapsMarker.addListener('click', () => {
        showGmapsRoute(key);
      });

      infoWindow.addListener('closeclick', () => {
        smoothZoom(googleMap, 9, googleMap.getZoom());
        setTimeout(() => {
          googleMap.panTo(INIT_POS.center);
          directionsRenderer.setMap(null);
          directionsRenderer.setPanel(null);
        }, 300);
      });
    });
  }

  function addPolygonToMap(polygons, map) {
    polygons.forEach((polygon) => {
      const latlngs = JSON.parse(polygon.coordinates);
      const leafletPolygon = L.polygon(latlngs, {
          color: 'green'
        })
        .bindPopup(`<b>Polygon ${polygon.id}<b>`)
        .addTo(map);

      const key = `${polygon.id}`;
      polygonMap.set(key, leafletPolygon);

      leafletPolygon.on('click', () => {
        map.flyToBounds(leafletPolygon.getBounds());
        leafletPolygon.openPopup();
      });

      leafletPolygon.on('popupclose', () => {
        map.flyTo(INIT_POS.center, INIT_POS.zoom);
      })
    });
  }

  function viewMarker(lat, lng) {
    const mapContainer = document.getElementById('map');
    mapContainer.scrollIntoView();

    const key = `${lat},${lng}`;
    const marker = markerMap.get(key);

    if (marker) {
      marker.openPopup();
      setTimeout(() => {
        map.flyTo(marker.getLatLng(), zoomIn);
      }, 500);
    }
  }

  function viewPolygon(id) {
    const mapContainer = document.getElementById('map');
    mapContainer.scrollIntoView();

    const key = `${id}`;
    const polygon = polygonMap.get(key);

    if (polygon) {
      map.flyToBounds(polygon.getBounds());
      polygon.openPopup();
    }
  }

  function main(markers, polygons) {
    getLocation();
    addMarkerToMap(markers, map);
    addPolygonToMap(polygons, map);
  }

  const markerDatas = @json($markerDatas);
  const polygonDatas = @json($polygonDatas);

  // Initialize the map with markers
  main(markerDatas, polygonDatas);
</script>
@endpush

@prepend('style')
<style>
  #map,
  #google-map {
    height: 400px;
    margin: auto;
  }

  #sidebar {
    position: absolute;
    top: 8rem;
    right: 20px;
    background: white;
    padding: 10px;
    border: 1px solid #ccc;
    z-index: 5;
    max-height: 25%;
    max-width: 25%;
    overflow-y: auto;
    font-size: small;
  }
</style>
@endprepend

@push('scripts')
<script>
  const markerForm = document.getElementById('markerForm');
  const polygonForm = document.getElementById('polygonForm');

  markerForm.addEventListener('submit', async (e) => {
    try {
      e.preventDefault();

      const latInput = document.getElementById('latitude').value;
      const lngInput = document.getElementById('longitude').value;
      const name = document.getElementById('name').value;
      const latitude = parseFloat(latInput);
      const longitude = parseFloat(lngInput);


      const request = await fetch("/api/markers", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRf-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
          name,
          latitude,
          longitude
        }),
      });

      const response = await request.json();
      if (response) {
        Swal.fire({
          title: 'Success!',
          text: 'Berhasil menyimpan data marker',
          icon: 'success',
          confirmButtonText: 'Oke'
        }).then((res) => {
          if (res.isConfirmed) {
            window.location.reload(true);
          }
        });
      }

    } catch (error) {
      Swal.fire({
        title: 'Error!',
        text: 'Gagal menyimpan data marker',
        icon: 'error',
        confirmButtonText: 'Oke'
      });
    }
  });

  polygonForm.addEventListener('submit', async (e) => {
    try {
      e.preventDefault();

      const coordinates = JSON.parse(document.getElementById('polygon').value);

      const request = await fetch("/api/polygons", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRf-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
          coordinates,
        }),
      });

      const response = await request.json();
      if (response) {
        Swal.fire({
          title: 'Success!',
          text: 'Berhasil menyimpan data polygon',
          icon: 'success',
          confirmButtonText: 'Oke'
        }).then((res) => {
          if (res.isConfirmed) {
            window.location.reload(true);
          }
        });
      }

    } catch (error) {
      Swal.fire({
        title: 'Error!',
        text: 'Gagal menyimpan data marker',
        icon: 'error',
        confirmButtonText: 'Oke'
      });
    }
  });

  async function deleteMarker(id) {
    const alert = await Swal.fire({
      title: 'Apakah ingin menghapus data marker ini?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Iya',
      cancelButtonText: 'Batal'
    });

    if (alert.isConfirmed) {
      fetch(`/api/markers/${id}`, {
        method: "DELETE",
        headers: {
          "Content-Type": "application/json",
          "X-CSRf-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
      }).then((res) => {
        if (res) {
          Swal.fire({
            title: 'Terhapus!',
            icon: 'success',
            text: `Berhasil menghapus data dengan ID ${id}`,
            confirmButtonText: 'Iya',
          }).then((r) => {
            if (r.isConfirmed) {
              window.location.reload(true);
            }
          });
        }
      });
    }
  }

  async function editMarker(id) {
    const res = await fetch(`/api/markers/${id}`, {
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      },
    });

    const data = await res.json();

    const {
      value: formValues
    } = await Swal.fire({
      title: "Edit Marker",
      html: `
            <div class="mb-2">
                <label for="editName" class="form-label">Nama Lokasi</label>
                <input type="text" class="form-control" id="editName" value="${data.name}" required>
            </div>
            <div class="mb-2">
                <label for="editLatitude" class="form-label">Latitude</label>
                <input type="number" step="any" class="form-control" id="editLatitude" value="${data.latitude}" required>
            </div>
            <div class="mb-2">
                <label for="editLongitude" class="form-label">Longitude</label>
                <input type="number" step="any" class="form-control" id="editLongitude" value="${data.longitude}" required>
            </div>
        `,
      showCancelButton: true,
      confirmButtonText: "Save",
      preConfirm: () => {
        return {
          name: document.getElementById("editName").value,
          latitude: document.getElementById("editLatitude").value,
          longitude: document.getElementById("editLongitude").value,
        };
      },
    });

    if (formValues) {
      await updateMarker(id, formValues);
    }
  }

  async function editPolygon(id) {
    const res = await fetch(`/api/polygons/${id}`, {
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      },
    });

    const data = await res.json();

    const {
      value: formValues
    } = await Swal.fire({
      inputLabel: "Edit Polygon",
      input: "textarea",
      inputValue: data.coordinates,
      showCancelButton: true,
      confirmButtonText: "Save",
    });

    if (formValues) {
      updatePolygon(id, formValues);
    }
  }

  async function updateMarker(id, data) {
    const response = await fetch(`/api/markers/${id}`, {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      },
      body: JSON.stringify(data),
    });

    if (response.ok) {
      Swal.fire("Success", "Marker Berhasil di update!", "success").then((r) => {
        if (r.isConfirmed) {
          window.location.reload(true);
        }
      });
    } else {
      Swal.fire("Error", "marker gagal di update!", "error");
    }
  }

  async function updatePolygon(id, data) {
    const response = await fetch(`/api/polygons/${id}`, {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      },
      body: JSON.stringify({
        coordinates: data
      }),
    });

    if (response.ok) {
      Swal.fire("Success", "Polygon Berhasil di update!", "success").then((r) => {
        if (r.isConfirmed) {
          window.location.reload(true);
        }
      });
    } else {

      Swal.fire("Error", "Polygon gagal di update!", "error");
    }
  }

  async function deletePolygon(id) {
    const alert = await Swal.fire({
      title: 'Apakah ingin menghapus data polygon ini?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Iya',
      cancelButtonText: 'Batal'
    });

    if (alert.isConfirmed) {
      fetch(`/api/polygons/${id}`, {
        method: "DELETE",
        headers: {
          "Content-Type": "application/json",
          "X-CSRf-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
      }).then((res) => {
        if (res) {
          Swal.fire({
            title: 'Terhapus!',
            icon: 'success',
            text: `Berhasil menghapus data dengan ID ${id}`,
            confirmButtonText: 'Iya',
          }).then((r) => {
            if (r.isConfirmed) {
              window.location.reload(true);
            }
          });
        }
      });
    }
  }
</script>
@endpush