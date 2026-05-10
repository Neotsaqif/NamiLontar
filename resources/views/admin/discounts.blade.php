@extends('layouts.admin')

@section('title', 'Discounts - Nami Lontar')

@section('content')
<header class="page-header">
    <h1>Discounts</h1>
    <div class="header-actions">
        <div class="admin-profile">
            <img src="{{ asset('assets/profile.png') }}" alt="Admin">
            <span>Julian Rossi</span>
        </div>
    </div>
</header>
<div class="table-container">
    <div class="table-header-actions">
        <button class="btn btn-primary"><i class="fa-solid fa-plus"></i> Create Discount</button>
    </div>
    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>WELCOME20</td>
                <td>Percentage</td>
                <td>20%</td>
                <td><span class="badge active">Active</span></td>
                <td><button class="btn btn-secondary"><i class="fa-solid fa-pen-to-square"></i> Edit</button></td>
            </tr>
            <tr>
                <td>FREESHIP</td>
                <td>Shipping</td>
                <td>Free</td>
                <td><span class="badge expired">Expired</span></td>
                <td><button class="btn btn-secondary"><i class="fa-solid fa-pen-to-square"></i> Edit</button></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
