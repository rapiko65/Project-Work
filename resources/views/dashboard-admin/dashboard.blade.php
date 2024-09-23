<!-- resources/views/admin/dashboard.blade.php -->

@extends('dashboard-admin.index')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-4 shadow rounded-lg">
            <h3 class="text-xl font-semibold mb-2">Total Users</h3>
            <p class="text-gray-700">150</p>
        </div>

        <div class="bg-white p-4 shadow rounded-lg">
            <h3 class="text-xl font-semibold mb-2">New Orders</h3>
            <p class="text-gray-700">32</p>
        </div>

        <div class="bg-white p-4 shadow rounded-lg">
            <h3 class="text-xl font-semibold mb-2">Revenue</h3>
            <p class="text-gray-700">$1,230</p>
        </div>
    </div>
@endsection
