<!DOCTYPE html>
<html>
<head>
    <title>Capture Image with Full Location & Lat/Long Overlay</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIINfQSi7dLyFK+e8zdPkxfHDalLVyY/vL7U="
     crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjGwZGEkMMpQJw/s5oLFow5N+RiZXp="
     crossorigin=""></script>

    <style>
        body { font-family: sans-serif; margin: 20px; background-color: #f4f4f4; }
        h1, h2 { color: #333; }
        #video-container {
            position: relative;
            width: 640px; /* Sesuaikan ukuran */
            height: 480px; /* Sesuaikan ukuran */
            border: 1px solid #ccc;
            margin-bottom: 10px;
            overflow: hidden;
            background-color: #000;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #video {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Penting untuk video agar mengisi area */
            display: block;
        }
        #overlayCanvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none; /* Agar tidak menghalangi interaksi video/gambar di bawahnya */
        }
        button {
            padding: 10px 20px;
            margin-right: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }
        button:hover:not(:disabled) {
            background-color: #0056b3;
        }
        #resultCanvas, #finalImage {
            border: 1px solid black;
            margin-top: 20px;
            max-width: 100%;
            height: auto;
            display: none; /* Sembunyikan secara default */
        }
        .message {
            margin-top: 10px;
            padding: 8px 12px;
            border-radius: 4px;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .info-message {
            background-color: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
    </style>
</head>
<body>
    <h1>Ambil Foto dengan Lokasi Lengkap & Lat/Long</h1>

    <div id="video-container">
        <video id="video" autoplay></video>
        <canvas id="overlayCanvas"></canvas>
    </div>
    <button id="start-camera">Mulai Kamera</button>
    <button id="capture-btn" disabled>Ambil Foto</button>
    <div id="status-message" class="message info-message">Siap memulai kamera.</div>

    <h2>Hasil Foto:</h2>
    <canvas id="resultCanvas"></canvas>
    <img id="finalImage">

    <script>
        // Endpoint Nominatim OpenStreetMap untuk geocoding terbalik
        // Harap patuhi kebijakan penggunaan Nominatim: https://nominatim.org/release-docs/develop/api/Reverse/
        // Menambahkan parameter 'extratags=1' mungkin memberikan detail lebih lanjut
        const NOMINATIM_REVERSE_GEOCODING_URL = 'https://nominatim.openstreetmap.org/reverse?format=json&addressdetails=1';
        // Nominatim tidak memerlukan API Key untuk penggunaan dasar, tetapi ada batasan penggunaan.

        const video = document.getElementById('video');
        const overlayCanvas = document.getElementById('overlayCanvas');
        const resultCanvas = document.getElementById('resultCanvas');
        const finalImage = document.getElementById('finalImage');
        const startCameraButton = document.getElementById('start-camera');
        const captureButton = document.getElementById('capture-btn');
        const statusMessage = document.getElementById('status-message');

        const overlayCtx = overlayCanvas.getContext('2d');
        const resultCtx = resultCanvas.getContext('2d');

        let currentStream;
        let currentLocation = null;

        // Fungsi untuk menampilkan pesan status
        function showStatus(message, type = 'info') { // type bisa 'info', 'success', 'error'
            statusMessage.textContent = message;
            statusMessage.className = `message ${type}-message`;
        }

        // Fungsi untuk menggambar overlay pada kanvas
        function drawOverlay(ctx, width, height, locationData) {
            ctx.clearRect(0, 0, width, height); // Bersihkan kanvas overlay

            if (!locationData) {
                return; // Jangan gambar jika tidak ada data sama sekali
            }

            const tanggal = new Date().toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });
            const jam = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });

            const lines = [];
            const address = locationData.address;

            // Baris 1: Lintang dan Bujur
            if (locationData.latitude && locationData.longitude) {
                lines.push(`Lat: ${locationData.latitude.toFixed(6)}, Lon: ${locationData.longitude.toFixed(6)}`);
            }

            // Baris 2: Alamat (Jalan, Nomor Rumah)
            let streetInfo = '';
            if (address && address.road) {
                streetInfo = address.road;
                if (address.house_number) {
                    streetInfo = `${address.house_number} ${streetInfo}`;
                }
                lines.push(streetInfo);
            }

            // Baris 3: RT/RW (Nominatim jarang memberikan ini, jadi ini adalah usaha terbaik)
            let rtrw = '';
            // Nominatim tidak memiliki field spesifik RT/RW. Kita harus menebak dari
            // properti yang lebih rendah atau mencari di `extratags` jika kita mengaktifkannya.
            // Contoh, 'postcode' atau 'suburb'/'village' mungkin punya informasi RT/RW di dalamnya,
            // atau properti yang lebih spesifik jika data OSM sangat detail.
            // Untuk RT/RW, ini sangat tergantung pada data OSM di area tersebut.
            // Saya akan mencoba mencari di 'postcode' atau detail 'village/suburb'.
            // Namun, sangat kecil kemungkinan Nominatim akan mengembalikan RT/RW secara langsung.
            // Anda mungkin perlu API geocoding lokal untuk ini.
            if (address) {
                if (address.postcode) {
                    rtrw += `Kodepos: ${address.postcode}`;
                }
                // Menambahkan detail yang paling spesifik yang mungkin ada di level bawah
                const smallArea = address.suburb || address.village || address.hamlet || '';
                if (smallArea && !streetInfo.includes(smallArea)) { // Hindari duplikasi jika sudah ada di jalan
                    if (rtrw) rtrw += ', ';
                    rtrw += smallArea;
                }
            }
            if (rtrw) {
                lines.push(rtrw);
            }


            // Baris 4: Kelurahan/Desa, Kecamatan
            let administrativeDetail = '';
            if (address && address.village) { administrativeDetail = address.village; }
            else if (address && address.suburb) { administrativeDetail = address.suburb; }
            else if (address && address.county) { administrativeDetail = address.county; } // County bisa jadi Kecamatan
            else if (address && address.state_district) { administrativeDetail = address.state_district; } // State_district bisa jadi Kabupaten/Kota

            if (administrativeDetail) {
                lines.push(administrativeDetail);
            }

            // Baris 5: Kota/Kabupaten, Provinsi
            let cityState = '';
            if (address && address.city) { cityState = address.city; }
            else if (address && address.town) { cityState = address.town; }
            else if (address && address.state) {
                if (cityState) cityState += ', ';
                cityState += address.state;
            }
            if (cityState) {
                lines.push(cityState);
            }

            // Baris 6: Negara
            if (address && address.country) {
                lines.push(address.country);
            }

            // Baris Terakhir: Tanggal dan Waktu
            lines.push(`${tanggal} (${jam})`);


            // Atur font untuk pengukuran teks
            const fontSize = 14; // Sedikit lebih kecil agar muat banyak baris
            const lineHeight = fontSize * 1.4;
            const padding = 10;
            ctx.font = `${fontSize}px Arial`;

            let maxTextWidth = 0;
            for (const line of lines) {
                const textWidth = ctx.measureText(line).width;
                if (textWidth > maxTextWidth) {
                    maxTextWidth = textWidth;
                }
            }

            const boxWidth = maxTextWidth + padding * 2 + 5; // Sedikit ruang ekstra
            const boxHeight = lines.length * lineHeight + padding * 2;

            // Posisi overlay (kiri bawah atau kanan bawah, pilih yang paling cocok)
            // Saya akan coba di kiri bawah agar tidak menutupi fokus utama gambar (jika orang difoto)
            const boxX = 20; // Dari kiri
            const boxY = height - boxHeight - 20; // Dari bawah

            // Gambar latar belakang semi-transparan
            ctx.fillStyle = 'rgba(0, 0, 0, 0.7)'; // Sedikit lebih gelap agar teks lebih jelas
            ctx.fillRect(boxX, boxY, boxWidth, boxHeight);

            // Gambar teks informasi lokasi
            ctx.fillStyle = 'white';
            ctx.textAlign = 'left';
            let currentY = boxY + padding + fontSize;

            for (const line of lines) {
                ctx.fillText(line, boxX + padding, currentY);
                currentY += lineHeight;
            }
        }

        // Ambil lokasi dari Geolocation API dan geocoding terbalik dengan Nominatim
        async function getGeoLocation() {
            showStatus("Mencari lokasi Anda...", 'info');
            return new Promise((resolve) => {
                navigator.geolocation.getCurrentPosition(async (position) => {
                    const lat = position.coords.latitude;
                    const lon = position.coords.longitude;

                    let locationData = { latitude: lat, longitude: lon, address: null };

                    try {
                        // Nominatim parameter 'zoom=18' atau 'zoom=17' bisa memberikan detail lebih.
                        // 'extratags=1' juga bisa memberikan info tambahan yang mungkin berguna.
                        const nominatimResponse = await fetch(`${NOMINATIM_REVERSE_GEOCODING_URL}&lat=${lat}&lon=${lon}&zoom=18`);
                        const nominatimJson = await nominatimResponse.json();

                        if (nominatimJson && nominatimJson.address) {
                            locationData.address = nominatimJson.address;
                            showStatus(`Lokasi ditemukan: ${nominatimJson.display_name.split(',')[0]}`, 'success');
                        } else {
                            console.warn("Nominatim Reverse Geocoding API Error:", nominatimJson.error || "No address found");
                            showStatus("Gagal mendapatkan nama lokasi dari Nominatim. Lokasi mentah akan digunakan.", 'error');
                        }
                    } catch (error) {
                        console.error("Error fetching Nominatim data:", error);
                        showStatus("Terjadi kesalahan jaringan saat mengambil data lokasi dari Nominatim.", 'error');
                    }

                    currentLocation = locationData;
                    resolve({ locationData });

                }, (error) => {
                    console.error("Error getting location:", error);
                    let errorMessage = "Gagal mendapatkan lokasi Anda. Pastikan Anda memberikan izin lokasi.";
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            errorMessage = "Izin lokasi ditolak oleh pengguna.";
                            break;
                        case error.POSITION_UNAVAILABLE:
                            errorMessage = "Informasi lokasi tidak tersedia.";
                            break;
                        case error.TIMEOUT:
                            errorMessage = "Permintaan lokasi habis waktu.";
                            break;
                        case error.UNKNOWN_ERROR:
                            errorMessage = "Terjadi kesalahan yang tidak diketahui saat mendapatkan lokasi.";
                            break;
                    }
                    showStatus(errorMessage, 'error');
                    currentLocation = null;
                    resolve({ locationData: null }); // Resolve even if location fails
                }, { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }); // Tingkatkan timeout
            });
        }

        // Fungsi untuk memulai kamera
        startCameraButton.addEventListener('click', async () => {
            try {
                if (currentStream) {
                    currentStream.getTracks().forEach(track => track.stop());
                }

                const stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } });
                video.srcObject = stream;
                currentStream = stream;
                captureButton.disabled = false;
                startCameraButton.textContent = 'Kamera Aktif';
                startCameraButton.disabled = true;

                video.addEventListener('loadedmetadata', () => {
                    overlayCanvas.width = video.videoWidth;
                    overlayCanvas.height = video.videoHeight;
                    resultCanvas.width = video.videoWidth;
                    resultCanvas.height = video.videoHeight;
                    requestAnimationFrame(drawLiveOverlay);
                }, { once: true });

                await getGeoLocation();

            } catch (err) {
                console.error("Error accessing camera: ", err);
                showStatus("Gagal mengakses kamera. Pastikan Anda memberikan izin dan tidak ada aplikasi lain yang menggunakan kamera.", 'error');
                captureButton.disabled = true;
                startCameraButton.disabled = false;
            }
        });

        // Fungsi untuk menggambar overlay secara live di video
        function drawLiveOverlay() {
            if (video.readyState === video.HAVE_ENOUGH_DATA) {
                drawOverlay(overlayCtx, overlayCanvas.width, overlayCanvas.height, currentLocation);
            }
            if (currentStream && currentStream.active) {
                requestAnimationFrame(drawLiveOverlay);
            }
        }

        // Fungsi untuk mengambil foto dan menambahkan overlay
        captureButton.addEventListener('click', async () => {
            if (!currentStream || !currentStream.active) {
                showStatus("Kamera belum dimulai atau sudah berhenti!", 'error');
                return;
            }

            showStatus("Mengambil foto dan data lokasi...", 'info');

            // Pastikan kita punya data lokasi terbaru sebelum capture
            await getGeoLocation();

            // 1. Gambar frame video ke resultCanvas
            resultCtx.drawImage(video, 0, 0, resultCanvas.width, resultCanvas.height);

            // 2. Gambar overlay ke resultCanvas
            drawOverlay(resultCtx, resultCanvas.width, resultCanvas.height, currentLocation);

            // Tampilkan kanvas hasil
            resultCanvas.style.display = 'block';
            finalImage.style.display = 'none';

            // Konversi kanvas ke Blob dan kirim ke server
            resultCanvas.toBlob(async (blob) => {
                const formData = new FormData();
                formData.append('image', blob, `captured_image_${Date.now()}.png`);
                formData.append('latitude', currentLocation ? currentLocation.latitude : '');
                formData.append('longitude', currentLocation ? currentLocation.longitude : '');
                formData.append('location_name', currentLocation && currentLocation.address ? currentLocation.address.display_name : 'Tidak Diketahui');
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                try {
                    const response = await fetch('/upload-image-with-location', {
                        method: 'POST',
                        body: formData
                    });
                    const data = await response.json();
                    if (response.ok) {
                        console.log('Upload Success:', data);
                        showStatus('Foto dan lokasi berhasil diunggah!', 'success');
                        finalImage.src = resultCanvas.toDataURL();
                        finalImage.style.display = 'block';
                        resultCanvas.style.display = 'none';
                    } else {
                        console.error('Upload Failed:', data);
                        showStatus(`Gagal mengunggah foto: ${data.message || 'Terjadi kesalahan.'}`, 'error');
                    }

                    // Hentikan stream kamera setelah capture
                    if (currentStream) {
                        currentStream.getTracks().forEach(track => track.stop());
                        video.srcObject = null;
                        captureButton.disabled = true;
                        startCameraButton.textContent = 'Mulai Kamera';
                        startCameraButton.disabled = false;
                        overlayCtx.clearRect(0, 0, overlayCanvas.width, overlayCanvas.height); // Bersihkan overlay live
                    }

                } catch (error) {
                    console.error('Upload Error:', error);
                    showStatus('Terjadi kesalahan jaringan saat mengunggah foto.', 'error');
                }
            }, 'image/png');
        });
    </script>
</body>
</html>
