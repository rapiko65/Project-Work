<!-- resources/views/layouts/admin.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
    @stack('css')
</head>
<body class="bg-gray-100">

    <!-- Sidebar -->
    <div class="flex">
        <div class="w-64  bg-gray-800 h-fit p-5">
            <div class="text-white text-2xl font-semibold mb-8">Admin Panel</div>
            <ul>
                <li class="mb-6">
                    <a href="#" class="text-gray-300 hover:text-white">Dashboard</a>
                </li>
                <li class="mb-6">
                    <a href="#" class="text-gray-300 hover:text-white">Users</a>
                </li>
                <li class="mb-6">
                    <a href="#" class="text-gray-300 hover:text-white">Settings</a>
                </li>
                <li class="mb-6">
                    <a href="{{ route('tambah-barang.barang') }}" class="text-gray-300 hover:text-white">Tambah Barang</a>
                </li>
                <li class="mb-6">
                    <a href="{{ route('logout-process') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="text-gray-300 hover:text-white">Logout</a>
                </li>

                <form id="logout-form" action="{{ route('logout-process') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            {{-- <header class="bg-white p-4 shadow mb-6">
                <h2 class="text-2xl font-semibold">Dashboard</h2>
            </header> --}}

            <main>
                @yield('content')
            </main>
        </div>
    </div>

</body>
@stack('script')
</html>
