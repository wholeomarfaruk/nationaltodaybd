 <footer id="footer_area">

        <div class="topbar wrapper">

            <div class="logo">
                <a href="/">
                    {{-- <span class="fw-bold">Fast.Fresh. Metro News</span><br> --}}
                    <img style="max-width: 100px !important;" src="{{ asset(setting('general.logo')) }}"
                        alt="">
                </a>
            </div>

            <nav class="featured">
                <div class="social">
                    {{-- <h6>সোশ্যাল মিডিয়া</h6> --}}
                    <ul class="navbar-nav">
                        @if (setting('social.facebook'))
                            <li class="nav-item">
                                <a class="nav-link" target="_blank" href="{{ setting('social.facebook') }}"> <i
                                        class="fa-brands fa-facebook"></i>
                                </a>
                            </li>
                        @endif
                         @if (setting('social.instagram'))
                        <li class="nav-item">
                            <a target="_blank" class="nav-link" href="{{ setting('social.instagram') }}"> <i
                                    class="fa-brands fa-instagram"></i>
                            </a>
                        </li>
                        @endif
                         @if (setting('social.youtube'))
                        <li class="nav-item">
                            <a target="_blank" class="nav-link" href="{{ setting('social.youtube') }}"> <i
                                    class="fa-brands fa-youtube"></i>
                            </a>
                        </li>
                        @endif
                         @if (setting('social.twitter'))
                        <li class="nav-item">
                            <a target="_blank" class="nav-link" href="{{ setting('social.twitter') }}"> <i
                                    class="fa-solid fa-x"></i>
                            </a>
                        </li>
                            @endif
                             @if (setting('social.linkedin'))
                        <li class="nav-item">
                            <a target="_blank" class="nav-link" href="{{ setting('social.linkedin') }}"> <i
                                    class="fa-brands fa-linkedin"></i>
                            </a>
                        </li>
                        @endif
                         @if (setting('social.tiktok'))
                        <li class="nav-item">
                            <a target="_blank" class="nav-link" href="{{ setting('social.tiktok') }}"> <i
                                    class="fa-brands fa-tiktok"></i>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
                {{-- <a href="#">
                <img class="" style="max-width: 160px;" src="{{ asset('website/img/others/Android-app.png') }}"
                    alt="">
            </a> --}}
                {{-- <ul>
                    <li><a href="#">কালবেলা</a></li>
                    <li><a href="#">গোপোনিয়তার নিতি</a></li>
                    <li><a href="#">শর্তাবলী</a></li>
                    <li><a href="#">মন্তব্য প্রকাশের নিতিমালা</a></li>
                    <li><a href="#">বিজ্ঞাপন</a></li>
                    <li><a href="#">যোগাযোগ</a></li>
                </ul> --}}
            </nav>

        </div>
        <div class="text_area wrapper">
            <p>Metro News is the Digital news media outlet in Bangladesh.across online and multimedia sectors. We are
                committed to publishing the real news
            </p>
        </div>
        {{-- <div class="featured wrapper pt-3 mb-3">
            <div class="social">
                <h6>সোশ্যাল মিডিয়া</h6>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#"> <i class="fa-brands fa-facebook"></i>
                        </a></li>
                    <li class="nav-item"><a class="nav-link" href="#"> <i class="fa-brands fa-instagram"></i>
                        </a></li>
                    <li class="nav-item"><a class="nav-link" href="#"> <i class="fa-brands fa-youtube"></i>
                        </a></li>
                    <li class="nav-item"><a class="nav-link" href="#"> <i class="fa-brands fa-twitter"></i>
                        </a></li>
                </ul>
            </div>
            <div class="newsletter">
                <h6>নিউজলেটার</h6>
                <form action="#" method="post" class="newsletter-form d-flex flex-column flex-sm-row gap-2">
                    <input type="email" name="email" class="form-control" placeholder="Enter your email"
                        required>
                    <button type="submit" class="btn btn-secondary">সাবস্ক্রাইব</button>
                </form>
                <p class="mt-2 text-muted" style="font-size: 0.95em;">কালবেলা থেকে প্রতিদিন মেইলে আপডেট পেতে
                    সাবস্ক্রাইব করুন।</p>
            </div>

        </div> --}}


        <div class="copyright  bg-secondary bg-opacity-25  py-3 ">
            <div class="wrapper">
                <div class="row g-3 justify-content-between w-100 align-items-center">
                    <div class="col-sm-7">
                        <p class="small text-muted">
                            <span>Editor & Publisher: Md. Mejanur Rahman<br>© 2025 All Rights Reserved |
                                MetroNews.info</span><br>
                            <svg class="footer-icon" aria-hidden="true" focusable="false" data-prefix="fas"
                                data-icon="map-marker-alt" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 384 512">
                                <path fill="currentColor"
                                    d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z">
                                </path>
                            </svg>
                            Corporate Office:
                            Address: House #2 (G. Floor), Road #8,
                            Block-D, Section -11, Mirpur, Dhaka-1216
                            <br>
                            <abbr title="Phone:">
                                <svg class="footer-icon" aria-hidden="true" focusable="false" data-prefix="fas"
                                    data-icon="mobile-alt" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 320 512">
                                    <path fill="currentColor"
                                        d="M272 0H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h224c26.5 0 48-21.5 48-48V48c0-26.5-21.5-48-48-48zM160 480c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm112-108c0 6.6-5.4 12-12 12H60c-6.6 0-12-5.4-12-12V60c0-6.6 5.4-12 12-12h200c6.6 0 12 5.4 12 12v312z">
                                    </path>
                                </svg>
                            </abbr> +880 1318-55 33 00, +880 9606 35 53 55,

                            <span class="small">
                                <abbr title="Email:">
                                    <svg class="footer-icon" aria-hidden="true" focusable="false" data-prefix="fas"
                                        data-icon="envelope" role="img" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512">
                                        <path fill="currentColor"
                                            d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z">
                                        </path>
                                    </svg>
                                </abbr> metronewsinfo@gmail.com<br>
                            </span>
                        </p>
                    </div>
                    <div class="col-sm-5 hidden-print pe-0">
                        <ul class="footer-menu text-lg-end ps-0 pe-0">
                            <li class="d-inline me-2"><a class="border border-secondary p-2" href="#">About
                                    Us</a></li>
                            <li class="d-inline me-2"><a class="border border-secondary p-2"
                                    href="#">Contact</a>
                            </li>
                            <li class="d-inline "><a class="border border-secondary p-2" href="#"
                                    target="_blank">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>


        </div>

    </footer>