@extends('layout.index')
@section('title','Pesanan')
@section('container')
<div class="flex my-10 ml-28">
    <img src="{{asset($product->gambar_barang)}}" class="h-96 rounded-2xl shadow-md ">
    <div class="ml-10">
        <h1 class="text-3xl font-semibold">{{$product->nama_barang}}</h1>
        <input type="hidden" id="nama_barang" value="{{$product->nama_barang}}">
        <p>{{$product->deskripsi_barang}}</p>
        <div class="mt-72 flex">
            <h1 class="text-lg font-semibold mt-2">Rp {{$product->harga_barang}}</h1>
            <input type="hidden" id="harga" value="{{$product->harga_barang}}">

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

            <button type="button" onclick="openModal()" class="ml-5 text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-10 py-2.5 me-2 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
            </button>

            <!-- Modal -->
            <div id="modalForm" class="fixed z-10 inset-0 overflow-y-auto hidden">
                <div class="flex items-center justify-center min-h-screen">
                    <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Isi Data Diri</h3>
                                    <div class="mt-2">
                                        <form id="modalFormContent">
                                            <div class="mb-4">
                                                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                                                <input type="text" id="nama_siswa" name="nama" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3" required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                                                <input type="text" id="kelas" name="kelas" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3" required>
                                            </div>
                                            <div class="mt-4">
                                                <button type="submit" onclick="kirimpesan(event)" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none">
                                                    Pesan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none" onclick="closeModal()">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha512-+NqPlbbtM1QqiK8ZAo4Yrj2c4lNQoGv8P79DPtKzj++l5jnN39rHA/xsqn8zE9l0uSoxaCdrOgFs6yjyfbBxSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

{{-- <script>

function kirimpesan(){
    // event.preventDefault();
    var nama_barang = document.getElementById('nama_barang').value;
    var harga = document.getElementById('harga').value;
    var jumlah = document.getElementById('jumlah').value;
    var nama_siswa = document.getElementById('nama_siswa').value;
    var kelas = document.getElementById('kelas').value;

    // var gabungan = 'isi%3A%20' + encodeURIComponent(isi);
    var gabungan = 'Nama%20Barang%20%3A%20'+ encodeURIComponent(nama_barang) +'%0AHarga%20Barang%20%3A%20'+encodeURIComponent(harga)+'%0ABerapa%20Yang%20Dipesan%20%3A%20'+encodeURIComponent(jumlah)+'%0A%0ANama%20Siswa%20%3A%20'+encodeURIComponent(nama_siswa)+'%0AKelas%20%3A%20'+encodeURIComponent(kelas) ;

    var token = '7631220503:AAF27epImkHryd637w4jrObxnS0GrwQ3c6E';
    var grup = '-4509511407';

    $.ajax({
        url:`https://api.telegram.org/bot${token}/sendMessage?chat_id=${grup}&text=${gabungan}&parse_mode=html`,
        method: `POST`,
    })
}
</script> --}}

<script>
    function openModal() {
    document.getElementById('modalForm').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('modalForm').classList.add('hidden');
}
</script>

<script>
    function kirimpesan(event) {
    event.preventDefault();

    var nama_barang = document.getElementById('nama_barang').value;
    var harga = document.getElementById('harga').value;
    var jumlah = document.getElementById('counter').value;
    var nama_siswa = document.getElementById('nama_siswa').value;
    var kelas = document.getElementById('kelas').value;

    var total_harga = harga * jumlah;

    var gabungan = `Nama Barang: ${nama_barang}\nHarga Barang: Rp ${harga}\nJumlah Dipesan: ${jumlah}\nNama Siswa: ${nama_siswa}\nKelas: ${kelas}\n\nTotal Harga: Rp ${total_harga}`;

    var token = '7631220503:AAF27epImkHryd637w4jrObxnS0GrwQ3c6E';
    var grup = '-4509511407';

    $.ajax({
        url: `https://api.telegram.org/bot${token}/sendMessage`,
        method: 'POST',
        data: {
            chat_id: grup,
            text: gabungan,
            parse_mode: 'HTML'
        },
        success: function(response) {
            alert('Pesan berhasil dikirim!');
            closeModal();
        },
        error: function(error) {
            console.error('Error:', error);
            alert('Gagal mengirim pesan.');
        }
    });
}

</script>
@endpush
