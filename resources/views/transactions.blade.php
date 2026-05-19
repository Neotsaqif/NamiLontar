@extends('layouts.app')

@section('title', 'Transactions | Nami Lontar')

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
            <a href="{{ url('/transactions') }}" class="sidebar-item active">
                <i class="fa-solid fa-receipt"></i>
                Transactions
            </a>
            <a href="{{ url('/orders') }}" class="sidebar-item">
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
            <h1 class="card-title" style="font-size: 28px; margin-bottom: 8px;">Riwayat Transaksi</h1>
            <p style="color: #666; font-size: 15px;">Pantau status pembayaran dan unduh bukti transaksi untuk pesanan Anda.</p>
        </div>

        <!-- Transactions Table Section -->
        <section class="transactions-section">
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID TRANSAKSI</th>
                            <th>TANGGAL</th>
                            <th>METODE PEMBAYARAN</th>
                            <th>STATUS</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-weight: 600; color: var(--dark-color);">#TRX-92842</td>
                            <td>24 Mei 2026</td>
                            <td>Transfer Bank - BCA</td>
                            <td><span class="badge badge-green">BERHASIL</span></td>
                            <td class="total-col">Rp 425.000</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; color: var(--dark-color);">#TRX-92711</td>
                            <td>18 Mei 2026</td>
                            <td>QRIS (Gopay/OVO)</td>
                            <td><span class="badge badge-green">BERHASIL</span></td>
                            <td class="total-col">Rp 285.000</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; color: var(--dark-color);">#TRX-92605</td>
                            <td>12 Mei 2026</td>
                            <td>Transfer Bank - Mandiri</td>
                            <td><span class="badge badge-blue">MENUNGGU VERIFIKASI</span></td>
                            <td class="total-col">Rp 1.200.000</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; color: var(--dark-color);">#TRX-92589</td>
                            <td>05 Mei 2026</td>
                            <td>Virtual Account - BRI</td>
                            <td><span class="badge badge-gray">DIBATALKAN</span></td>
                            <td class="total-col">Rp 349.000</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600; color: var(--dark-color);">#TRX-92102</td>
                            <td>20 Apr 2026</td>
                            <td>QRIS (Dana/LinkAja)</td>
                            <td><span class="badge badge-green">BERHASIL</span></td>
                            <td class="total-col">Rp 550.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

    </div>
</div>
@endsection
