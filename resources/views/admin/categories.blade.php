@extends('layouts.admin')

@section('title', 'Categories - Nami Lontar')

@section('content')
<header class="page-header">
    <h1>Categories</h1>
    <div class="header-actions">
        <div class="admin-profile">
            <img src="{{ asset('assets/profile.png') }}" alt="Admin">
            <span>Admin</span>
        </div>
    </div>
</header>
<div class="table-container">
    <div class="table-header-actions">
        <button class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add Category</button>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Product Count</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Signature Pastries</td>
                <td>12</td>
                <td><button class="btn btn-secondary"><i class="fa-solid fa-pen-to-square"></i> Edit</button></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Daily Fresh</td>
                <td>8</td>
                <td><button class="btn btn-secondary"><i class="fa-solid fa-pen-to-square"></i> Edit</button></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
