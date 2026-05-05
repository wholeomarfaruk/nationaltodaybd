@extends('layouts.website')
@section('content')
    <style>
        .text-hover-red {
            transition: all 0.2s ease-in-out;
        }

        .text-hover-red:hover {
            color: red !important;
            transition: all 0.2s ease-in-out;

        }

        .newsticker {}

        .newsticker .scrolling,
        .newsticker .heading {
            font-size: 18px;
        }

        .newsticker .heading-box {
            background-color: red;
            width: fit-content;
            min-width: 120px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 8px 2px 20px 2px rgba(0, 0, 0, 0.25);
        }

        .newsticker .heading-box,
        .newsticker .scrolling {
            height: 40px;
        }

        @media (max-width: 768px) {

            .newsticker .scrolling,
            .newsticker .heading {
                font-size: 16px;
            }

            .newsticker .heading-box,
            .newsticker .scrolling {
                height: 35px;
            }

            .newsticker .heading-box {

                min-width: 100px;

            }
        }
    </style>
    {{-- NewsTracker --}}
    <section class="newsticker">
        <div class="d-flex  overflow-hidden align-items-center border-bottom">
            <div class="heading-box bg-opacity-50" style="">
                <p class="m-0 fw-bold  text-white heading">প্রধান সংবাদ:</p>
            </div>

            <marquee class="scrolling flex-grow-1 d-flex align-items-center" behavior="" speed="100" direction="rtl"
                class="text-dark" onmouseover="this.stop()" onmouseout="this.start()">
                @foreach ($latestPost as $marqpost)
                    <a href="{{ route('post.show', ['category' => $marqpost->category, 'slug' => $marqpost->slug]) }}"
                        class="text-decoration-none text-dark me-4 text-hover-red fw-semibold ">{{ $marqpost->title }}</a>
                @endforeach
            </marquee>

        </div>


    </section>
    <!--Banner section section start -->
    @if ($latestPost && $latestPost?->count() > 0)
        <section id="featured_news" class="mt-4 mb-3">
            <div class="wrapper">
                <div class="row align-items-stretch">
                    <div class="col-md-9">
                        <div class="border-box border border-lg-1 border p-lg-3 rounded ">

                            <div class="row g-3">
                                <div class="col-md-8">


                                    @if (!$featuredPost)
                                        <a href="#">
                                            <div class="card mb-3 p-2 rounded ">
                                                <div class="row flex-column g-0">
                                                    <div class="">
                                                        <img style="height: 100%;  width: 100%; object-fit: cover; max-height: 366px; "
                                                            src="{{ asset('website/img/thumbnails/featured_img.jpg') }}"
                                                            class="img-fluid rounded-start" alt="...">
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="card-body">

                                                            <h1 class="card-title topnews-title">
                                                                No title
                                                            </h1>
                                                            <p class="card-text topnews-short-text">
                                                                No Excerpt
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @else
                                        <a href="{{ $featuredPost->PostUrl }}">
                                            <div class="card mb-3 p-2 rounded ">
                                                <div class="row flex-column g-0">
                                                    <div class="">
                                                        <img style="height: 100%;  width: 100%; object-fit: cover; max-height: 366px; "
                                                            src="{{ $featuredPost->featured_image }}"
                                                            class="img-fluid rounded-start" alt="...">
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="card-body">

                                                            <h1 class="card-title topnews-title">
                                                                {{ $featuredPost->title }}
                                                            </h1>
                                                            <p class="card-text topnews-short-text">
                                                                {{ $featuredPost->excerpt }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                    <div class="row  g-2">
                                        @php
                                            $rajniti = $categories->find(9)?->posts()?->latest()?->first();
                                        @endphp
                                        @if ($rajniti)
                                            <div class="col-lg-6 col-6">
                                                <a
                                                    href="{{ route('post.show', ['category' => $rajniti?->category?->slug, 'slug' => $rajniti?->slug]) }}">
                                                    <div class="card mb-3 p-2 rounded h-100">
                                                        <div class="row flex-column g-0">
                                                            <div class="col-auto">
                                                                <img style="height: 100%; width: cover;"
                                                                    src="{{ $rajniti->featured_image }}"
                                                                    class="img-fluid rounded-start" alt="...">
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="card-body">

                                                                    <h3 class="card-title secondpost-title">
                                                                        {{ $rajniti->title }}
                                                                    </h3>
                                                                    {{-- <p class="card-text topnews-short-text">
                                                                {{ $saradesh->excerpt }}
                                                            </p> --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>



                                            </div>
                                        @endif
                                        @php
                                            $banijjo = $categories->find(8)?->posts()?->latest()?->first();
                                        @endphp
                                        @if ($banijjo)
                                            <div class="col-lg-6 col-6">
                                                <a
                                                    href="{{ route('post.show', ['category' => $banijjo?->category?->slug, 'slug' => $banijjo?->slug]) }}">
                                                    <div class="card mb-3 p-2 rounded h-100">
                                                        <div class="row flex-column g-0">
                                                            <div class="col-auto">
                                                                <img style="height: 100%;  width: 100%; object-fit: cover; max-height: 160px; "
                                                                    src="{{ $banijjo->featured_image }}"
                                                                    class="img-fluid rounded-start" alt="...">
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="card-body">

                                                                    <h3 class="card-title secondpost-title">
                                                                        {{ $banijjo->title }}
                                                                    </h3>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>

                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <div class="row g-2">
                                        @php
                                            $jatio = $categories->find(7)->posts()->latest()->first();
                                        @endphp

                                        <div class="col-lg-12 col-6">

                                            <div class="card">
                                                <a
                                                    href="{{ route('post.show', ['category' => $jatio->category->slug, 'slug' => $jatio->slug]) }}">
                                                    <img src="{{ $jatio->featured_image }}" class="card-img-top"
                                                        alt="...">
                                                    <div class="card-body">
                                                        <h3 class="card-title  secondpost-title">{{ $jatio->title }}
                                                        </h3>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-6">
                                            @php
                                                $saradeh = $categories->find(5)->posts()->latest()->first();
                                            @endphp
                                            <div class="card">
                                                <a
                                                    href="{{ route('post.show', ['category' => $saradeh->category->slug, 'slug' => $saradeh->slug]) }}">
                                                    <div class="row g-0 align-items-center">
                                                        <div class="col-md-5">
                                                            <img style="object-fit: cover;"
                                                                src="{{ $saradeh->featured_image }}"
                                                                class="img-fluid rounded-start" alt="...">
                                                        </div>
                                                        <div class="col-md-7 m-0 p-0">
                                                            <div class="card-body m-0 p-0">
                                                                <h3 class="card-title secondpost-title ms-3">
                                                                    {{ $saradeh->title }}
                                                                </h3>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-6">
                                            @php
                                                $internationalnews = $categories->find(6)->posts()->latest()->first();
                                            @endphp
                                            <div class="card">
                                                <a
                                                    href="{{ route('post.show', ['category' => $internationalnews->category->slug, 'slug' => $internationalnews->slug]) }}">
                                                    <div class="row g-0 align-items-center">
                                                        <div class="col-md-5">
                                                            <img style="object-fit: cover;"
                                                                src="{{ $internationalnews->featured_image }}"
                                                                class="img-fluid rounded-start" alt="...">
                                                        </div>
                                                        <div class="col-md-7 m-0 p-0">
                                                            <div class="card-body m-0 p-0">
                                                                <h3 class="card-title secondpost-title ms-3">
                                                                    {{ $internationalnews->title }}
                                                                </h3>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-6">
                                            @php
                                                $sportsnews = $categories->find(3)->posts()->latest()->first();
                                            @endphp
                                            <div class="card">
                                                <a
                                                    href="{{ route('post.show', ['category' => $sportsnews->category->slug, 'slug' => $sportsnews->slug]) }}">
                                                    <div class="row g-0 align-items-center">
                                                        <div class="col-md-5">
                                                            <img style="object-fit: cover;"
                                                                src="{{ $sportsnews->featured_image }}"
                                                                class="img-fluid rounded-start" alt="...">
                                                        </div>
                                                        <div class="col-md-7 m-0 p-0">
                                                            <div class="card-body m-0 p-0">
                                                                <h3 class="card-title secondpost-title ms-3">
                                                                    {{ $sportsnews->title }}
                                                                </h3>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                        @php
                                            $binodonnews = $categories->find(4)->posts()->latest()->first();
                                        @endphp
                                        <div class="col-lg-12 col-6">

                                            <div class="card">
                                                <a
                                                    href="{{ route('post.show', ['category' => $binodonnews->category->slug, 'slug' => $binodonnews->slug]) }}">
                                                    <div class="row g-0 align-items-center">
                                                        <div class="col-md-5">
                                                            <img style="object-fit: cover;"
                                                                src="{{ $binodonnews->featured_image }}"
                                                                class="img-fluid rounded-start" alt="...">
                                                        </div>
                                                        <div class="col-md-7 m-0 p-0">
                                                            <div class="card-body m-0 p-0">
                                                                <h3 class="card-title secondpost-title ms-3">
                                                                    {{ $binodonnews->title }}
                                                                </h3>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-6">
                                            @php
                                                $shikkha = $categories->find(10)->posts()->latest()->first();
                                            @endphp
                                            <div class="card">
                                                <a
                                                    href="{{ route('post.show', ['category' => $shikkha->category->slug, 'slug' => $shikkha->slug]) }}">
                                                    <div class="row g-0 align-items-center">
                                                        <div class="col-md-5">
                                                            <img style="object-fit: cover;"
                                                                src="{{ $shikkha->featured_image }}"
                                                                class="img-fluid rounded-start" alt="...">
                                                        </div>
                                                        <div class="col-md-7 m-0 p-0">
                                                            <div class="card-body m-0 p-0">
                                                                <h3 class="card-title secondpost-title ms-3">
                                                                    {{ $shikkha->title }}
                                                                </h3>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        @php
                                            $oporad = $categories->find(12)?->posts()?->latest()?->first();
                                        @endphp
                                        @if ($oporad)
                                            <div class="col-lg-12 col-6">

                                                <div class="card">
                                                    <a
                                                        href="{{ route('post.show', ['category' => $oporad->category->slug, 'slug' => $oporad->slug]) }}">
                                                        <div class="row g-0 align-items-center">
                                                            <div class="col-md-5">
                                                                <img style="object-fit: cover;"
                                                                    src="{{ $oporad->featured_image }}"
                                                                    class="img-fluid rounded-start" alt="...">
                                                            </div>
                                                            <div class="col-md-7 m-0 p-0">
                                                                <div class="card-body m-0 p-0">
                                                                    <h3 class="card-title secondpost-title ms-3">
                                                                        {{ $oporad->title }}
                                                                    </h3>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-3 h-100">
                        <div class="border p-3 rounded ">
                            <div class="follow-us row mb-3 mx-2 py-3 rounded shadow-sm text-center align-items-center">
                                <p class="fw-bold  col-5" style="font-size: 18px;">Follow Us</p>
                                <div class=" col-7 d-flex justify-content-center gap-3 align-items-center">
                                    <!-- Facebook -->
                                    <a href="{{ setting('social.facebook', '#') }}" target="_blank"
                                        class="btn-hover-effect-1 social-icon facebook">
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="48"
                                            height="48" viewBox="0 0 48 48">
                                            <path fill="#3F51B5"
                                                d="M42,37c0,2.762-2.238,5-5,5H11c-2.761,0-5-2.238-5-5V11c0-2.762,2.239-5,5-5h26c2.762,0,5,2.238,5,5V37z">
                                            </path>
                                            <path fill="#FFF"
                                                d="M34.368,25H31v13h-5V25h-3v-4h3v-2.41c0.002-3.508,1.459-5.59,5.592-5.59H35v4h-2.287C31.104,17,31,17.6,31,18.723V21h4L34.368,25z">
                                            </path>
                                        </svg>
                                    </a>
                                    <!-- YouTube -->
                                    <a href="{{ setting('social.youtube', '#') }}" target="_blank"
                                        class="btn-hover-effect-1 social-icon youtube">
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="48"
                                            height="48" viewBox="0 0 48 48">
                                            <path fill="#FF3D00"
                                                d="M43.2,33.9c-0.4,2.1-2.1,3.7-4.2,4c-3.3,0.5-8.8,1.1-15,1.1c-6.1,0-11.6-0.6-15-1.1c-2.1-0.3-3.8-1.9-4.2-4C4.4,31.6,4,28.2,4,24c0-4.2,0.4-7.6,0.8-9.9c0.4-2.1,2.1-3.7,4.2-4C12.3,9.6,17.8,9,24,9c6.2,0,11.6,0.6,15,1.1c2.1,0.3,3.8,1.9,4.2,4c0.4,2.3,0.9,5.7,0.9,9.9C44,28.2,43.6,31.6,43.2,33.9z">
                                            </path>
                                            <path fill="#FFF" d="M20 31L20 17 32 24z"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            @livewire('ad-component', ['id' => 2])

                            {{-- <div class="e-paper mb-2">
                                <img src="{{ asset('website/img/others/e-newspaper.jpg') }}" alt="">
                            </div> --}}
                            @livewire('latest-news-tab')
                            @livewire('ad-component', ['id' => 3])


                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!--Banner section section End -->
    @if ($categories && $categories->count() > 0)
        <div class="wrapper">

            @livewire('ad-component', ['id' => 8,"height" => "80px"], key('ad-8'))
        </div>
        @if ($videos)
            <x-video-section-carousel :videos="$videos ?? collect()" />
        @endif
        @if ($categories?->find(6)?->posts()?->latest()?->get())
            <x-post-section :newsPosts="$categories->find(6)->posts()->latest()->get() ?? collect()" :style="1" />
        @endif
        <div class="wrapper">
            @livewire('ad-component', ['id' => 9,"height" => "80px"], key('ad-9'))
        </div>

        @if ($categories?->find(8)?->posts()?->latest()?->get())
            <x-post-section :newsPosts="$categories->find(8)->posts()->latest()->get() ?? collect()" :style="2" />
        @endif
        <div class="wrapper">

            @livewire('ad-component', ['id' => 10,"height" => "80px"], key('ad-10'))
        </div>

        @if ($categories?->find(5)?->posts()?->latest()?->get())
            <x-post-section :newsPosts="$categories->find(5)->posts()->latest()->get() ?? collect()" :style="3" />
        @endif

        <div class="wrapper">

            @livewire('ad-component', ['id' => 11,"height" => "80px"], key('ad-11'))
        </div>
        @if ($categories?->find(4)?->posts()?->latest()?->get())
            <x-post-section :newsPosts="$categories->find(4)->posts()->latest()->get() ?? collect()" :style="2" />
        @endif


        <div class="wrapper">

            @livewire('ad-component', ['id' => 12,"height" => "80px"], key('ad-12'))
        </div>
        @if ($categories?->find(2)?->posts()?->latest()?->get())
            <x-post-section :newsPosts="$categories->find(2)->posts()->latest()->get() ?? collect()" :style="5" />
        @endif

        {{-- <div class="wrapper">
            @livewire('ad-component', ['id' => 13], key('ad-13'))
        </div>
        @if ($categories?->find(3)?->posts()?->latest()?->get())
            <x-post-section :newsPosts="$categories->find(3)->posts()->latest()->get() ?? collect()" :style="1" />
        @endif --}}



        {{-- <div class="wrapper">

            @livewire('ad-component', ['id' => 14], key('ad-14'))
        </div>
        @if ($categories?->find(10)?->posts()?->latest()?->get())
            <x-post-section :newsPosts="$categories->find(10)->posts()->latest()->get() ?? collect()" :style="5" />
        @endif --}}
        {{-- <div class="wrapper">

            @livewire('ad-component', ['id' => 15], key('ad-15'))
        </div>
        @if ($categories?->find(29)?->posts()?->latest()?->get())
            <x-post-section :newsPosts="$categories->find(29)->posts()->latest()->get() ?? collect()" :style="2" />
        @endif
        <div class="wrapper">

            @livewire('ad-component', ['id' => 16], key('ad-16'))
        </div>
        @if ($categories?->find(4)?->posts()?->latest()?->get())
            <x-post-section :newsPosts="$categories->find(4)->posts()->latest()->get() ?? collect()" :style="3" />
        @endif --}}
    @endif

@endsection

@push('scripts')
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 1.5
                },
                768: {
                    items: 2.5
                },
                992: {
                    items: 3.5
                },
                1200: {
                    items: 4.5
                },

            }
        })
    </script>
@endpush
