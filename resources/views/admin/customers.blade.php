@extends('layouts.admin')

@section('title', 'Customers - Nami Lontar')

@section('content')
<header class="page-header">
    <h1>Customers</h1>
    <div class="header-actions">
        <div class="admin-profile">
            <img src="{{ asset('assets/profile.png') }}" alt="Admin">
            <span>Julian Rossi</span>
        </div>
    </div>
</header>
<div class="table-container">
    <div class="table-header-actions">
        <input type="text" class="search-bar" placeholder="Search customers...">
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Total Orders</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>{{ $customer['id'] }}</td>
                <td>{{ $customer['name'] }}</td>
                <td>{{ $customer['email'] }}</td>
                <td>{{ count($customer['orders']) }}</td>
                <td>
                    <a href="{{ url('/admin/customers/' . $customer['id']) }}" class="btn btn-secondary btn-sm">
                        <i class="fa-solid fa-eye"></i> View Profile
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
