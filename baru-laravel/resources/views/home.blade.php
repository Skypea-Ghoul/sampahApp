<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <h3 class="text-xl font-semibold mb-4">Statistik Sampah</h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-4 rounded-lg shadow">
            <h4 class="font-semibold text-lg">Sampah Penuh</h4>
            <p class="text-2xl text-red-600">{{ $fullCount }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <h4 class="font-semibold text-lg">Sampah Setengah</h4>
            <p class="text-2xl text-yellow-500">{{ $halfCount }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <h4 class="font-semibold text-lg">Sampah Kosong</h4>
            <p class="text-2xl text-green-600">{{ $emptyCount }}</p>
        </div>
    </div>

    <div class="bg-white p-4 rounded-lg shadow w-64 h-64">
        <canvas id="binChart" class="w-full h-full"></canvas>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('binChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Jumlah',
                    data: @json($data),
                    backgroundColor: ['#f87171', '#facc15', '#4ade80'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
    @endpush
</x-layout>
