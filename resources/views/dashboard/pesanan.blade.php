@extends('layout.index')
@section('container')
    <div class="flex my-10 ml-28">
        <img src="{{asset('image/a k i.jpeg')}}" class="h-96 rounded-2xl shadow-md ">
        <div class="ml-10">
            <h1 class="text-3xl font-semibold">Nama Barang</h1>
            <p>Deskripsi</p>
            <div class="mt-72 flex">
                <h1 class="text-lg font-semibold mt-2">Rp 100000</h1>
                <div class="ml-80">
                    <div class="flex items-center space-x-4">
                        <button onclick="decrement()" class="px-4 py-2 bg-slate-300 text-black rounded-lg hover:bg-slate-500">
                            -
                        </button>
                        <input id="counter" type="text" class="w-20 text-center text-xl border-2 border-slate-300 rounded-lg" value="0" readonly />
                        <button onclick="increment()" class="px-4 py-2 bg-slate-300 text-black rounded-lg hover:bg-slate-500">
                            +
                        </button>
                    </div>
                </div>
                <button type="button" class="ml-5 text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-10 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"><svg
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg></button>
            </div>
        </div>
    </div>
@endsection
@push('script')
<script>
    let counter = 0;
    function increment() {
        counter++;
        document.getElementById('counter').value = counter;
    }

    function decrement() {
        if (counter > 0) {
            counter--;
            document.getElementById('counter').value = counter;
        }
    }
</script>

<script>
    
</script>
@endpush
