@extends('layouts.app')

@section('title', 'Orders | Nami Lontar')

@section('content')
<!-- Main Content Layout -->
<div class="dashboard-container">
    <!-- Left Sidebar -->
    <aside class="sidebar smooth-reveal smooth-reveal-left">
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
    <div class="content-pane smooth-reveal smooth-reveal-right">

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
                        @php
                            $months = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                        @endphp
                        @forelse($orders as $order)
                        <tr>
                            <td style="font-weight: 600; color: var(--dark-color);">#ORD-{{ strtoupper(substr($order->id, 0, 8)) }}</td>
                            <td>
                                {{ $order->created_at->format('d') }} {{ $months[$order->created_at->month] }} {{ $order->created_at->format('Y') }}
                            </td>
                            <td>
                                @foreach($order->items as $item)
                                    {{ $item->product ? $item->product->name : 'Unknown Product' }} ({{ $item->quantity }} pcs)@if(!$loop->last), @endif
                                @endforeach
                            </td>
                            <td>
                                @if($order->status === 'completed')
                                    <span class="badge badge-green">TERKIRIM</span>
                                @elseif($order->status === 'cancelled')
                                    <span class="badge badge-gray">DIBATALKAN</span>
                                @else
                                    <span class="badge badge-blue">DIPROSES</span>
                                @endif
                            </td>
                            <td class="total-col">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td><a href="{{ url('/orders/' . $order->id . '/tracking') }}" class="btn-view-detail">View Detail</a></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 3rem; color: #888;">Belum ada pesanan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

    </div>
</div>
@endsection
