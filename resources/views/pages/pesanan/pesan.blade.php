@extends('layouts.appfront')

@section('title', 'Hompe Page')

@push('style')

@endpush

@section('main')

<main class="main">

    <section id="about" class="about section">
      <div class="container">
        <div class="row">
            <h2 style="text-align: center;">Pesan Teknisi</h2>

        <form action="{{ url('proses-pesan-teknisi') }}" method="POST">
            @csrf
            <div class="form-group">
                <div class="col-lg-12">
                    <label>Nama IT Service</label>
                    <input type="text" id="locationSearch" class="form-control" value="{{$teknisi->name}}" readonly>
                    <input type="text" id="locationSearch" class="form-control" name="teknisi_id" value="{{$teknisi->id}}" hidden>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-12">
                    <label>Lokasi Anda</label>
                    <div id="myMap" style="height: 400px; border: 1px solid #ccc;"></div>
                <div class="col-lg-12">
            </div>

            <div class="form-group">
                <div class="col-lg-12">
                    <label>Latitude</label>
                    <input type="text" id="latitude" name="pelanggan_latitude" class="form-control" readonly>
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-12">
                    <label>Longitude</label>
                    <input type="text" id="longitude" name="pelanggan_longitude" class="form-control" readonly>
                </div>
            </div>

             <div class="form-group">
                <div class="col-lg-12">
                     <label>Nama Pemesan</label>
                    <input type="text" name="nama_pemesan" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-12">
                     <label>Alamat</label>
                    <input type="text" name="alamat" class="form-control">
                </div>
            </div>

             <div class="form-group">
                <div class="col-lg-12">
                     <label>No HP</label>
                    <input type="text" name="no_hp" class="form-control">
                </div>
            </div>

             <div class="form-group">
                <div class="col-lg-12">
                     <label>Deskripsi</label>
                    <input type="text" name="deskripsi" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-12">
                     <label>Jenis Kerusakan dan jasa Service</label>
                    <select class="form-control" name="jenis_kerusakan_id" id="jenis">
                            <option>-Pilih Jenis Kerusakan-</option>
                        @foreach ($jenis as $jen)
                            <option value="{{$jen->id}}" data-biayajenis="{{ $jen->biaya }}">{{$jen->jenis_kerusakan}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

             <div class="form-group mt-2">
                <div class="col-lg-12">
                    <label>Biaya Service</label>
                    <input type="text" id="biaya_service" class="form-control" readonly>
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-12">
                     <label>Tarif Jemput atau datang ketoko</label>
                    <select class="form-control" name="tarif_id" id="jasa">
                        <option>-Pilih Jasa-</option>
                        @foreach ($tarif as $tar)
                            <option value="{{$tar->id}}" data-biaya="{{ $tar->tarif_antar }}">{{$tar->nama_jasa}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group mt-2">
                <div class="col-lg-12">
                    <label>Biaya Jasa</label>
                    <input type="text" id="biaya_jasa" class="form-control" readonly>
                </div>
            </div>

            <div class="form-group mt-2">
                <div class="col-lg-12">
                    <label>Total Biaya</label>
                    <input type="text" id="total_biaya" name="total_biaya" class="form-control" readonly>
                </div>
            </div>

            <div class="form-group mt-2">
                <div class="col-lg-12">
                    <button class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
      </div>
      </div>

    </section>

  </main>

@endsection

@push('scripts')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.min.js"></script>

<script>
    // Inisialisasi peta
    const myMap = L.map('myMap').setView([-6.2, 106.8], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map by OpenStreetMap',
        maxZoom: 18,
    }).addTo(myMap);

    // Tambahkan marker draggable
    const draggableMarker = L.marker([-6.2, 106.8], {
        draggable: true
    }).addTo(myMap).bindPopup('lokasi Anda.').openPopup();

    // Set nilai awal lat/lng ke form
    document.getElementById('latitude').value = draggableMarker.getLatLng().lat;
    document.getElementById('longitude').value = draggableMarker.getLatLng().lng;

    // Update form saat pin digeser
    draggableMarker.on('dragend', function (e) {
        const latlng = e.target.getLatLng();
        document.getElementById('latitude').value = latlng.lat;
        document.getElementById('longitude').value = latlng.lng;
    });

    // Jika tersedia, gunakan lokasi pengguna
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (pos) {
            const lat = pos.coords.latitude;
            const lng = pos.coords.longitude;

            myMap.setView([lat, lng], 15);
            draggableMarker.setLatLng([lat, lng]).openPopup();

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        }, function () {
            alert("Gagal mendeteksi lokasi. Anda bisa geser pin secara manual.");
        });
    }
</script>

 <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectGajah = document.getElementById('jasa');
            const inputNopol = document.getElementById('biaya_jasa');

            function updateNopol() {
                const selectedOption = selectGajah.options[selectGajah.selectedIndex];
                inputNopol.value = selectedOption.getAttribute('data-biaya') || '';
            }

            selectGajah.addEventListener('change', updateNopol);

            // jalankan saat load pertama
            updateNopol();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectJenis = document.getElementById('jenis');
            const inputBiaya = document.getElementById('biaya_service');

            function updateBiaya() {
                const selectedOpsi = selectJenis.options[selectJenis.selectedIndex];
                inputBiaya.value = selectedOpsi.getAttribute('data-biayajenis') || '';
            }

            selectJenis.addEventListener('change', updateBiaya);

            // jalankan saat load pertama
            updateBiaya();
        });
    </script>

 <script>
document.addEventListener('DOMContentLoaded', function () {
    const selectJenis = document.getElementById('jenis');
    const selectJasa = document.getElementById('jasa');
    const biayaServiceInput = document.getElementById('biaya_service');
    const biayaJasaInput = document.getElementById('biaya_jasa');
    const totalBiayaInput = document.getElementById('total_biaya');

    function parseIntOrZero(value) {
        const val = parseInt(value);
        return isNaN(val) ? 0 : val;
    }

    function updateBiaya() {
        const selectedJenis = selectJenis.options[selectJenis.selectedIndex];
        const selectedJasa = selectJasa.options[selectJasa.selectedIndex];

        const biayaService = parseIntOrZero(selectedJenis.getAttribute('data-biayajenis'));
        const biayaJasa = parseIntOrZero(selectedJasa.getAttribute('data-biaya'));

        biayaServiceInput.value = biayaService;
        biayaJasaInput.value = biayaJasa;

        const total = biayaService + biayaJasa;
        totalBiayaInput.value = total;
    }

    // Bind event change
    selectJenis.addEventListener('change', updateBiaya);
    selectJasa.addEventListener('change', updateBiaya);

    // Jalankan saat pertama kali halaman dimuat
    updateBiaya();
});
</script>


@endpush
