    @extends('layout.index')
    @section('title','Dashboard')
    @push('style')

    @endpush
    @section('container')
    {{-- caraousel --}}
    <div x-data="carouselData()" x-init="autoplay" class="relative w-full overflow-hidden">

        <!-- slides -->
        <!-- Change min-h-[50svh] to your preferred height size -->
        <div class="relative min-h-[50svh] w-full">
            <template x-for="(slide, index) in slides">
                <div x-cloak x-show="currentSlideIndex == index + 1" class="absolute inset-0" x-transition.opacity.duration.1000ms>

                    <!-- Title and description -->
                    <div class="lg:px-32 lg:py-14 absolute inset-0 z-10 flex flex-col items-center justify-end gap-2 bg-gradient-to-t from-neutral-950/85 to-transparent px-16 py-12 text-center">
                        <h3 class="w-full lg:w-[80%] text-balance text-2xl lg:text-3xl font-bold text-white" x-text="slide.title" x-bind:aria-describedby="'slide' + (index + 1) + 'Description'"></h3>
                        <p class="lg:w-1/2 w-full text-pretty text-sm text-neutral-300" x-text="slide.description" x-bind:id="'slide' + (index + 1) + 'Description'"></p>
                    </div>

                    <img class="absolute w-full h-full inset-0 object-cover text-neutral-600 dark:text-neutral-300" x-bind:src="slide.imgSrc" x-bind:alt="slide.imgAlt" />
                </div>
            </template>
        </div>

        <!-- Pause/Play Button -->
        {{-- <button type="button" class="absolute bottom-5 right-5 z-20 rounded-full text-neutral-300 opacity-50 transition hover:opacity-80 focus-visible:opacity-80 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white active:outline-offset-0" aria-label="pause carousel" x-on:click="(isPaused = !isPaused), setAutoplayInterval(autoplayIntervalTime)" x-bind:aria-pressed="isPaused">
            <svg x-cloak x-show="isPaused" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="size-7">
                <path fill-rule="evenodd" d="M2 10a8 8 0 1 1 16 0 8 8 0 0 1-16 0Zm6.39-2.908a.75.75 0 0 1 .766.027l3.5 2.25a.75.75 0 0 1 0 1.262l-3.5 2.25A.75.75 0 0 1 8 12.25v-4.5a.75.75 0 0 1 .39-.658Z" clip-rule="evenodd">
            </svg>
            <svg x-cloak x-show="!isPaused" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="size-7">
                <path fill-rule="evenodd" d="M2 10a8 8 0 1 1 16 0 8 8 0 0 1-16 0Zm5-2.25A.75.75 0 0 1 7.75 7h.5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-.75.75h-.5a.75.75 0 0 1-.75-.75v-4.5Zm4 0a.75.75 0 0 1 .75-.75h.5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-.75.75h-.5a.75.75 0 0 1-.75-.75v-4.5Z" clip-rule="evenodd">
            </svg>
        </button> --}}

        <!-- indicators -->
        <div class="absolute rounded-md bottom-3 md:bottom-5 left-1/2 z-20 flex -translate-x-1/2 gap-4 md:gap-3 px-1.5 py-1 md:px-2" role="group" aria-label="slides" >
            <template x-for="(slide, index) in slides">
                <button class="size-2 cursor-pointer rounded-full transition" x-on:click="(currentSlideIndex = index + 1), setAutoplayInterval(autoplayIntervalTime)" x-bind:class="[currentSlideIndex === index + 1 ? 'bg-neutral-300' : 'bg-neutral-300/50']" x-bind:aria-label="'slide ' + (index + 1)"></button>
            </template>
        </div>
    </div>


    {{-- end caraousel --}}

    {{-- Card --}}
    <div class="flex ">

        <h1 class="text-4xl ml-5 mt-12 mb-2 font-semibold">Barang</h1>
        <form action="{{ route('dashboard-awal') }}" method="GET" class="mt-12 ml-4">
            <label for="category_id" class="block text-sm font-medium text-gray-700">Pilih Kategori</label>
            <select name="category_id" id="category_id" class="form-control" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $categoryName == $category->id ? 'selected' : '' }}>
                        {{ $category->category }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>
    <div x-data="swipeCards()" x-init="
                let isDown = false;
                let startX;
                let scrollLeft;
                $el.addEventListener('mousedown', (e) => {
                isDown = true;
                startX = e.pageX - $el.offsetLeft;
                scrollLeft = $el.scrollLeft;
                });
                $el.addEventListener('mouseleave', () => {
                isDown = false;
                });
                $el.addEventListener('mouseup', () => {
                isDown = false;
                });
                $el.addEventListener('mousemove', (e) => {
                    if (!isDown) return;
                    e.preventDefault();
                    const x = e.pageX - $el.offsetLeft;
                const walk = (x - startX) * 1;
                $el.scrollLeft = scrollLeft - walk;
                });
                " class="overflow-x-scroll scrollbar-hide relative px-0.5 mb-12" style="overflow-y: hidden;">
                <div class="relative w-full flex mt-4 mb-4">
                    @foreach ($products as $product)
                    <!-- Card Items -->
                    <div class="flex space-x-4 mx-2 mb-2">
                        <!-- Card 1 -->
                        <div class="w-64 flex-none bg-white border shadow-lg rounded-lg p-4">
                            {{-- https://picsum.photos/400/300?random={{ $i }} --}}
                            <img src="{{$product->gambar_barang}}" alt="Cocktail" class="w-full h-40 object-cover rounded-md mb-2">
                            <h2 class="text-lg font-semibold">{{$product->nama_barang}}</h2>
                            <p class="text-gray-600">{{$product->deskripsi_barang}}</p>
                            <div class="flex justify-between items-center mt-4">
                                <span class="text-xl font-bold">Rp {{$product->harga_barang}}</span>
                                @if (Auth()->user())
                                <a href="{{route('show-simpanan', $product->id)}}"
                                    class="text-white bg-fuchsia-950 hover:bg-fuchsia-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"><svg
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                </svg></a>
                                @else
                                <a href="{{route('login')}}"
                                    class="text-white bg-fuchsia-950 hover:bg-fuchsia-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"><svg
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                </svg></a>
                                @endif
                            </div>
                        </div>

                    </div>
                    @endforeach
                </div>
    </div>
    {{-- End Card --}}

    {{-- Card --}}
    {{-- <h1 class="text-4xl ml-5 mt-12 mb-2 font-semibold">Category Barang</h1>
    <div x-data="swipeCards()" x-init="
                let isDown = false;
                let startX;
                let scrollLeft;
                $el.addEventListener('mousedown', (e) => {
                isDown = true;
                startX = e.pageX - $el.offsetLeft;
                scrollLeft = $el.scrollLeft;
                });
                $el.addEventListener('mouseleave', () => {
                isDown = false;
                });
                $el.addEventListener('mouseup', () => {
                isDown = false;
                });
                $el.addEventListener('mousemove', (e) => {
                    if (!isDown) return;
                    e.preventDefault();
                    const x = e.pageX - $el.offsetLeft;
                const walk = (x - startX) * 1;
                $el.scrollLeft = scrollLeft - walk;
                });
                " class="overflow-x-scroll scrollbar-hide relative px-0.5 mb-12" style="overflow-y: hidden;">
                <div class="relative w-full flex mt-4 mb-4">
                    @for ($i = 1; $i <= 15; $i++)
                    <!-- Card Items -->
                    <div class="flex space-x-4 mx-2 mb-2">
                        <!-- Card 1 -->
                        <div class="w-64 flex-none bg-white border shadow-lg rounded-lg p-4">
                            <img src="https://picsum.photos/400/300?random={{ $i }}" alt="Cocktail" class="w-full h-40 object-cover rounded-md mb-2">
                            <h2 class="text-lg font-semibold">Cocktail</h2>
                            <p class="text-gray-600">Tropical mix of flavors, perfect for parties.</p>
                            <div class="flex justify-between items-center mt-4">
                                <span class="text-xl font-bold">$8.99</span>
                                <a :href=""
                                    class="text-white bg-fuchsia-950 hover:bg-fuchsia-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"><svg
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                </svg></a>
                            </div>
                        </div>

                    </div>
                    @endfor
                </div>
    </div> --}}
    {{-- End Card --}}

    {{-- <div x-data="swipeCards()" x-init="
    let isDown = false;
    let startX;
    let scrollLeft;
    $el.addEventListener('mousedown', (e) => {
        isDown = true;
                startX = e.pageX - $el.offsetLeft;
                scrollLeft = $el.scrollLeft;
                });
                $el.addEventListener('mouseleave', () => {
                isDown = false;
                });
                $el.addEventListener('mouseup', () => {
                isDown = false;
                });
                $el.addEventListener('mousemove', (e) => {
                    if (!isDown) return;
                    e.preventDefault();
                    const x = e.pageX - $el.offsetLeft;
                const walk = (x - startX) * 1;
                $el.scrollLeft = scrollLeft - walk;
                });
                " class="overflow-x-scroll scrollbar-hide relative px-0.5 mt-12 mb-12" style="overflow-y: hidden;">
                <div class="flex snap-x snap-mandatory gap-4" style="width: max-content;">

                    @for ($i = 1; $i <= 12; $i++)
                    <template x-for="card in cards" :key="card.id">
                        <div class="flex-none w-64 snap-center">
                            <div class="bg-white border-1 border border-gray-200 rounded-lg overflow-hidden mb-4">
                                <img src="https://picsum.photos/400/300?random={{ $i }}" alt="" class="w-full h-40 object-cover">
                                <div class="p-4">
                                    <h3 class="text-lg leading-6 font-bold text-gray-900" x-text="card.title"></h3>
                            <p class="text-gray-600 mt-2 text-sm" x-text="card.description"></p>
                            <div class="flex justify-between items-center mt-4">
                                <span class="text-2xl font-extrabold text-gray-900" x-text="'$' + card.price.toFixed(2)"></span>
                                <a :href="card.link"
                                    class="text-white bg-fuchsia-950 hover:bg-fuchsia-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"><svg
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                </svg></a>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
            @endfor
        </div>
    </div> --}}


    {{-- <div x-data="swipeCards()" x-init="
                let isDown = false;
                let startX;
                let scrollLeft;
                $el.addEventListener('mousedown', (e) => {
                isDown = true;
                startX = e.pageX - $el.offsetLeft;
                scrollLeft = $el.scrollLeft;
                });
                $el.addEventListener('mouseleave', () => {
                isDown = false;
                });
                $el.addEventListener('mouseup', () => {
                isDown = false;
                });
                $el.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - $el.offsetLeft;
                const walk = (x - startX) * 1;
                $el.scrollLeft = scrollLeft - walk;
                });
                " class="overflow-x-scroll scrollbar-hide relative px-0.5 mt-12 mb-12" style="overflow-y: hidden;">
        <div class="flex snap-x snap-mandatory gap-4" style="width: max-content;">
            <template x-for="card in cards" :key="card.id">
                <div class="flex-none w-64 snap-center">
                    <div class="bg-white border-1 border border-gray-200 rounded-lg overflow-hidden mb-4">
                        <img :src="card.image" alt="" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg leading-6 font-bold text-gray-900" x-text="card.title"></h3>
                            <p class="text-gray-600 mt-2 text-sm" x-text="card.description"></p>
                            <div class="flex justify-between items-center mt-4">
                                <span class="text-2xl font-extrabold text-gray-900" x-text="'$' + card.price.toFixed(2)"></span>
                                <a :href="card.link"
                                    class="text-white bg-fuchsia-950 hover:bg-fuchsia-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"><svg
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                    </svg></a>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div> --}}
    @endsection
    @push('script')

        <script>
    function carouselData() {
        return {
            autoplayIntervalTime: 2000,
            slides: [
                @foreach ($jumbotron as $item)
                {
                    imgSrc: '{{ $item->gambar }}',// Assuming you have description in your data
                },
                @endforeach
            ],
            currentSlideIndex: 1,
            isPaused: false,
            autoplayInterval: null,
            previous() {
                if (this.currentSlideIndex > 1) {
                    this.currentSlideIndex = this.currentSlideIndex - 1;
                } else {
                    this.currentSlideIndex = this.slides.length;
                }
            },
            next() {
                if (this.currentSlideIndex < this.slides.length) {
                    this.currentSlideIndex = this.currentSlideIndex + 1;
                } else {
                    this.currentSlideIndex = 1;
                }
            },
            autoplay() {
                this.autoplayInterval = setInterval(() => {
                    if (!this.isPaused) {
                        this.next();
                    }
                }, this.autoplayIntervalTime);
            },
            setAutoplayInterval(newIntervalTime) {
                clearInterval(this.autoplayInterval);
                this.autoplayIntervalTime = newIntervalTime;
                this.autoplay();
            }
        };
    }
</script>

    @endpush
