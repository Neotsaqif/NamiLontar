@extends('layouts.app')

@section('title', 'Orders | Nami Lontar')

@section('content')
<!-- Main Content Layout -->
<div class="dashboard-container">
    <!-- Left Sidebar -->
    <aside class="sidebar">
        <h2 class="sidebar-title">Settings</h2>
        <nav class="sidebar-nav">
            <a href="{{ url('/profile') }}" class="sidebar-item">
                <i class="fa-solid fa-circle-user"></i>
                Profile
            </a>
            <a href="{{ url('/transactions') }}" class="sidebar-item">
                <i class="fa-solid fa-receipt"></i>
                Transactions
            </a>
            <a href="{{ url('/orders') }}" class="sidebar-item active">
                <i class="fa-solid fa-box"></i>
                Orders
            </a>
            <a href="{{ url('/login') }}" class="sidebar-item">
                <i class="fa-solid fa-right-from-bracket"></i>
                Sign Out
            </a>
        </nav>
    </aside>

    <!-- Right Content Pane -->
    <div class="content-pane">

        <div style="margin-bottom: 36px;">
            <h1 class="card-title" style="font-size: 28px; margin-bottom: 8px;">Daftar Pesanan</h1>
            <p style="color: #666; font-size: 15px;">Lacak status produksi pre-order dan pengiriman camilan Nami Lontar Anda.</p>
        </div>

        <!-- Orders Table Section -->
        <section class="transactions-section">
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID PESANAN</th>
                            <th>TANGGAL ACARA</th>
                            <th>DETAIL ITEM</th>
                            <th>STATUS PENGIRIMAN</th>
                            <th>TOTAL</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-weight: 600; color: var(--dark-color);">#ORD-92842</td>
                            <td>25 Mei 2026</td>
                            <td>Pastel Renyah (50 pcs), Kue Lontar (2 box)</td>
                            <td><span class="badge badge-green">TERKIRIM</span></td>
                            <td class="total-col">Rp 425.000</td>
                            <td><a href="{{ url('/orders/92842/tracking') }}" class="btn-view-detail">View Detail</a></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; color: var(--dark-color);">#ORD-92711</td>
                            <td>19 Mei 2026</td>
                            <td>Keripik Singkong Balado (100 pcs)</td>
                            <td><span class="badge badge-green">TERKIRIM</span></td>
                            <td class="total-col">Rp 285.000</td>
                            <td><a href="{{ url('/orders/92711/tracking') }}" class="btn-view-detail">View Detail</a></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; color: var(--dark-color);">#ORD-92605</td>
                            <td>15 Mei 2026</td>
                            <td>Paket Pre-order Arisan (300 pcs)</td>
                            <td><span class="badge badge-blue">DIPROSES (H-2)</span></td>
                            <td class="total-col">Rp 1.200.000</td>
                            <td><a href="{{ url('/orders/92605/tracking') }}" class="btn-view-detail">View Detail</a></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; color: var(--dark-color);">#ORD-92589</td>
                            <td>08 Mei 2026</td>
                            <td>Lumpia Goreng Spesial (150 pcs)</td>
                            <td><span class="badge badge-gray">DIBATALKAN</span></td>
                            <td class="total-col">Rp 349.000</td>
                            <td><a href="{{ url('/orders/92589/tracking') }}" class="btn-view-detail">View Detail</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

    </div>
</div>
@endsection
