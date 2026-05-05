   <section id="video_area" class="mb-3">
       <div class="wrapper">
           <div class="video-container border p-3 rounded ">
               <div class="d-flex justify-content-between align-items-center mb-3">
                   <div class="header"><i class="fa-solid fa-video"></i> ভিডিও</div>
                   <a href="{{ route('video.post.list') }}" class="text-decoration-none fw-bold">
                       সব ভিডিও <i class="fa-solid fa-chevron-right"></i>
                   </a>
               </div>
               <div class="owl-carousel owl-theme">
                   @foreach ($videos as $video)
                       <div class="item">
                           <a href="{{ route('video.post.show', $video->slug) }}">
                               <img src="{{ $video->featured_image }}" alt="">
                               <div class="p-2">
                                   <h3 class="secondpost-title">{{ Str::limit($video->title, 61) }}</h3>
                                   {{-- <div class="text-muted" style="font-size: 13px;">
                                        <i class="fa-regular fa-clock"></i> ৩:১৫ মিনিট
                                    </div> --}}
                               </div>
                           </a>
                       </div>
                   @endforeach
                   {{-- <div class="item">
                                <img src="https://www.kalbela.com/assets/video_cover_photos/2025/08/18/cover_photo-4486.webp"
                                    alt="">
                                <div class="p-2">
                                    <div class="fw-bold" style="font-size: 18px;">ভিডিও শিরোনাম ২</div>
                                    <div class="text-muted" style="font-size: 13px;">
                                        <i class="fa-regular fa-clock"></i> ৪:২০ মিনিট
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <img src="https://www.kalbela.com/assets/video_cover_photos/2025/08/18/cover_photo-4485.webp"
                                    alt="">
                                <div class="p-2">
                                    <div class="fw-bold" style="font-size: 18px;">ভিডিও শিরোনাম ৩</div>
                                    <div class="text-muted" style="font-size: 13px;">
                                        <i class="fa-regular fa-clock"></i> ৫:১০ মিনিট
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <img src="https://cdn.jagonews24.com/media/imgAllNew/BG/2023March/root-20250821221434.jpg"
                                    alt="">
                                <div class="p-2">
                                    <div class="fw-bold" style="font-size: 18px;">ভিডিও শিরোনাম ৪</div>
                                    <div class="text-muted" style="font-size: 13px;">
                                        <i class="fa-regular fa-clock"></i> ১:৫৫ মিনিট
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <img src="https://www.kalbela.com/assets/video_cover_photos/2025/08/18/cover_photo-4486.webp"
                                    alt="">
                                <div class="p-2">
                                    <div class="fw-bold" style="font-size: 18px;">ভিডিও শিরোনাম ৫</div>
                                    <div class="text-muted" style="font-size: 13px;">
                                        <i class="fa-regular fa-clock"></i> ৪:২০ মিনিট
                                    </div>
                                </div>
                            </div> --}}
               </div>
           </div>
       </div>
   </section>
