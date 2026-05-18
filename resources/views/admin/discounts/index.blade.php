@extends('layouts.admin')

@section('title', 'Manage Discounts - Nami Lontar')

@section('content')
<header class="page-header">
    <h1>Discounts & Offers</h1>
    <div class="header-actions">
        <div class="admin-profile">
            <img src="{{ asset('assets/profile.png') }}" alt="Admin">
            <span>Julian Rossi</span>
        </div>
    </div>
</header>

@if(session('success'))
<div style="background: var(--status-green-bg); border: 1px solid var(--status-green-border); color: var(--status-green-text); padding: 1rem 1.5rem; border-radius: 12px; margin-bottom: 2rem; display: flex; align-items: center; gap: 10px; font-weight: 500; backdrop-filter: blur(10px); box-shadow: var(--shadow-subtle);">
    <i class="fa-solid fa-circle-check" style="font-size: 1.2rem;"></i>
    <span>{{ session('success') }}</span>
</div>
@endif

<div class="table-container">
    <div class="table-header-actions">
        <form action="{{ route('admin.discounts.index') }}" method="GET" style="display: flex; gap: 10px; align-items: center;">
            <input type="text" name="search" class="search-bar" placeholder="Search discount code..." value="{{ $search }}">
            <button type="submit" class="btn btn-secondary" style="padding: 0.75rem 1.25rem;"><i class="fa-solid fa-magnifying-glass"></i></button>
            @if($search)
                <a href="{{ route('admin.discounts.index') }}" class="btn btn-secondary" style="padding: 0.75rem 1.25rem; opacity: 0.7;"><i class="fa-solid fa-xmark"></i></a>
            @endif
        </form>
        <a href="{{ route('admin.discounts.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Create Discount
        </a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Validity Dates</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($discounts as $discount)
            <tr>
                <td style="font-family: var(--font-mono); font-weight: bold; color: var(--accent-color); font-size: 1.1rem; letter-spacing: 0.5px;">
                    {{ $discount->code }}
                </td>
                <td style="font-weight: 600; color: var(--text-primary);">
                    {{ $discount->type }}
                </td>
                <td style="font-family: var(--font-sans); font-weight: bold; color: var(--text-primary);">
                    @if($discount->type === 'Percentage')
                        {{ number_format($discount->amount, 0) }}% OFF
                    @elseif($discount->type === 'Fixed')
                        ${{ number_format($discount->amount, 2) }} OFF
                    @else
                        Free Shipping
                    @endif
                </td>
                <td>
                    @if($discount->status === 'Active')
                        <span class="badge active" style="background: rgba(46, 125, 50, 0.08); border-color: rgba(46, 125, 50, 0.3); color: var(--status-green-text); font-weight: bold;">
                            Active
                        </span>
                    @else
                        <span class="badge expired" style="background: rgba(198, 40, 40, 0.08); border-color: rgba(198, 40, 40, 0.3); color: var(--status-red-text); font-weight: bold;">
                            Expired
                        </span>
                    @endif
                </td>
                <td style="color: var(--text-secondary); font-size: 0.9rem;">
                    @if($discount->start_date && $discount->end_date)
                        {{ date('M d, Y', strtotime($discount->start_date)) }} - {{ date('M d, Y', strtotime($discount->end_date)) }}
                    @elseif($discount->start_date)
                        Starts: {{ date('M d, Y', strtotime($discount->start_date)) }}
                    @elseif($discount->end_date)
                        Expires: {{ date('M d, Y', strtotime($discount->end_date)) }}
                    @else
                        <span style="font-style: italic; opacity: 0.6;">Always Valid</span>
                    @endif
                </td>
                <td>
                    <div style="display: flex; gap: 8px;">
                        <a href="{{ route('admin.discounts.edit', $discount->id) }}" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.8rem; border-radius: 8px;">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>
                        <form action="{{ route('admin.discounts.destroy', $discount->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this discount code?');" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.8rem; border-radius: 8px; color: var(--status-red-text); border-color: rgba(198, 40, 40, 0.2); background: rgba(198, 40, 40, 0.03);">
                                <i class="fa-solid fa-trash-can"></i> Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; color: var(--text-secondary); padding: 4rem 2rem;">
                    <i class="fa-solid fa-tags" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3; display: block;"></i>
                    No discount codes found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
