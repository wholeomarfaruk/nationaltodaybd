<!doctype html>
<html lang="bn">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @hasSection('meta_title')
            @yield('meta_title') |
        @endif
        {{ setting('general.site_title') }} {{ setting('general.site_tagline') }}
    </title>

    <meta name="description" content="@yield('meta_description', 'Get the latest breaking news, sports updates, politics, and trending stories on Metro News.')">

    <!-- Open Graph (Facebook) -->
    <meta property="og:title" content="@yield('meta_og_title', setting('general.site_title') . ' ' . setting('general.site_tagline'))">

    <meta property="og:description" content="@yield('meta_og_description', 'Get the latest breaking news, sports updates, politics, and trending stories on Metro News.')">

    <meta property="og:image" content="@yield('meta_og_image', asset('website/img/logo/logo.jpeg'))">

    <meta property="og:url" content="{{ url()->current() }}">

    <meta property="og:type" content="article">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('meta_twitter_title', setting('general.site_title') . ' ' . setting('general.site_tagline'))">

    <meta name="twitter:description" content="@yield('meta_twitter_description', 'Get the latest breaking news, sports updates, politics, and trending stories on Metro News.')">

    <meta name="twitter:image" content="@yield('meta_twitter_image', asset(setting('general.logo')))">

    <link rel="canonical" href="{{ url()->current() }}">

    <link rel="shortcut icon" href="{{ asset(setting('general.favicon')) }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- Google Fonts for Bengali -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css"
        integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Include stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('website/css/style.css?v=1.1.4') }}">
    @stack('styles')
</head>

