@extends('layouts.admin')

@section('title', 'Dashboard - Nami Lontar')

@section('content')
<header class="page-header">
    <h1>Dashboard Overview</h1>
    <div class="header-actions">
        <div class="admin-profile">
            <img src="{{ asset('assets/profile.png') }}" alt="Admin">
            <span>Admin</span>
        </div>
    </div>
</header>

{{-- ═══════════════════════════════════════════
     LAYER 1 — KPI OVERVIEW CARDS
══════════════════════════════════════════════ --}}
<div class="kpi-header">
    <h2><i class="fa-solid fa-gauge-high" style="color:var(--accent-color);margin-right:.5rem;"></i>Key Metrics</h2>
    <!-- <select class="view-dropdown" id="kpiViewDropdown">
        <option>View: Month</option>
        <option>View: Week</option>
        <option>View: Year</option>
    </select> -->
</div>

<div class="kpi-grid">

    {{-- Card 1: Total Sales --}}
    <div class="kpi-card">
        <div class="kpi-card-top">
            <div class="kpi-icon-wrap kpi-icon-gold">
                <i class="fa-solid fa-chart-line"></i>
            </div>
            <span class="kpi-badge kpi-badge-green"><i class="fa-solid fa-arrow-trend-up"></i> +12.4%</span>
        </div>
        <div class="kpi-label">Total Sales</div>
        <div class="kpi-value">Rp{{ number_format($weeklySales * 4, 0, ',', '.') }}</div>
        <div class="kpi-sub">
            <span class="up"><i class="fa-solid fa-arrow-up"></i> {{ $salesTrend }}</span>
            &nbsp;vs last month
        </div>
    </div>

    {{-- Card 2: Today's Revenue --}}
    <div class="kpi-card">
        <div class="kpi-card-top">
            <div class="kpi-icon-wrap kpi-icon-blue">
                <i class="fa-solid fa-rocket"></i>
            </div>
            <span class="kpi-badge kpi-badge-blue"><i class="fa-solid fa-bolt"></i> Today</span>
        </div>
        <div class="kpi-label">Today's Revenue</div>
        <div class="kpi-value" style="color:#64b5f6; text-shadow:0 0 18px rgba(100,181,246,.25);">
            Rp{{ number_format($weeklySales / 7, 0, ',', '.') }}
        </div>
        <div class="kpi-sub">
            <span style="color:var(--text-secondary);"><i class="fa-regular fa-clock"></i></span>
            Updated just now
        </div>
    </div>

    {{-- Card 3: Pending Orders Cash --}}
    <div class="kpi-card">
        <div class="kpi-card-top">
            <div class="kpi-icon-wrap kpi-icon-amber">
                <i class="fa-solid fa-clock"></i>
            </div>
            <span class="kpi-badge kpi-badge-yellow"><i class="fa-solid fa-hourglass-half"></i> Booked</span>
        </div>
        <div class="kpi-label">Pending Orders</div>
        <div class="kpi-value" style="color:#ffb74d; text-shadow:0 0 18px rgba(255,183,77,.2);">
            Rp{{ number_format($weeklySales * 0.3, 0, ',', '.') }}
        </div>
        <div class="kpi-sub">
            <span class="down"><i class="fa-solid fa-bread-slice"></i></span>
            Awaiting production
        </div>
    </div>

</div>

{{-- ═══════════════════════════════════════════
     LAYER 2 — ANALYTICS CHARTS
══════════════════════════════════════════════ --}}
<!-- <div class="charts-row">

    {{-- Left: Donut / Sales Analysis --}}
    <div class="chart-card">
        <div class="chart-card-header">
            <h3><i class="fa-solid fa-circle-half-stroke" style="color:var(--accent-color);margin-right:.4rem;"></i>Sales Analysis</h3>
            <span>This Month</span>
        </div>
        <div class="donut-wrap">
            <canvas id="donutChart"></canvas>
            <div class="donut-center-label">
                <span class="big">84%</span>
                <span class="small">Fulfilled</span>
            </div>
        </div>
        <div class="donut-legend">
            <div class="legend-item"><span class="legend-dot" style="background:#d4af37;"></span><div><div>Active Sales</div><strong>42%</strong></div></div>
            <div class="legend-item"><span class="legend-dot" style="background:#81c784;"></span><div><div>Delivered</div><strong>28%</strong></div></div>
            <div class="legend-item"><span class="legend-dot" style="background:#e57373;"></span><div><div>Cancelled</div><strong>14%</strong></div></div>
            <div class="legend-item"><span class="legend-dot" style="background:#ffd54f;"></span><div><div>Pending</div><strong>16%</strong></div></div>
        </div>
    </div>

    {{-- Right: Bar — Sales Activity --}}
    <div class="chart-card">
        <div class="chart-card-header">
            <h3><i class="fa-solid fa-chart-bar" style="color:var(--accent-color);margin-right:.4rem;"></i>Sales Activity</h3>
            <select class="view-dropdown" id="barViewDropdown">
                <option>View: Week</option>
                <option>View: Month</option>
            </select>
        </div>
        <div class="bar-chart-wrap">
            <canvas id="barChart"></canvas>
        </div>
    </div>

</div> -->

{{-- ═══════════════════════════════════════════
     LAYER 3 — RECENT ORDERS TABLE
══════════════════════════════════════════════ --}}
<div class="orders-card">
    <div class="orders-card-header">
        <h3><i class="fa-solid fa-list-check" style="color:var(--accent-color);margin-right:.5rem;"></i>Recent Orders</h3>
        <!-- <div class="filter-tabs" id="orderFilterTabs">
            <button class="filter-tab active" data-filter="all">All</button>
            <button class="filter-tab" data-filter="new">New</button>
            <button class="filter-tab" data-filter="pending">Pending</button>
            <button class="filter-tab" data-filter="delivered">Delivered</button>
            <button class="filter-tab" data-filter="cancelled">Cancelled</button>
        </div> -->
    </div>

    <table id="ordersTable">
        <thead>
            <tr>
                <th>User Name</th>
                <th>Product ID</th>
                <th>Unit (Qty)</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentOrders as $order)
            <tr data-status="{{ $order->status }}">
                <td>{{ $order->user->name }}</td>
                <td class="product-id">#PRD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                <td class="qty-cell">{{ optional($order->orderItems)->sum('quantity') ?? 1 }} pcs</td>
                <td class="amount-cell">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                <td class="date-cell">{{ $order->created_at->format('M d, Y') }}</td>
                <td><span class="badge {{ $order->status }}">{{ strtoupper($order->status) }}</span></td>
            </tr>
            @empty
            <!-- <tr data-status="new">
                <td>Siti Rahayu</td>
                <td class="product-id">#PRD-0011</td>
                <td class="qty-cell">3 pcs</td>
                <td class="amount-cell">Rp185.000</td>
                <td class="date-cell">May 23, 2026</td>
                <td><span class="badge processing">NEW</span></td>
            </tr>
            <tr data-status="pending">
                <td>Budi Santoso</td>
                <td class="product-id">#PRD-0008</td>
                <td class="qty-cell">6 pcs</td>
                <td class="amount-cell">Rp342.000</td>
                <td class="date-cell">May 22, 2026</td>
                <td><span class="badge pending">PENDING</span></td>
            </tr>
            <tr data-status="delivered">
                <td>Anisa Putri</td>
                <td class="product-id">#PRD-0005</td>
                <td class="qty-cell">2 pcs</td>
                <td class="amount-cell">Rp128.000</td>
                <td class="date-cell">May 21, 2026</td>
                <td><span class="badge delivered">DELIVERED</span></td>
            </tr>
            <tr data-status="cancelled">
                <td>Dian Permata</td>
                <td class="product-id">#PRD-0003</td>
                <td class="qty-cell">1 pcs</td>
                <td class="amount-cell">Rp75.000</td>
                <td class="date-cell">May 20, 2026</td>
                <td><span class="badge inactive">CANCELLED</span></td>
            </tr> -->
            @endforelse
        </tbody>
    </table>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    Chart.defaults.color = '#a097ad';
    Chart.defaults.font.family = "'Outfit', system-ui, sans-serif";

    /* 1 — Donut */
    const donutCtx = document.getElementById('donutChart').getContext('2d');
    new Chart(donutCtx, {
        type: 'doughnut',
        data: {
            labels: ['Active Sales', 'Delivered', 'Cancelled', 'Pending'],
            datasets: [{
                data: [42, 28, 14, 16],
                backgroundColor: ['#d4af37', '#81c784', '#e57373', '#ffd54f'],
                borderColor: 'rgba(0,0,0,0)',
                borderWidth: 0,
                hoverOffset: 8,
                spacing: 3,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            cutout: '72%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(18,14,25,.9)',
                    titleColor: '#fdfbf7',
                    bodyColor: '#a097ad',
                    borderColor: 'rgba(212,175,55,.2)',
                    borderWidth: 1,
                    padding: 12,
                    callbacks: { label: ctx => ` ${ctx.label}: ${ctx.raw}%` }
                }
            }
        }
    });

    /* 2 — Bar */
    const barCtx = document.getElementById('barChart').getContext('2d');
    const goldGrad = barCtx.createLinearGradient(0, 0, 0, 240);
    goldGrad.addColorStop(0, 'rgba(212,175,55,.85)');
    goldGrad.addColorStop(1, 'rgba(212,175,55,.08)');
    const blueGrad = barCtx.createLinearGradient(0, 0, 0, 240);
    blueGrad.addColorStop(0, 'rgba(100,181,246,.7)');
    blueGrad.addColorStop(1, 'rgba(100,181,246,.05)');

    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            datasets: [
                { label: 'Revenue', data: [3200, 5800, 4700, 7100, 6400, 8900, 5300], backgroundColor: goldGrad, borderRadius: 6, borderSkipped: false, barPercentage: 0.6 },
                { label: 'Orders',  data: [1800, 3200, 2500, 4100, 3600, 5200, 2900], backgroundColor: blueGrad, borderRadius: 6, borderSkipped: false, barPercentage: 0.6 }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: { grid: { color: 'rgba(255,255,255,.04)' }, ticks: { color: '#a097ad', font: { size: 12 } } },
                y: {
                    min: 0, max: 9000,
                    grid: { color: 'rgba(255,255,255,.06)' },
                    ticks: { color: '#a097ad', stepSize: 3000, callback: v => v === 0 ? '$0' : '$' + (v/1000).toFixed(0) + 'k' }
                }
            },
            plugins: {
                legend: { display: true, position: 'top', align: 'end', labels: { boxWidth: 10, boxHeight: 10, borderRadius: 3, usePointStyle: true, color: '#a097ad', font: { size: 11 } } },
                tooltip: { backgroundColor: 'rgba(18,14,25,.9)', titleColor: '#fdfbf7', bodyColor: '#a097ad', borderColor: 'rgba(212,175,55,.2)', borderWidth: 1, padding: 12 }
            }
        }
    });

    /* 3 — Filter tabs */
    const tabs = document.querySelectorAll('#orderFilterTabs .filter-tab');
    const rows = document.querySelectorAll('#ordersTable tbody tr');
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            const filter = tab.dataset.filter;
            rows.forEach(row => {
                row.style.display = (filter === 'all' || (row.dataset.status ?? '') === filter) ? '' : 'none';
            });
        });
    });
});
</script>
@endpush
