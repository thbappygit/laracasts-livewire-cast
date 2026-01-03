<div class="p-6 bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Analytics Dashboard</h1>
        <p class="text-gray-600">Real-time insights and performance metrics</p>
    </div>

    <!-- Real-time Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Live Visitors</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $realTimeData['visitors'] ?? 0 }}</p>
                </div>
                <div class="p-3 bg-blue-100 rounded-full">
                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-2">
                <span class="text-sm text-gray-500">Updated: {{ $realTimeData['timestamp'] ?? 'N/A' }}</span>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Sales Today</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $realTimeData['sales'] ?? 0 }}</p>
                </div>
                <div class="p-3 bg-green-100 rounded-full">
                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Revenue</p>
                    <p class="text-2xl font-bold text-gray-900">${{ number_format($realTimeData['revenue'] ?? 0) }}</p>
                </div>
                <div class="p-3 bg-yellow-100 rounded-full">
                    <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582z"></path>
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Conversions</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $realTimeData['conversions'] ?? 0 }}%</p>
                </div>
                <div class="p-3 bg-purple-100 rounded-full">
                    <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Sales Trend Chart -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Sales Trend (Last 12 Months)</h3>
            <div class="h-64">
                <canvas id="salesChart" width="400" height="200"></canvas>
            </div>
        </div>

        <!-- Posts by User Chart -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Posts by User (API Data)</h3>
            <div class="h-64">
                <canvas id="postsChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>



    <!-- Articles Chart Row -->
    <div class="grid grid-cols-1 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Articles Published (Last 6 Months)</h3>
            <div class="h-64">
                <canvas id="articlesChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        (function(){
             window.dashboardCharts = window.dashboardCharts || {};

            function getCtx(id) {
                const el = document.getElementById(id);
                return el ? el.getContext('2d') : null;
            }

            function destroyChart(id) {
                if (window.dashboardCharts[id]) {
                    try { window.dashboardCharts[id].destroy(); } catch (e) {}
                    delete window.dashboardCharts[id];
                }
            }

            function initAllCharts() {
                if (typeof Chart === 'undefined') {
                    console.error('Chart.js is not loaded');
                    return;
                }

                const salesData = @json($salesData);
                const postsData = @json($posts);
                const articlesData = @json($articlesData);
                const initialReal = @json($realTimeData);

                // Sales Chart
                const salesCtx = getCtx('salesChart');
                if (salesCtx) {
                    destroyChart('salesChart');
                    window.dashboardCharts['salesChart'] = new Chart(salesCtx, {
                        type: 'line',
                        data: {
                            labels: salesData.map(item => item.month),
                            datasets: [{
                                label: 'Sales',
                                data: salesData.map(item => item.sales),
                                borderColor: 'rgb(59, 130, 246)',
                                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                tension: 0.4,
                                fill: true
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { legend: { display: false } },
                            scales: { y: { beginAtZero: true } }
                        }
                    });
                }

                // Posts Chart
                const postsCtx = getCtx('postsChart');
                if (postsCtx && postsData.length > 0) {
                    destroyChart('postsChart');
                    window.dashboardCharts['postsChart'] = new Chart(postsCtx, {
                        type: 'bar',
                        data: {
                            labels: postsData.map(item => item.user),
                            datasets: [{
                                label: 'Posts',
                                data: postsData.map(item => item.count),
                                backgroundColor: [
                                    'rgba(34, 197, 94, 0.8)',
                                    'rgba(59, 130, 246, 0.8)',
                                    'rgba(239, 68, 68, 0.8)',
                                    'rgba(245, 158, 11, 0.8)',
                                    'rgba(168, 85, 247, 0.8)',
                                    'rgba(236, 72, 153, 0.8)',
                                    'rgba(6, 182, 212, 0.8)',
                                    'rgba(132, 204, 22, 0.8)'
                                ],
                                borderRadius: 4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { legend: { display: false } },
                            scales: { y: { beginAtZero: true } }
                        }
                    });
                }

                // Articles Chart
                const articlesCtx = getCtx('articlesChart');
                if (articlesCtx && articlesData.length > 0) {
                    destroyChart('articlesChart');
                    window.dashboardCharts['articlesChart'] = new Chart(articlesCtx, {
                        type: 'bar',
                        data: {
                            labels: articlesData.map(i => i.month),
                            datasets: [{
                                label: 'Articles',
                                data: articlesData.map(i => i.count),
                                backgroundColor: 'rgba(99, 102, 241, 0.8)',
                                borderRadius: 4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { legend: { display: false } },
                            scales: { y: { beginAtZero: true, precision: 0 } }
                        }
                    });
                }


                console.log('Charts initialized/re-initialized');
            }

            // Initialize on first load
            document.addEventListener('DOMContentLoaded', initAllCharts);

            // Reinitialize on Livewire navigate updates (SPA)
            window.addEventListener('livewire:navigated', initAllCharts);
            window.addEventListener('livewire:load', initAllCharts);

        })();
    </script>
@endpush
