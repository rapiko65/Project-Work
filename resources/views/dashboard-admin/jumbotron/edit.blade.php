@extends('dashboard-admin.index')
@push('css')
<style>
    .drag-area {
        border: 2px dashed #ddd;
        padding: 20px;
        transition: background-color 0.3s ease;
    }

    .drag-area.dragover {
        background-color: #f0f4f8;
    }
</style>
@endpush
@section('content')
<body class="bg-gray-100">

    <div class="max-w-lg  ">
        <h1 class="text-xl font-bold mb-4 text-center">Edit Jumbotron</h1>

        <!-- Tampilkan Pesan Error -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Input -->
        <form action="{{route('tambah-jumbotron.jumbotron-update', $jumbotron->id)}}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="nama" id="nama" value="{{ $jumbotron->nama }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Upload Gambar</label>
                <div class="drag-area mt-2 p-4 rounded-lg bg-gray-100 text-center cursor-pointer">
                    <p class="drop-text text-gray-600">Seret gambar ke sini atau klik untuk memilih</p>
                </div>
                <input type="file" name="image" id="image" class="hidden" accept="image/*" >
            </div>

            <div>
                <button type="submit" class="w-full text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-10 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                    Submit
                </button>
            </div>
        </form>
    </div>

</body>
@endsection
@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dragArea = document.querySelector('.drag-area');
        const fileInput = document.querySelector('#image');
        const dropText = document.querySelector('.drop-text');

        dragArea.addEventListener('dragover', (event) => {
            event.preventDefault();
            dragArea.classList.add('dragover');
            dropText.textContent = "Lepaskan untuk mengupload gambar";
        });

        dragArea.addEventListener('dragleave', () => {
            dragArea.classList.remove('dragover');
            dropText.textContent = "Seret gambar ke sini atau klik untuk memilih";
        });

        dragArea.addEventListener('drop', (event) => {
            event.preventDefault();
            dragArea.classList.remove('dragover');
            const files = event.dataTransfer.files;
            fileInput.files = files;
            dropText.textContent = files[0].name;
        });

        dragArea.addEventListener('click', () => fileInput.click());

        fileInput.addEventListener('change', () => {
            if (fileInput.files.length > 0) {
                dropText.textContent = fileInput.files[0].name;
            }
        });
    });
</script>
@endpush
