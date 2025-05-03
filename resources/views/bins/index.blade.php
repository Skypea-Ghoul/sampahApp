<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Daftar Tempat Sampah</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>
<body class="bg-gray-100 p-6" x-data="binApp()">

  <h1 class="text-2xl font-bold mb-4">Daftar Tempat Sampah</h1>

  <!-- Filter Dropdown -->
  <div class="mb-4">
    <label class="font-medium mr-2">Filter Status:</label>
    <select x-model="selectedStatus" class="border rounded p-1">
      <option value="Semua">Semua</option>
      <option value="Kosong">Kosong</option>
      <option value="Setengah penuh">Setengah penuh</option>
      <option value="Penuh">Penuh</option>
    </select>
  </div>

  <!-- Bin Cards -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <template x-for="bin in filteredBins" :key="bin.id">
      <div class="bg-white rounded-lg shadow p-4" x-init="renderMap(bin)">
        <h2 class="text-lg font-semibold mb-2" x-text="'Bin #' + bin.id"></h2>
        <div class="flex items-center mb-2 space-x-2">
          <span class="font-medium">Berat:</span>
          <span x-text="bin.weight.toFixed(1) + ' kg'"></span>
        </div>
        <div class="flex items-center mb-2 space-x-2">
          <span class="font-medium">Jarak:</span>
          <span x-text="bin.distance + ' m'"></span>
        </div>
        <template x-if="bin.status === 'Kosong'">
          <span class="inline-block px-2 py-0.5 rounded-full font-semibold bg-green-100 text-green-700" x-text="bin.status"></span>
        </template>
        <template x-if="bin.status === 'Setengah penuh'">
          <span class="inline-block px-2 py-0.5 rounded-full font-semibold bg-yellow-100 text-yellow-700" x-text="bin.status"></span>
        </template>
        <template x-if="bin.status === 'Penuh'">
          <span class="inline-block px-2 py-0.5 rounded-full font-semibold bg-red-100 text-red-700" x-text="bin.status"></span>
        </template>
        <div :id="'map-' + bin.id" class="mt-4 w-full h-40 rounded-lg overflow-hidden"></div>
      </div>
    </template>
  </div>

  <!-- Alpine Component -->
  <script>
    function binApp() {
      return {
        selectedStatus: 'Semua',
        bins: @json($bins->sortBy('id')->values()->map(function($bin) {
          if ($bin->weight >= 15) return ['id' => $bin->id, 'weight' => $bin->weight, 'distance' => $bin->distance, 'latitude' => $bin->latitude, 'longitude' => $bin->longitude, 'status' => 'Penuh'];
          else if ($bin->weight >= 5) return ['id' => $bin->id, 'weight' => $bin->weight, 'distance' => $bin->distance, 'latitude' => $bin->latitude, 'longitude' => $bin->longitude, 'status' => 'Setengah penuh'];
          else return ['id' => $bin->id, 'weight' => $bin->weight, 'distance' => $bin->distance, 'latitude' => $bin->latitude, 'longitude' => $bin->longitude, 'status' => 'Kosong'];
        })),
        get filteredBins() {
          if (this.selectedStatus === 'Semua') return this.bins;
          return this.bins.filter(b => b.status === this.selectedStatus);
        },
        renderedMaps: new Set(),
        renderMap(bin) {
          this.$nextTick(() => {
            const mapId = 'map-' + bin.id;
            if (this.renderedMaps.has(mapId)) return;
            const el = document.getElementById(mapId);
            if (!el) return;

            const map = L.map(mapId, {
              center: [bin.latitude, bin.longitude],
              zoom: 15,
              scrollWheelZoom: false
            });
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
              attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);
            L.marker([bin.latitude, bin.longitude])
              .addTo(map)
              .bindPopup(`Bin #${bin.id}: ${bin.status}`)
              .openPopup();
            this.renderedMaps.add(mapId);
          });
        }
      };
    }
  </script>

</body>
</html>
