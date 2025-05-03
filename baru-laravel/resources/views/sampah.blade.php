{{-- resources/views/sampah.blade.php --}}
<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>

  {{-- Push Leaflet CSS --}}
  @push('styles')
    <link
      rel="stylesheet"
      href="https://unpkg.com/leaflet/dist/leaflet.css"
    />
  @endpush

  <div
    x-data="{
      showModal: false,
      selected: {},
      map: null,
      marker: null,
      open(bin) {
        this.selected = bin;
        this.showModal = true;
        this.$nextTick(() => {
          if (!this.map) {
            this.map = L.map('modal-map').setView([bin.lat, bin.lng], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
              attribution: '&copy; OpenStreetMap contributors'
            }).addTo(this.map);
            this.marker = L.marker([bin.lat, bin.lng]).addTo(this.map);
          } else {
            this.map.setView([bin.lat, bin.lng], 15);
            this.marker.setLatLng([bin.lat, bin.lng]);
          }
          // Setelah map muncul di modal, panggil invalidateSize()
          this.map.invalidateSize();
          this.marker.bindPopup(`Bin #${bin.id}: ${bin.status}`).openPopup();
        });
      },
      close() {
        this.showModal = false;
      }
    }"
    @bin-selected.window="open($event.detail)"
    class="p-6 space-y-6"
  >

    <h3 class="text-xl mb-4">Halaman Sampah</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($bins as $bin)
        <x-card :bin="$bin" />
      @endforeach
    </div>

    {{-- Push Leaflet JS --}}
    @push('scripts')
      <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    @endpush

    {{-- Modal dengan overlay blur --}}
    <div
      x-show="showModal"
      x-transition
      class="fixed inset-0 bg-white/30 backdrop-blur-sm flex items-center justify-center z-50"
    >
      <div
        @click.away="close()"
        class="bg-white rounded-lg overflow-hidden w-11/12 md:w-2/3 lg:w-1/2 shadow-lg"
      >
        <!-- Header -->
        <div class="flex justify-between items-center p-4 border-b">
          <h4 class="font-semibold">Lokasi Bin #<span x-text="selected.id"></span></h4>
          <button @click="close()" class="text-gray-500 hover:text-gray-700 text-2xl leading-none">&times;</button>
        </div>
        <!-- Map Container -->
        <div id="modal-map" class="w-full h-64"></div>
        <!-- Detail Info -->
        <div class="p-4 text-sm text-gray-600 space-y-1">
          <p><strong>Status:</strong> <span x-text="selected.status"></span></p>
          <p><strong>Berat:</strong> <span x-text="selected.weight"></span> kg</p>
          <p><strong>Jarak:</strong> <span x-text="selected.distance"></span> m</p>
        </div>
      </div>
    </div>

  </div>
</x-layout>
