@extends('layouts.admin')

@section('title', 'Customers - Toko Serba Ada')

@section('content')
<header class="page-header">
    <h1>Customers</h1>
</header>
<div class="table-container">
    <div class="table-header-actions">
        <button class="btn btn-primary">Add Category</button>
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
                <td><button class="btn btn-secondary">Edit</button></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Daily Fresh</td>
                <td>8</td>
                <td><button class="btn btn-secondary">Edit</button></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
