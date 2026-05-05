@extends('layouts.website')
@section('content')
    <section id="singlepost">
        <div class="wrapper my-3">
            <div class="ad bg-dark bg-opacity-50 d-flex justify-content-center align-items-center mb-3" style="height: 100px">
                <span class="text-danger fs-3">For Ad</span>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="breadcrum">
                        <i class="fa-solid fa-home"></i> / <a class="fs-bold text-primary" href="#">Category Name</a>
                    </div>
                    <div class="rpt_info_section border-bottom mb-2 pb-2">
                        <div class="rpt_name mt-2"><i class="fa-solid fa-circle-user me-2"></i>দি মেসেজ টু ডে
                            প্রতিবেদক</div>
                        <div class="entry_update mb-0"><span class="Layer_1" style="float: left"><svg id="Layer_1"
                                    data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13.95 16">
                                    <defs>
                                        <style>
                                            .cls-1 {
                                                fill: #121212;
                                            }
                                        </style>
                                    </defs>
                                    <path class="cls-1"
                                        d="M13.65,5.2,7.78.27a1.26,1.26,0,0,0-1.56,0L.35,5.2c-.69.59-.2,1.59.79,1.59H12.86C13.85,6.79,14.34,5.79,13.65,5.2Z"
                                        transform="translate(-0.03 0)"></path>
                                    <path class="cls-1"
                                        d="M.35,10.8l5.87,4.93a1.26,1.26,0,0,0,1.56,0l5.87-4.93c.69-.59.2-1.59-.79-1.59H1.14C.15,9.21-.34,10.21.35,10.8Z"
                                        transform="translate(-0.03 0)"></path>
                                </svg></span>
                            <div style="display: inline-block; width: 90%; padding-left: 5px;"> প্রকাশ
                                : ২১ আগস্ট ২০২৫, ০৯:৩৬ পিএম</div>
                        </div>
                        <div class="edition"><i class="fa-solid fa-square-pen me-2"></i>অনলাইন সংস্করণ
                        </div>
                    </div>
                    <div id="related_news">
                        <style type="text/css">
                            .dtl_content_block {
                                text-align: left !important;
                            }

                            div.hl a {
                                font-size: 16px;
                                line-height: 20px;
                                color: #000;
                                font-weight: bold;
                            }

                            .more_dtl_news img.news_img {
                                height: 170px;
                                width: auto
                            }

                            .more_news_vedio {
                                position: absolute;
                                top: 32%;
                                left: 40%;
                            }

                            #morenews_content .more_dtl_news .news_headline {
                                font-size: 18px;
                                font-weight: bold;
                            }

                            .dtl_tags_news_title {
                                display: inline-block;
                                border-left: 5px solid #959595;
                                margin-top: 15px;
                                margin-bottom: 15px;
                                padding-left: 10px;
                            }

                            .more_dtl_news:hover .hl>a {
                                color: #0573e6 !important;
                            }

                            #related_news .flex-content .img-content {
                                width: 80px;
                            }

                            #related_news .sub-news h4.title {
                                font-size: 15px !important;
                            }

                            #related_news .sub-news:first-child .news-separator-horizontal-border {
                                border: none;
                            }
                        </style>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="dtl_tags_news_title"><a href="/"> এ সম্পর্কিত আরও খবর</a></div>
                                <div class="border-bottom mb-2"></div>
                            </div>
                        </div>
                        <div class="common-border-box">
                            <div class="selected-news ">
                                <div class="sub-news mb-3">
                                    <div class="news-separator-horizontal-border"></div>
                                    <div class="flex-content position-relative" id="flex-left-image">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-2">
                                                <a class="_link" href="#">
                                                    <div class="img-content position-relative text-center"><span
                                                            class="imgWrep"><img class="images img-fluid news_img detailImg"
                                                                src="https://www.kalbela.com/assets/news_photos/2025/08/22/image_215592_1755803929.webp"
                                                                title="" alt=""></span></div>
                                                </a>
                                            </div>
                                            <div class="flex-grow-1">
                                                <!-- <h4 class="title"></h4> -->
                                                <a class="_link" href="#">
                                                    <h4 class="title">
                                                        ধানের শীষের পক্ষে ঐক্যবদ্ধভাবে কাজ করার প্রতিশ্রুতি </h4>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sub-news mb-3">
                                    <div class="news-separator-horizontal-border"></div>
                                    <div class="flex-content position-relative" id="flex-left-image">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-2">
                                                <a class="_link" href="">
                                                    <div class="img-content position-relative text-center"><span
                                                            class="imgWrep"><img class="images img-fluid news_img detailImg"
                                                                src="https://www.kalbela.com/assets/news_photos/2025/08/22/image_215590_1755802824.webp"
                                                                title="" alt=""></span></div>
                                                </a>
                                            </div>
                                            <div class="flex-grow-1">
                                                <!-- <h4 class="title"></h4> -->
                                                <a class="_link" href="#">
                                                    <h4 class="title">
                                                        তারেক রহমান শিগগিরই দেশে ফিরবেন, নির্বাচনের পর প্রধানমন্ত্রীও হবেন :
                                                        এ্যানি </h4>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sub-news mb-3">
                                    <div class="news-separator-horizontal-border"></div>
                                    <div class="flex-content position-relative" id="flex-left-image">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-2">
                                                <a class="_link" href="#">
                                                    <div class="img-content position-relative text-center"><span
                                                            class="imgWrep"><img class="images img-fluid news_img detailImg"
                                                                src="https://www.kalbela.com/assets/news_photos/2025/08/21/image_215543_1755787524.webp"
                                                                title="" alt=""></span></div>
                                                </a>
                                            </div>
                                            <div class="flex-grow-1">
                                                <!-- <h4 class="title"></h4> -->
                                                <a class="_link" href="#">
                                                    <h4 class="title">
                                                        মানুষ ভাত পাচ্ছে না আর উপদেষ্টারা হাঁসের মাংস খুঁজতে বের হচ্ছেন :
                                                        আলাল </h4>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sub-news mb-3">
                                    <div class="news-separator-horizontal-border"></div>
                                    <div class="flex-content position-relative" id="flex-left-image">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-2">
                                                <a class="_link" href="#">
                                                    <div class="img-content position-relative text-center"><span
                                                            class="imgWrep"><img
                                                                class="images img-fluid news_img detailImg"
                                                                src="https://www.kalbela.com/assets/news_photos/2025/08/21/image_215536_1755785257.webp"
                                                                title="" alt=""></span></div>
                                                </a>
                                            </div>
                                            <div class="flex-grow-1">
                                                <!-- <h4 class="title"></h4> -->
                                                <a class="_link" href="#">
                                                    <h4 class="title">
                                                        একাত্তরকে ভুলিয়ে দেওয়ার ষড়যন্ত্র চলছে : মির্জা ফখরুল </h4>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="post-content">
                        <h1 class="title mb-3 fs-1 fs-bolder">
                            পানি খাওয়ার নাম করে শাম্মীর বাসায় ঢোকে অপু-রিয়াদ! গুলশানে চাঁদাবাজিতে দায় স্বীকার
                        </h1>
                        <div class="short-info mb-3"></div>
                        <div class="featured-img mb-3">
                            <img src="https://dailykhaboreralo.com/wp-content/uploads/2025/08/01-11.jpg" alt="">
                        </div>
                        <div id="content_area mb-3">
                            <p class="" style="text-align:justify; ">
                                আগামী নির্বাচনে বিএনপির বিজয় ঠেকাতে নানা চেষ্টা চলছে অভিযোগ করে সকলকে ঐক্যবদ্ধ ও সতর্ক থাকার
                                আহ্বান জানিয়েছেন বিএনপির ভারপ্রাপ্ত চেয়ারম্যান তারেক রহমান।
                                <br>
                                <br>
                                বৃহস্পতিবার (২১ আগস্ট) বিকেলে রাজধানীর রমনার ইঞ্জিনিয়ার্স ইনস্টিটিউশন মিলনায়তনে এক শুভেচ্ছা
                                বিনিময় অনুষ্ঠানে তিনি এ আহ্বান জানান। শুভ জন্মাষ্টমী উপলক্ষে বিএনপির উদ্যোগে হিন্দু
                                ধর্মাবলম্বীদের সাথে এই শুভেচ্ছা বিনিময় অনুষ্ঠান হয়।
                                <br>
                                <br>

                                বিএনপির ভারপ্রাপ্ত চেয়ারম্যান বলেন, বর্তমানে ফ্যাসিবাদমুক্ত বাংলাদেশেও কেউ কেউ মনে করছেন
                                নির্বাচন দিলে জনগণ ভোট দিয়ে বিএনপিকে সরকার গঠনে সহায়তা করবে। যারা এই চিন্তা থেকে বিএনপির
                                বিজয় ঠেকানোর জন্য নানা রকম অপকৌশলের বা শর্তের বেড়াজালের আশ্রয় নিচ্ছেন- তাদের দৃষ্টি আকর্ষণ
                                করে বলতে চাই, রাজনীতিকে রাজনীতি দিয়েই মোকাবিলা করুন। জনগণের শক্তির উপরে আস্থা এবং বিশ্বাস
                                রাখুন। বিএনপির বিজয় যদি জনগণ চায়, সেই বিজয় ঠেকাতে গিয়ে জনগণের রায় প্রদানের পথ রুদ্ধ করবেন
                                না।
                                <br>
                                <br>

                                তিনি বলেন, অবাধ, সুষ্ঠু এবং নিরপেক্ষ নির্বাচনে ভোট দেবার সুযোগ পেলে জনগণ বিএনপিকে রাষ্ট্র
                                পরিচালনার দায়িত্ব দিতে পারে। এই ভয়ে পলাতক স্বৈরাচার বিএনপির বিজয় ঠেকানোর মতোন অন্তর্ঘাতী
                                অপরাজনীতি চালু করেছিল। দেশের নির্বাচনী ব্যবস্থাকেও গত ১৬-১৭ বছর ধ্বংস করে দিয়েছিল। সেটি
                                লোকাল ইলেকশন থেকে শুরু করে জাতীয় নির্বাচনসহ প্রায় প্রত্যেকটি জায়গায় একই অবস্থা হয়েছিল। তবে
                                আশ্চর্যের বিষয় হলো, স্বৈরাচারমুক্ত বাংলাদেশে এবার ক্ষমতাসীন সরকার নয়, বরং ফ্যাসিবাদবিরোধী
                                আন্দোলনের রাজপথের সহযোদ্ধা কতিপয় রাজনৈতিক ব্যক্তি এবং গোষ্ঠীর আচরণেও সেই পলাতক স্বৈরাচার
                                সরকারের মতন বিএনপির বিজয় ঠেকানোর প্রবণতা লক্ষ করা যাচ্ছে। বিএনপির বিজয় ঠেকানোর অপরাজনীতি
                                করতে গিয়ে বিতাড়িত ফ্যাসিবাদী সরকার দেশকে একটি তাবেদারি রাষ্ট্রে, একটি বিশাল বড় জেলখানায়
                                পরিণত করেছিল।
                                <br>
                                <br>

                                নির্বাচনে বিএনপির বিজয় ঠেকাতে নানা চেষ্টা চলছে : তারেক রহমান
                                আগামী সরকারে থাকবেন কিনা জানালেন ড. ইউনূস
                                দেশের বর্তমান রাজনৈতিক ও আর্থ-সামাজিক পরিস্থিতিতে পিআর পদ্ধতিতে নির্বাচনের জন্য এখনো উপযোগী
                                নয় বলে মন্তব্য করেন তারেক রহমান। তিনি বলেন, আমরা জানি বিশ্বের অনেক দেশেই নির্বাচনে পিআর
                                পদ্ধতি রয়েছে। তবে বাংলাদেশের আর্থ-সামাজিক, ভৌগোলিক ও রাজনৈতিক পরিস্থিতিতে পিআর পদ্ধতিতে
                                নির্বাচনের জন্য এখনো উপযোগী নয় বলেই আমরা মনে করি। কাকে কিংবা কোন ব্যক্তিকে ভোট দিয়ে নিজেদের
                                প্রতিনিধি হিসেবে নির্বাচিত করে সংসদে পাঠানো হচ্ছে, অবশ্যই জনগণের সেটি জানার অধিকার রয়েছে।
                                কিন্তু প্রস্তাবিত পিআর পদ্ধতিতে কোন ব্যক্তিকে নির্বাচিত করা হচ্ছে, জনগণের সেটি জানার
                                পরিষ্কার কোনো সুযোগ নেই। যে কারণে রাজনৈতিক দল বা ব্যক্তি জাতীয় সংসদে কিংবা সরকারে
                                প্রতিনিধিত্ব করতে চাইলে অবশ্যই তাদেরকে জনগণের মুখোমুখি হয়ে, আস্থা-বিশ্বাস অর্জনের মাধ্যমে,
                                জনগণের রায় অর্জন করা জরুরি।
                                <br>

                                বিএনপির ভারপ্রাপ্ত চেয়ারম্যান আরও বলেন, পিআর পদ্ধতি এবং আরো দু-একটি ইস্যুতে গণতান্ত্রিক
                                রাজনৈতিক দলগুলোর মধ্যে কিছুটা ভিন্নমত রয়েছে। এই ধরনের ভিন্নমত গণতান্ত্রিক বিশ্বে স্বীকৃত।
                                এটি গণতন্ত্রের সৌন্দর্য। তবে বাস্তবতার নিরিখে প্রতিটি ইস্যুই সময়ের সঙ্গে সঙ্গে সুন্দরভাবে
                                সমাধান হয়ে যাবে বা সমাধান করা যাবে বলে আমি বিশ্বাস করি।
                                <br>
                                <br>

                                কয়েকটি রাজনৈতিক দলের উদ্দেশে তিনি বলেন, যারা আসন্ন নির্বাচনকে সামনে রেখে পরিস্থিতি ঘোলাটে
                                করার অপচেষ্টা করছেন, আপনারা হয়তো নিজেদের অজান্তেই গণতন্ত্রের উত্তরণের পথকে বাধাগ্রস্ত করে
                                তুলছেন। একই সঙ্গে পতিত পরাজিত পলাতক স্বৈরাচার পুনর্বাসনের পথও হয়তোবা সুগম হচ্ছে। যদি আমরা
                                গণতন্ত্র উত্তোরণের পথে শর্তের পর শর্ত আরোপ করতে থাকি, তাহলে পরাজিত শক্তি সুযোগ নেবে।
                                <br>

                                তারেক রহমান বলেন, বর্তমানে ফ্যাসিবাদমুক্ত বাংলাদেশে রাষ্ট্র এবং রাজনীতিতে জনগণের অধিকার
                                প্রতিষ্ঠার লক্ষ্যে অন্তর্বর্তীকালীন সরকার আগামী ফেব্রুয়ারি মাসে জাতীয় নির্বাচন অনুষ্ঠানের
                                সম্ভাব্য সময় নির্ধারণ করেছে। কিন্তু আমরা খেয়াল করে দেখছি, এই নির্বাচন অনুষ্ঠান নিয়ে কোনো
                                কোনো রাজনৈতিক ব্যক্তি বা গোষ্ঠীর বক্তব্য, মন্তব্য কিংবা নিত্য-নতুন শর্ত বা শর্তের প্রস্তাবনা
                                সামগ্রিকভাবে জনমনে বিভ্রান্তি সৃষ্টির কারণ হয়ে দাঁড়িয়েছে। অনুষ্ঠানে বিকেল সোয়া ৪টায় তারেক
                                রহমান লন্ডন থেকে ভার্চুয়ালি যুক্ত হলে হিন্দু ধর্মাবলম্বী মা-বোনেরা উলুধ্বনি এবং পুরুষেরা
                                ঢাক-ঢোল বাজিয়ে তাকে অভ্যর্থনা জানায়। এ সময় তারেক রহমান হাত নেড়ে এই অভিবাদনের জবাব দেন।
                                <br>
                                <br>

                                আগামী নির্বাচনে হিন্দু সম্প্রদায়ের সমর্থন কামনা করে বিএনপির ভারপ্রাপ্ত চেয়ারম্যান বলেন,
                                বর্তমান এবং ভবিষ্যৎ বাংলাদেশের জন্য, একটি নিরাপদ বাংলাদেশ প্রতিষ্ঠার জন্য আসন্ন জাতীয়
                                নির্বাচন আমাদের সামনে একটি বিশাল বড় সুযোগ। সারাদেশে হিন্দু ধর্মাবলম্বী ভাই ও বোনদের দৃষ্টি
                                আকর্ষণ করে বলতে চাই, আগামী নির্বাচনে বিএনপি আপনাদের সমর্থন এবং সক্রিয় সহযোগিতা চাই। আমি ও
                                বিএনপি বিশ্বাস করে, দল-মত, ধর্ম-দর্শন যার যার- রাষ্ট্র সবার; ধর্ম যার যার, কিন্তু নিরাপত্তা
                                পাবার অধিকার সবার।
                                <br>
                                <br>

                                তিনি বলেন, অতীতে দেখেছি- বিভিন্ন সময় দেশে যারা নিজেদেরকে সংখ্যালঘু সম্প্রদায় হিসেবে বিবেচনা
                                করেন, সেই সম্প্রদায়ের উপর কিংবা তাদের ধর্মীয় স্থাপনা অথবা বাসাবাড়িতে হামলার ঘটনা ঘটেছে। এই
                                ঘটনাগুলোকে যদি আমরা পর্যালোচনা করে দেখি, তবে দেখব- দু’একটি ব্যতিক্রম ছাড়া অধিকাংশ হামলার
                                ঘটনা কোনো ধর্মীয় কারণে হয়নি। বরং আমরা দেখেছি, প্রতিটি ঘটনা নিবিড়ভাবে তদন্ত করলে দেখা যাবে
                                অধিকাংশ হামলার ঘটনার নেপথ্য ছিল অসৎ রাজনৈতিক উদ্দেশ্য অথবা অবৈধ লোভ লাভের আশা। অবশ্য কোনো
                                কারণেই যাতে কারো ওপর কোনো হামলা কিংবা অবিচার না হয়, সেটি নিশ্চিত করা রাষ্ট্র এবং সরকারের
                                দায়িত্ব।
                                <br>

                                বিএনপি মহাসচিব মির্জা ফখরুল ইসলাম আলমগীরের সভাপতিত্বে এবং ধর্মবিষয়ক সহ-সম্পাদক অমলেন্দু দাস
                                অপুর সঞ্চালনায় এই অনুষ্ঠানে বিএনপির স্থায়ী কমিটির সদস্য গয়েশ্বর চন্দ্র রায়, ড. আব্দুল মঈন
                                খান, অধ্যাপক ডা. এজেডএম জাহিদ হোসেন, ভাইস চেয়ারম্যান নিতাই রায় চৌধুরী, চেয়ারপারসনের উপদেষ্টা
                                পরিষদের সদস্য ও বাংলাদেশ হিন্দু বৌদ্ধ খ্রিস্টান কল্যাণ ফ্রন্টের চেয়ারম্যান বিজন কান্তি
                                সরকার, ধর্মবিষয়ক সম্পাদক রফিকুল ইসলাম জামাল, সহ-সাংগঠনিক সম্পাদক জয়ন্ত কুমার কুন্ডু,
                                প্রান্তিক জনশক্তি উন্নয়ন বিষয়ক সহ-সম্পাদক ও বাংলাদেশ পূজা উদযাপন ফ্রন্টের সভাপতি অপর্ণা রায়
                                দাস, নির্বাহী কমিটির সদস্য রমেশ দত্ত, দেবাশীষ রায় মধু, নিপুণ রায় চৌধুরী, হিন্দু ধর্মীয়
                                ট্রাস্টের ভাইস চেয়ারম্যান তপন চন্দ্র মজুমদার, হিন্দু বৌদ্ধ খ্রিস্টান কল্যাণ ফ্রন্টের মহাসচিব
                                তরুণ দে, বাংলাদেশ পূজা উদযাপন পরিষদের সভাপতি বাসুদেব ধর, মহানগর সার্বজনীন পূজা কমিটির সভাপতি
                                জয়ন্ত কুমার দেব, ঢাকেশ্বরী জাতীয় মন্দির পরিচালনা কমিটির ভারপ্রাপ্ত সভাপতি অ্যাডভোকেট সুব্রত
                                চৌধুরী, ইসকন বাংলাদেশের প্রভু বিমলা প্রসাদ, কল্যাণ ফ্রন্টের মিল্টন বৈদ্য, পূজা উদযাপন
                                ফ্রন্টের জয়দেব রায় জয়, জাতীয় হিন্দু মহাজোটের একাংশের সুশান্ত চক্রবর্তী প্রমুখ বক্তব্য রাখেন।
                                <br>
                                <br>

                                অনুষ্ঠানে বিএনপি চেয়ারপারসনের একান্ত সচিব এবিএম আব্দুস সাত্তার, দলের যুগ্ম মহাসচিব আবদুস
                                সালাম আজাদ, কেন্দ্রীয় নেতা আবদুল বারী ড্যানি, জন গোমেজ, সুশীল বড়ুয়া, বাংলাদেশ পূজা উদযাপন
                                ফ্রন্টের সাধারণ সম্পাদক সমীর কুমার বসু প্রমুখ উপস্থিত ছিলেন।
                                <br>

                                শুভেচ্ছা বিনিময় অনুষ্ঠানে ঢাকাসহ দেশের বিভিন্ন জেলা থেকে আসা হিন্দু বৌদ্ধ খ্রিস্টান কল্যাণ
                                ফ্রন্ট এবং বাংলাদেশ পূজা উদযাপন ফ্রন্টের প্রতিনিধিরা অংশগ্রহণ করেন।
                            </p>
                        </div>
                        <div class="tags mb-3 mt-2">
                            <ul class="text-start ps-0">
                     <a href="#" class="px-3 py-1 border border-secondary me-1 d-inline-block">tags</a>
                     <a href="#" class="px-3 py-1 border border-secondary me-1 d-inline-block">tags</a>
                     <a href="#" class="px-3 py-1 border border-secondary me-1 d-inline-block">tags</a>
                             
                            </ul>
                           
                        </div>

                    </div>
                    <div class="ad bg-dark bg-opacity-50 d-flex justify-content-center align-items-center mb-3"
                        style="height: 100px">
                        <span class="text-danger fs-3">For Ad</span>
                    </div>
                    <div class="comment-box">
                        <div class="heading text-primary">
                            <h4>মন্তব্য করুন</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                     <div class="ad bg-dark bg-opacity-50 d-flex justify-content-center align-items-center mb-3" style="height: 400px">
                <span class="text-danger fs-3">For Ad 1</span>
            </div>
             <div class="ad bg-dark bg-opacity-50 d-flex justify-content-center align-items-center mb-3" style="height: 400px">
                <span class="text-danger fs-3">For Ad 2</span>
            </div>
                </div>
            </div>
        </div>
    </section>
@endsection
