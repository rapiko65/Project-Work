@extends('dashboard-admin.index')
@section('content')
<div class="flex mb-5">
    <h1 class="text-2xl font-semibold">Barang</h1>
    <a href="{{ route('tambah-barang.tambah') }}" class="ml-[80%] text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-10 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Tambah</a>
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama Produk
                </th>
                <th scope="col" class="px-6 py-3">
                    Deskripsi Product
                </th>
                <th scope="col" class="px-6 py-3">
                    Jumlah Product
                </th>
                <th scope="col" class="px-6 py-3">
                    Gambar Produk
                </th>
                <th scope="col" class="px-6 py-3">
                    Price
                </th>
                <th scope="col" class="px-6 py-3">
                    Category
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
                <th scope="col" class="px-6 py-3">

                </th>
            </tr>
        </thead>
    <?php $i = 1 ?>
        <tbody>
            @foreach ($item as $product)

            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$i++}}
                </th>
                <td class="px-6 py-4">
                    {{$product->nama_barang}}
                </td>
                <td class="px-6 py-4">
                    {{$product->deskripsi_barang}}
                </td>
                <td class="px-6 py-4">
                    {{$product->jumlah_barang}}
                </td>
                <td class="px-6 py-4">
                    <img src="{{ asset($product->gambar_barang) }}" class="h-32 w-32">
                </td>
                <td class="px-6 py-4">
                    {{$product->harga_barang}}
                </td>
                <td class="px-6 py-4">
                    {{$product->category->category}}
                </td>
                <td class="px-6 py-4">
                    <a href="{{route('tambah-barang.barang-edit' , $product->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                </td>
                <td class="px-6 py-4">
                    <form action="{{ route('tambah-barang.destroy-barang', $product->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"  class="btn btn-danger font-medium text-blue-600 dark:text-blue-500 hover:underline"">Delete</button>
                    </form>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $item->links() }}
    </div>
</div>


@endsection