<body>
    <div id="fb-root"></div>
    <script>
        // 1. Define the re-parsing function globally
        window.parseFacebookWidgets = function() {
            if (typeof FB !== 'undefined' && typeof FB.XFBML !== 'undefined') {
                console.log('FB SDK loaded. Re-parsing new Livewire content...');
                // Optional: You can parse a specific element if you have one,
                // e.g., FB.XFBML.parse(document.getElementById('post-list-container'));
                FB.XFBML.parse();
            } else {
                // This fallback handles the extremely rare case where the SDK failed to load
                console.error('FB object not found when trying to re-parse.');
            }
        };

        // 2. Call the function upon the *initial* SDK load
        window.fbAsyncInit = function() {
            FB.init({
                appId: '1011917081107890',
                xfbml: true,
                version: 'v24.0'
            });

            // Initial parse for widgets loaded with the main page
            window.parseFacebookWidgets();
        };

        function loadFacebookSDK() {
            console.log('Loading Facebook SDK...');
        }
    </script>

    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
    {{-- <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v24.0&appId=1011917081107890"></script> --}}


    <header id="header_area" class="shadow-sm">
        <div class="px-2 border-bottom" style="border-color:#ddd;">

            @livewire('ad-component', ['id' => 19, 'height' => '80px'], key('ad-19'))
        </div>

        <div class="wrapper">


            {{-- <div class="ad_area">
                <img src="{{ asset('website/img/ad/728x90.png') }}" alt="">
            </div> --}}


            <div class="top_bar ">

                <div class="logo">
                    <a href="/">
                        {{-- <span class="fw-bold">Fast.Fresh.Metro News</span><br> --}}
                        <img style="max-width: 75px !important;" src="{{ asset(setting('general.logo')) }}"
                            alt=""></a>

                </div>
                <div class="tools">
                    <div class="btn-group"><span class="btn e-paper">Fast. Fresh. Metro News.</span></div>
                    <div class="date btn-group">
                        <p id="localdate" class="btn e-paper">২০শে আগস্ট, ২০২৫</p>
                    </div>
                    <div class="btn-group ">
                        <a href="#" class="btn e-paper"> <i class="fa-solid fa-newspaper"></i> ই-পেপার </a>

                    </div>
                    <div class="search-box">
                        <form class="d-flex">
                            <div class="input-group">
                                <input class="form-control form-control-lg" type="search" placeholder="Search"
                                    aria-label="Search">
                                <button class="btn btn-primary px-4" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                        {{-- <button type="button" class="btn btn-primary"> <i class="fa-solid fa-magnifying-glass"></i>
                        </button> --}}
                    </div>


                </div>


            </div>
        </div>

        <div id="menubar" class="menu_bar   py-1 ">
            <nav class=" navbar  navbar-expand-lg navbar-light p-0">
                <div class="container-fluid wrapper menu-area">
                    <!-- Brand -->
                    <div class="logo" style="max-width: 75px !important;">
                        <a href="/">
                            <img style="max-width: 75px !important;" src="{{ asset(setting('general.logo')) }}"
                                alt="">
                        </a>
                    </div>
                    <div class="e-paper">

                        <a href="#" class="btn border border-light-subtle"> <i class="fa-solid fa-newspaper"></i>
                            ই-পেপার
                        </a>
                    </div>
                    <!-- Toggler -->

                    {{-- <button class="navbar-toggler ms-3" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button> --}}

                    @php
                        $categories = \App\Models\Category::all();
                        $mainmenus = \App\Models\MainMenu::orderBy('sort', 'asc')->get();
                    @endphp
                    <!-- Navbar links -->
                    <div class=" nav collapse navbar-collapse" id="navbarSupportedContent">

                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <!-- Normal link -->
                            <li class="nav-item">
                                <a class="nav-link" href="/"><i class="fa-solid fa-home"></i></a>
                            </li>
                            @foreach ($mainmenus as $mm_item)
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is($mm_item->url) ? 'active' : '' }}"
                                        href="{{ $mm_item->url }}">{{ $mm_item->name }}</a>
                                </li>
                            @endforeach




                            <!-- Mega menu dropdown -->
                            <li class="nav-item dropdown position-static">
                                <a class="nav-link dropdown-toggle" href="#" id="megaMenuDropdown"
                                    role="button" data-bs-toggle="offcanvas" data-bs-target="#main-canvas"
                                    aria-controls="main-canvas">
                                    অন্যান্য
                                </a>

                            </li>

                        </ul>
                    </div>
                    <div class="tools">
                        <div class="search-box">
                            <form class="d-flex">
                                <div class="input-group">
                                    <input class="form-control form-control-lg" type="search" placeholder="Search"
                                        aria-label="Search">
                                    <button class="btn btn-primary px-4" type="submit">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="langswitch-box">
                            <form action="">
                                <fieldset>
                                    <select class="form-control " name="" id="lang-switcher">
                                        <option value="bn">BN</option>
                                        <option value="en">EN</option>
                                    </select>
                                </fieldset>
                            </form>
                        </div>
                        <div class="btn-group ">

                            {{-- <a href="#" class="btn border border-light-subtle"> <i
                                    class="fa-solid fa-newspaper"></i> ই-পেপার
                            </a> --}}
                        </div>
                        <div class="menu-hamburger">

                            <button class="navbar-toggler btn" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#main-canvas" aria-controls="main-canvas">
                                <span class="navbar-toggler-icon"></span>
                            </button>


                        </div>
                    </div>
                </div>
            </nav>

        </div>
        @php
            $menus = \App\Models\Menu::with('children')->where('parent_id', 0)->orderBy('sort', 'asc')->get();
        @endphp

        <div class="offcanvas offcanvas-end" tabindex="-1" id="main-canvas" aria-labelledby="main-canvas-label"
            data-bs-scroll="true" data-bs-backdrop="true" style="z-index: 1055;">

            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="main-canvas-label">Main Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body">
                <nav id="sidebar-menu">

                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                        @foreach ($menus as $item)
                            @if ($item->children->count() > 0)
                                <li class="nav-item border-bottom w-100">
                                    <div class="btn-group dropend w-100">
                                        <a type="button" class="nav-link w-100" href="{{ $item->url }}">
                                            {{ $item->name }}
                                        </a>

                                        <button type="button" class="btn flex-grow-0" data-bs-toggle="offcanvas"
                                            data-bs-target="#sub-canvas-{{ $item->id }}"
                                            aria-controls="sub-canvas-{{ $item->id }}">
                                            <i class="fas fa-caret-right"></i>
                                        </button>
                                    </div>

                                </li>
                            @else
                                <li class="nav-item border-bottom w-100"><a class="nav-link"
                                        href="{{ $item->url }}">{{ $item->name }}</a></li>
                            @endif
                        @endforeach


                    </ul>
                </nav>
            </div>
        </div>
        @php
            $sub_menus = \App\Models\Menu::with('children')->get();
        @endphp
        @foreach ($sub_menus as $canvas_item)
            @if ($canvas_item->children()->count() > 0)
                {{-- @dd($canvas_item->children->parent->name); --}}
                <div class="offcanvas offcanvas-end" tabindex="-1" id="sub-canvas-{{ $canvas_item->id }}"
                    aria-labelledby="sub-canvas-{{ $canvas_item->id }}-label" data-bs-scroll="true"
                    data-bs-backdrop="false" style="z-index: 1060;">

                    <div class="offcanvas-header">
                        @if ($canvas_item->parent_id)
                            <button type="button" class="btn btn-sm btn-outline-secondary me-2 back-button"
                                data-bs-target="#sub-canvas-{{ $canvas_item->parent->id }}" aria-label="Back">
                                <i class="fas fa-arrow-left"></i> Back
                            </button>
                        @else
                            <button type="button" class="btn btn-sm btn-outline-secondary me-2 back-button"
                                data-bs-target="#main-canvas" aria-label="Back">
                                <i class="fas fa-arrow-left"></i> Back
                            </button>
                        @endif

                        <h5 class="offcanvas-title fs-6 text-muted" id="sub-canvas-1-label">Main >
                            {{ $canvas_item->parent ? $canvas_item->parent->name . ' > ' . $canvas_item->name : $canvas_item->name }}
                        </h5>
                        <button type="button" class="btn-close ms-auto close-all-button"
                            aria-label="Close All"></button>
                    </div>

                    <div class="offcanvas-body">
                        <nav id="submenu-1">
                            <ul class="navbar-nav">
                                @foreach ($canvas_item->children as $child_item)
                                    @if ($child_item->children->count() > 0)
                                        <li class="nav-item border-bottom w-100">
                                            <div class="btn-group dropend w-100">
                                                <a type="button" class="nav-link w-100"
                                                    href="{{ $child_item->url }}">
                                                    {{ $child_item->name }}
                                                </a>

                                                <button type="button" class="btn flex-grow-0"
                                                    data-bs-toggle="offcanvas"
                                                    data-bs-target="#sub-canvas-{{ $child_item->id }}"
                                                    aria-controls="sub-canvas-4">
                                                    <i class="fas fa-caret-right"></i>
                                                </button>
                                            </div>

                                        </li>
                                    @else
                                        <li class="nav-item border-bottom w-100"><a class="nav-link"
                                                href="{{ $child_item->url }}">{{ $child_item->name }}</a></li>
                                    @endif
                                @endforeach

                            </ul>
                        </nav>
                    </div>
                </div>
            @endif
        @endforeach


    </header>

    <main id="main_area">
        <div class="wrapper ">


                @livewire('ad-component', ['id' => 18, 'height' => '80px'], key('ad-18'))

        </div>
        @yield('content')
        <div class="wrapper">

            @livewire('ad-component', ['id' => 17, 'height' => '80px'], key('ad-17'))
        </div>
    </main>
    <footer id="footer_area" class="footer-2" style="background: #022c6f;">
        <div class="row wrapper py-4 gap-0 gap-md-0 top-footer">
            <div class="col-12 col-md-4 footer-card">
                <h3 class=" mb-3 footer-card-title">মেট্রো নিউজ</h3>
                <p class=" mb-2 footer-card-text">
                    <span>সম্পাদক ও প্রকাশক</span><br>
                    <span class="text-white">মোঃ মিজানুর রাহমান</span>
                    <span class="d-block mt-2 text">


                        {!! nl2br(e(setting('general.footer_text'))) !!}
                    </span>
                </p>
                <div class="social">
                    {{-- <h6>সোশ্যাল মিডিয়া</h6> --}}
                    <ul class="navbar-nav d-flex flex-row gap-2 justify-content-start align-items-center">
                        @if (setting('social.facebook'))
                            <li class="nav-item">
                                <a class="nav-link" style="" target="_blank"
                                    href="{{ setting('social.facebook') }}"> <img src="{{asset('website/img/icons/facebook-svgrepo-com.svg')}}" />
                                </a>
                            </li>
                        @endif
                        @if (setting('social.instagram'))
                            <li class="nav-item">
                                <a target="_blank" class="nav-link " style=""
                                    href="{{ setting('social.instagram') }}">  <img src="{{asset('website/img/icons/instagram-svgrepo-com.svg')}}" />
                                </a>
                            </li>
                        @endif
                        @if (setting('social.youtube'))
                            <li class="nav-item">
                                <a target="_blank" class="nav-link " style=""
                                    href="{{ setting('social.youtube') }}">  <img src="{{asset('website/img/icons/youtube-svgrepo-com.svg')}}" />
                                </a>
                            </li>
                        @endif
                        @if (setting('social.twitter'))
                            <li class="nav-item">
                                <a target="_blank" class="nav-link " style=""
                                    href="{{ setting('social.twitter') }}"> <img src="{{asset('website/img/icons/twitter_x.svg')}}" />
                                </a>
                            </li>
                        @endif
                        @if (setting('social.linkedin'))
                            <li class="nav-item">
                                <a target="_blank" class="nav-link " style=""
                                    href="{{ setting('social.linkedin') }}">  <img src="{{asset('website/img/icons/linkedin-svgrepo-com.svg')}}" />
                                </a>
                            </li>
                        @endif
                        @if (setting('social.tiktok'))
                            <li class="nav-item">
                                <a target="_blank" class="nav-link " style=""
                                    href="{{ setting('social.tiktok') }}"> <img src="{{asset('website/img/icons/tiktok-logo-logo-svgrepo-com.svg')}}" />
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-4 footer-card quick-link ">
                <h3 class="mb-3 footer-card-title"> গুরুত্বপূর্ণ লিংকসমূহ</h3>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('home') }}"><i class="fa-solid fa-arrow-right-long"></i>
                            মেট্রো নিউজ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#"><i class="fa-solid fa-arrow-right-long"></i>
                            গোপনীয়তার নীতি</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " href="#"><i class="fa-solid fa-arrow-right-long"></i>
                            শর্তাবলি</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#"><i class="fa-solid fa-arrow-right-long"></i> মন্তব্য
                            প্রকাশের নীতিমালা</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#"><i class="fa-solid fa-arrow-right-long"></i>
                            বিজ্ঞাপন</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#"><i class="fa-solid fa-arrow-right-long"></i>
                            ছুটির তালিকা</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#"><i class="fa-solid fa-arrow-right-long"></i>
                            যোগাযোগ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="/posts/recent"><i class="fa-solid fa-arrow-right-long"></i>
                            সর্বশেষ খবর </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#"><i class="fa-solid fa-arrow-right-long"></i>
                            জনপ্রিয় খবর </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#"><i class="fa-solid fa-arrow-right-long"></i>
                            মতামত</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#"><i class="fa-solid fa-arrow-right-long"></i>
                            দিবস</a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-md-4 footer-card contact ">
                <h3 class="text-white mb-3 footer-card-title">যোগাযোগ করুন</h3>
                <ul class="navbar-nav d-flex flex-column flex-wrap gap-2 ">
                    @if (
                        (setting('general.phone') && !empty(setting('general.phone'))) ||
                            (setting('general.secondary_phone') && !empty(setting('general.secondary_phone'))))
                        <li class="contact-item" href="tel:{{ setting('general.phone') }}">
                            <span class="icon ">
                                <i class="fa-solid fa-phone"></i>
                            </span>
                            <div>
                                <h5 class="title">জরুরী প্রয়োজনে</h5>
                                <p class="text">
                                    {{ setting('general.phone') }},
                                    {{ setting('general.secondary_phone') }}
                                </p>
                            </div>

                        </li>
                    @endif
                    @if (setting('general.email') && !empty(setting('general.email')))
                        <li class="contact-item " href="mailto:{{ setting('general.email') }}">
                            <span class="icon">

                                <i class="fa-solid fa-envelope"></i>
                            </span>
                            <div>
                                <h5 class="title">ইমেইল ঠিকানা</h5>
                                <p class="text">
                                    {{ setting('general.email') }}
                                </p>
                            </div>

                        </li>
                    @endif

                    @if (setting('general.address') && !empty(setting('general.address')))
                        <li class="contact-item">
                            <span class="icon">

                                <i class="fa-solid fa-location-dot"></i>
                            </span>
                            <div style="flex-grow: auto;">
                                <h5 class="title">কর্পোরেট অফিস</h5>
                                <p class="text" style="color: rgb(212, 212, 212)">

                                    {{ setting('general.address') }}
                                </p>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <hr class="text-white">
        <div class="wrapper py-1 bottom-footer">
            <h2 style="font-size: 14px;font-weight: 400;color: #ffffffab; text-align:left;">© 2026. All right
                Reserved Developed By <a href="https://www.facebook.com/alimuzahid.dev" style="font-weight: 400;color: #fff">Ali
                    Muzahid</a></h2>
            <p style="font-size: 14px;font-weight: 400;color: #ffffffab; text-align:right;">ওয়েবসাইটের কোনো লেখা, ছবি, ভিডিও অনুমতি ছাড়া ব্যবহার বেআইনি।</p>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('library/moment/moment.js') }}"></script>
    <script src="{{ asset('library/moment/moment-with-locales.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.45/moment-timezone-with-data.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/locale/bn-bd.min.js"
        integrity="sha512-1VBlJq+NEHfEYNKwsk87hSMejTnxm/jqydXadetQC9R1busFkdRXhsyl+dKIRV7TvhnJ9e7xU9z0Fi9Z1NfLNw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script src="{{ asset('website/js/script.js') }}"></script>
    @stack('scripts')
    <script>
        window.onscroll = function() {
            // header sticky on scroll start
            var scroll = document.documentElement.scrollTop;

            if (scroll > 200) {
                document.getElementById("menubar").classList.add("sticky");
            } else {
                document.getElementById("menubar").classList.remove("sticky");
            }
        }
        // header sticky on scroll end
    </script>
    <script>
        // Set locale to Bangla
        $(function() {
            // লোকেল বাংলায় সেট করা হলো
            moment.locale("bn-bd");

            function updateDate() {
                // শুধু ফুল ডেট ফরম্যাট (বার, তারিখ, মাস, সাল)
                let bdDate = moment.tz("Asia/Dhaka").format("LLLL");

                // "LLLL" এর মধ্যে সময়ও থাকে, তাই শুধু তারিখের অংশ কেটে নিলাম
                bdDate = bdDate.split(" ")[0] + " " + moment.tz("Asia/Dhaka").format("LL");

                $("#localdate").text(bdDate);
            }

            updateDate();
        });
    </script>
    <script>
        /**
         * Custom JavaScript for Nested Offcanvas Back/Close Logic
         */
        document.addEventListener('DOMContentLoaded', () => {

            // --- LOGIC FOR THE "CLOSE ALL" BUTTON ---
            document.querySelectorAll('.close-all-button').forEach(button => {
                button.addEventListener('click', function() {
                    // Get ALL offcanvas elements and hide their instances
                    document.querySelectorAll('.offcanvas').forEach(el => {
                        const instance = bootstrap.Offcanvas.getInstance(el);
                        if (instance) {
                            instance.hide();
                        }
                    });
                });
            });


            // --- LOGIC FOR THE "BACK" BUTTON ---
            document.querySelectorAll('.back-button').forEach(button => {
                button.addEventListener('click', function() {
                    // 1. Get the current (open) offcanvas instance
                    const currentOffcanvasElement = this.closest('.offcanvas');
                    const currentOffcanvasInstance = bootstrap.Offcanvas.getInstance(
                        currentOffcanvasElement);

                    // 2. Get the target element ID from the data-bs-target attribute (e.g., #main-canvas)
                    const targetSelector = this.getAttribute('data-bs-target');
                    const targetOffcanvasElement = document.querySelector(targetSelector);

                    if (currentOffcanvasInstance) {
                        // 3. Hide the CURRENT offcanvas
                        currentOffcanvasInstance.hide();
                    }

                    if (targetOffcanvasElement) {
                        // 4. Show the TARGET (parent) offcanvas
                        const targetOffcanvasInstance = bootstrap.Offcanvas.getInstance(
                            targetOffcanvasElement) || new bootstrap.Offcanvas(
                            targetOffcanvasElement);
                        targetOffcanvasInstance.show();
                    }
                });
            });

        });
    </script>
</body>

</html>
