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
                        @php
                            $months = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                            $payment_methods = ['Transfer Bank - BCA', 'QRIS (Gopay/OVO)', 'Transfer Bank - Mandiri'];
                        @endphp
                        @forelse($orders as $order)
                        <tr>
                            <td style="font-weight: 600; color: var(--dark-color);">#TRX-{{ strtoupper(substr($order->id, 0, 8)) }}</td>
                            <td>
                                {{ $order->created_at->format('d') }} {{ $months[$order->created_at->month] }} {{ $order->created_at->format('Y') }}
                            </td>
                            <td>{{ $payment_methods[$order->id % 3] }}</td>
                            <td>
                                @if($order->status === 'completed')
                                    <span class="badge badge-green">BERHASIL</span>
                                @elseif($order->status === 'cancelled')
                                    <span class="badge badge-gray">DIBATALKAN</span>
                                @else
                                    <span class="badge badge-blue">MENUNGGU VERIFIKASI</span>
                                @endif
                            </td>
                            <td class="total-col">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 3rem; color: #888;">Belum ada riwayat transaksi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

    </div>
</div>
@endsection
