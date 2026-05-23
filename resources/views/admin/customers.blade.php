@extends('layouts.admin')

@section('title', 'Customers - Nami Lontar')

@section('content')
<header class="page-header">
    <h1>Customers</h1>
    <div class="header-actions">
        <div class="admin-profile">
            <img src="{{ asset('assets/profile.png') }}" alt="Admin">
            <span>Admin</span>
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
                <th>Role</th>
                <th>Total Orders</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><span class="badge {{ $user->role }}">{{ strtoupper($user->role) }}</span></td>
                <td>{{ $user->orders_count }}</td>
                <td>
                    <a href="{{ route('admin.customers.show', $user->id) }}" class="btn btn-secondary btn-sm">
                        <i class="fa-solid fa-eye"></i> View Profile
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
