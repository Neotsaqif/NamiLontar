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
            <tr>
                <td>1</td>
                <td>Alice Johnson</td>
                <td>alice@example.com</td>
                <td>5</td>
                <td><button class="btn btn-secondary"><i class="fa-solid fa-eye"></i> View Profile</button></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Bob Smith</td>
                <td>bob@example.com</td>
                <td>2</td>
                <td><button class="btn btn-secondary"><i class="fa-solid fa-eye"></i> View Profile</button></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
