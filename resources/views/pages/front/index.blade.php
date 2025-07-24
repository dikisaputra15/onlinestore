@extends('layouts.appfront')

@section('title', 'Hompe Page')

@push('style')
<style>
    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: #333;
    }
    .mb-3 {
        margin-bottom: 1rem;
    }
    .d-flex.align-items-end {
        display: flex;
        align-items: flex-end;
    }
    .form-control, .btn {
        border-radius: 0.375rem;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    .btn-outline-secondary {
        border-color: #6c757d;
        color: #6c757d;
    }
</style>
@endpush

@section('main')

<main class="main">

</main>

@endsection

@push('scripts')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.min.js"></script>

<script>
let map = L.map('map').setView([-6.1751, 106.8650], 13);
let markers = [];
let routingControl;
let userLat = null, userLng = null;

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18
}).addTo(map);

function clearMap() {
    markers.forEach(marker => map.removeLayer(marker));
    markers = [];

    if (routingControl) {
        map.removeControl(routingControl);
    }
}

function useMyLocation() {
    navigator.geolocation.getCurrentPosition(pos => {
        userLat = pos.coords.latitude;
        userLng = pos.coords.longitude;
        searchByCoordinates(userLat, userLng);
    }, () => {
        alert("Gagal mendapatkan lokasi. Coba izinkan akses lokasi.");
    });
}

function searchLocation() {
    const location = document.getElementById("locationSearch").value;
    const radius = document.getElementById("radiusKm").value || 10;

    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${location}`)
        .then(res => res.json())
        .then(data => {
            if (!data.length) {
                alert("Lokasi tidak ditemukan");
                return;
            }

            const lat = parseFloat(data[0].lat);
            const lng = parseFloat(data[0].lon);
            userLat = lat;
            userLng = lng;

            searchByCoordinates(lat, lng);
        });
}

function searchByCoordinates(lat, lng) {
    const radius = document.getElementById("radiusKm").value || 10;
    clearMap();

    map.setView([lat, lng], 13);
    const userMarker = L.marker([lat, lng]).addTo(map).bindPopup("Lokasi Anda").openPopup();
    markers.push(userMarker);

    fetch(`/api/teknisi?lat=${lat}&lng=${lng}&radius=${radius}`)
        .then(res => res.json())
        .then(techs => {
            if (!techs.length) {
                alert("Tidak ada teknisi dalam radius ini.");
                return;
            }

            techs.forEach(tech => {
                const marker = L.marker([tech.latitude, tech.longitude]).addTo(map);

                const imageUrl = tech.image
                    ? `${tech.image}`
                    : 'https://via.placeholder.com/150x100?text=No+Image';

                const wa = `https://wa.me/62${tech.phone.replace(/^0/, '')}`;
                const popupContent = `
                    <b>${tech.name}</b><br>
                    Telp: ${tech.phone}<br>
                    Jarak: ${tech.distance} km<br>
                    <img src="${imageUrl}" alt="${tech.name}" width="100%" style="border-radius:6px;"><br>
                    <a href="${wa}" target="_blank" class="btn btn-success btn-sm mt-2" style="color:white;">WhatsApp</a>
                    <button class="btn btn-info btn-sm mt-2" onclick="routeTo(${tech.latitude}, ${tech.longitude})">Lihat Rute</button>
                    <button class="btn btn-warning btn-sm mt-2" onclick="orderTechnician('${tech.name}', '${tech.phone}', ${tech.id})">Pesan Teknisi</button>
                `;

                marker.bindPopup(popupContent);
                markers.push(marker);
            });
        });
}

function routeTo(destLat, destLng) {
    if (!userLat || !userLng) {
        alert("Lokasi Anda tidak diketahui.");
        return;
    }

    if (routingControl) {
        map.removeControl(routingControl);
    }

    routingControl = L.Routing.control({
        waypoints: [
            L.latLng(userLat, userLng),
            L.latLng(destLat, destLng)
        ],
        routeWhileDragging: false
    }).addTo(map);
}

function orderTechnician(name, phone) {
    const confirmOrder = confirm(`Anda yakin ingin memesan teknisi ${name}?`);
    if (confirmOrder) {
        alert(`Pesanan untuk teknisi ${name} sedang diproses. Silakan hubungi via WhatsApp untuk konfirmasi.`);
        window.open(`https://wa.me/62${phone.replace(/^0/, '')}?text=Halo%20${name},%20saya%20ingin%20memesan%20layanan%20teknisi.`, '_blank');
    }
}
</script>
<script>
    function orderTechnician(name, phone, id) {
        document.getElementById('techId').value = id;
        document.getElementById('techName').value = name;
        new bootstrap.Modal(document.getElementById('orderModal')).show();
    }
</script>

@endpush
