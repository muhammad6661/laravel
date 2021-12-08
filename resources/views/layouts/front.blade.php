<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- css mastermix -->
    <link rel="shortcut icon" href="/public/pbo-eiti.ico">
    <link rel="stylesheet" href="/public/front/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/front/css/animate.css">
    <link rel="stylesheet" href="/public/front/css/style.css">
    <link rel="stylesheet" href="/public/front/css/media.css">
    @yield('stayles')
    <!-- css mastermix -->
    <!-- font  -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- font -->
</head>

<body>

    <div class="wrapper">
        <header id="header">
            <div class="header_info">
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-9 col-md-8  col-12">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="contacts">

                                    <a target="_blank" href="mailto:info@bop-eiti.tj">{{$setting->email}}</a>
                                </div>
                                <div class="scial_icons">
                                    <a target="_blank" href="{{$setting->link_instagram}}">
                                        <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.9581 2.75H5.65256C4.05094 2.75 2.82617 3.94167 2.82617 5.5V16.5C2.82617 18.0583 4.05094 19.25 5.65256 19.25H16.9581C18.5597 19.25 19.7845 18.0583 19.7845 16.5V5.5C19.7845 3.94167 18.5597 2.75 16.9581 2.75ZM11.3053 8.25C12.907 8.25 14.1317 9.44167 14.1317 11C14.1317 12.5583 12.907 13.75 11.3053 13.75C9.70372 13.75 8.47895 12.5583 8.47895 11C8.47895 9.44167 9.70372 8.25 11.3053 8.25ZM14.8854 6.41667C14.8854 5.775 15.4507 5.31667 16.016 5.31667C16.5813 5.31667 17.1465 5.86667 17.1465 6.41667C17.1465 6.96667 16.6755 7.51667 16.016 7.51667C15.3565 7.51667 14.8854 7.05833 14.8854 6.41667ZM16.9581 17.4167H5.65256C5.08728 17.4167 4.71043 17.05 4.71043 16.5V11H6.59469C6.59469 13.5667 8.66738 15.5833 11.3053 15.5833C13.9433 15.5833 16.016 13.5667 16.016 11H17.9002V16.5C17.9002 17.05 17.5234 17.4167 16.9581 17.4167Z" fill="#262626" fill-opacity="0.5" />
                                        </svg>
                                    </a>
                                    <a target="_blank" href="{{$setting->link_facebook}}">
                                        <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.392 20.0443H13.7045V12.0143H16.4744L16.8927 8.89034H13.7045V6.88834C13.7045 5.98634 13.9646 5.37034 15.2986 5.37034H17.0058V2.56534C16.7118 2.53234 15.7056 2.44434 14.5298 2.44434C12.0652 2.44434 10.392 3.90734 10.392 6.58034V8.89034H7.61084V12.0143H10.392V20.0443Z" fill="#262626" fill-opacity="0.5" />
                                        </svg>
                                    </a>
                                    <a target="_blank" href="{{$setting->link_telegram}}">
                                        <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.38076 17.096L9.64455 13.2185L16.8801 6.87517C17.2004 6.59101 16.8142 6.45351 16.3902 6.70101L7.45881 12.1918L3.59608 11.0002C2.76701 10.771 2.75759 10.2118 3.78451 9.80851L18.8303 4.16184C19.5181 3.85934 20.1776 4.32684 19.9138 5.35351L17.3512 17.096C17.1722 17.9302 16.654 18.1318 15.938 17.7468L12.0376 14.9418L10.1627 16.711C9.94603 16.9218 9.76703 17.096 9.38076 17.096Z" fill="#262626" fill-opacity="0.5" />
                                        </svg>
                                    </a>
                                    <a target="_blank" href="{{$setting->link_youtube}}">
                                        <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.6665 2.75H9.71263L9.07669 5.12188L8.44076 2.75H7.38086C7.59284 3.36875 7.80482 3.88437 8.0168 4.50313C8.33477 5.32812 8.54674 6.05 8.54674 6.4625V8.9375H9.50065V6.4625L10.6665 2.75ZM13.2103 7.39062V5.84375C13.2103 5.32812 13.1043 5.01875 12.8923 4.70938C12.6803 4.4 12.3624 4.29688 11.9384 4.29688C11.5145 4.29688 11.1965 4.50312 10.9845 4.8125C10.7725 5.01875 10.6665 5.32812 10.6665 5.84375V7.49375C10.6665 8.00938 10.7725 8.31875 10.9845 8.525C11.1965 8.83437 11.5145 8.9375 11.9384 8.9375C12.3624 8.9375 12.6803 8.73125 12.8923 8.42188C13.1043 8.31875 13.2103 7.90625 13.2103 7.39062ZM12.3624 7.59687C12.3624 8.00937 12.2564 8.21563 11.9384 8.21563C11.6204 8.21563 11.5145 8.00937 11.5145 7.59687V5.6375C11.5145 5.225 11.6204 5.01875 11.9384 5.01875C12.2564 5.01875 12.3624 5.225 12.3624 5.6375V7.59687ZM16.39 8.9375V4.29688H15.5421V7.80312C15.3301 8.1125 15.2241 8.21563 15.0121 8.21563C14.9061 8.21563 14.8001 8.1125 14.8001 8.00938V4.29688H13.9522V7.90625C13.9522 8.21562 13.9522 8.42188 14.0582 8.62812C14.0582 8.83437 14.2702 8.9375 14.5882 8.9375C14.9061 8.9375 15.2241 8.73125 15.5421 8.42188V8.9375H16.39Z" fill="#262626" fill-opacity="0.5" />
                                            <path d="M16.8141 13.5781C16.4961 13.5781 16.3901 13.7844 16.3901 14.1969V14.6094H17.2381V14.1969C17.2381 13.7844 17.1321 13.5781 16.8141 13.5781Z" fill="#262626" fill-opacity="0.5" />
                                            <path d="M13.7399 13.5781C13.6339 13.5781 13.4219 13.6812 13.3159 13.7844V16.5688C13.4219 16.6719 13.6339 16.775 13.7399 16.775C13.9519 16.775 14.0578 16.5688 14.0578 16.1563V14.1969C14.0578 13.7844 13.9519 13.5781 13.7399 13.5781Z" fill="#262626" fill-opacity="0.5" />
                                            <path d="M18.9339 11.3093C18.7219 10.5875 18.086 9.9687 17.4501 9.9687C15.7542 9.76245 13.9524 9.76245 12.1506 9.76245C10.3488 9.76245 8.65293 9.76245 6.85111 9.9687C6.21517 9.9687 5.57923 10.5875 5.36725 11.3093C5.15527 12.3406 5.15527 13.4749 5.15527 14.5062C5.15527 15.5374 5.15527 16.6718 5.36725 17.7031C5.57923 18.4249 6.10918 18.9406 6.85111 19.0437C8.65293 19.2499 10.3488 19.2499 12.1506 19.2499C13.9524 19.2499 15.6482 19.2499 17.4501 19.0437C18.192 18.9406 18.8279 18.4249 18.9339 17.7031C19.1459 16.6718 19.1459 15.5374 19.1459 14.5062C19.1459 13.4749 19.1459 12.3406 18.9339 11.3093ZM9.18288 12.2374H8.12298V17.4968H7.16908V12.2374H6.21517V11.3093H9.18288V12.2374ZM11.7266 17.4968H10.8787V16.9812C10.5607 17.3937 10.2428 17.4968 9.9248 17.4968C9.60684 17.4968 9.50085 17.3937 9.39486 17.1874C9.39486 17.0843 9.28887 16.8781 9.28887 16.4656V12.8562H10.1368V16.4656C10.1368 16.5687 10.2428 16.6718 10.3488 16.6718C10.5607 16.6718 10.6667 16.5687 10.8787 16.2593V12.8562H11.7266V17.4968ZM14.9063 16.0531C14.9063 16.4656 14.9063 16.7749 14.8003 16.9812C14.6943 17.2906 14.4824 17.4968 14.1644 17.4968C13.8464 17.4968 13.5285 17.2906 13.3165 16.9812V17.3937H12.4686V11.3093H13.3165V13.2687C13.6344 12.9593 13.8464 12.7531 14.1644 12.7531C14.4824 12.7531 14.6943 12.9593 14.8003 13.2687C14.9063 13.4749 14.9063 13.7843 14.9063 14.1968V16.0531ZM18.086 15.3312H16.3902V16.1562C16.3902 16.5687 16.4962 16.7749 16.8141 16.7749C17.0261 16.7749 17.1321 16.6718 17.2381 16.4656V15.9499H18.086V16.5687C18.086 16.7749 17.98 16.8781 17.874 17.0843C17.662 17.3937 17.3441 17.5999 16.8141 17.5999C16.3902 17.5999 16.0722 17.3937 15.7542 17.0843C15.5423 16.8781 15.4363 16.4656 15.4363 16.0531V14.5062C15.4363 13.9906 15.5423 13.6812 15.6482 13.4749C15.8602 13.1656 16.1782 12.9593 16.7081 12.9593C17.1321 12.9593 17.4501 13.1656 17.662 13.4749C17.874 13.6812 17.874 14.0937 17.874 14.5062V15.3312H18.086Z" fill="#262626" fill-opacity="0.5" />
                                        </svg>
                                    </a>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-12 mt-md-0 mt-3">
                            <div class="d-flex justify-content-md-end">
                                <div class="lange_wrapper">
                                    <a href="/local/tj" class="lange_item {{App::getLocale()=='tj' ? 'active' : ''}}">Тоҷ</a>
                                    <a href="/local/ru" class="lange_item {{App::getLocale()=='ru' ? 'active' : ''}}">Рус </a>
                                    <a href="/local/en" class="lange_item {{App::getLocale()=='en' ? 'active' : ''}}">Eng</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header_nav">
                <div class="container">
                    <nav class="navbar navbar-expand-lg navbar-light p-0">
                        <a class="navbar-brand" href="/">
                            <img src="/public/front/images/{{\App\LocalValue::getValue('logo_taj.svg','logo_rus.svg','logo_eng.svg')}}" alt="">
                        </a>
                        <button class="navbar-toggler" id="nav-icon2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <div class="d-flex justify-content-lg-end justify-content-start w-100 py-4" style="margin-right: -8px;margin-left:10px">
                                <ul class="navbar-nav" style="justify-content: end;">
                                    <li class="nav-item @yield('home')">
                                        <a class="nav-link" href="/">@lang('main.home')</a>
                                    </li>
                                    <li class="nav-item dropdown @yield('about')">
                                        <a class="nav-link " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span>@lang('main.about_portal')</span>
                                            <span class="pb-1">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="   http://www.w3.org/2000/svg">
                                                    <path d="M5 7.5L10 12.5L15 7.5" stroke="#262626" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="z-index: 9999;">
                                            <a class="dropdown-item @yield('standart')" href="/eiti-standard">@lang('main.standart')</a>
                                            <a class="dropdown-item @yield('repoats')" href="/otchyetii-ipdo-tadzheekeestana">@lang('main.reports_eiti')</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown @yield('normative')">
                                    <a class="nav-link " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                        <span>@lang('main.normative')</span>
                                            <span class="pb-1">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="   http://www.w3.org/2000/svg">
                                                    <path d="M5 7.5L10 12.5L15 7.5" stroke="#262626" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                    </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="z-index: 9999;">
                                                @foreach ($sections as $item)
                                            <a class="dropdown-item @yield($item->slug)" href="/normativnye-dokumenty/{{$item->slug}}">{{\App\LocalValue::getValue($item->title_tj,$item->title_ru,$item->title_en)}}</a>
                                            @endforeach

                                        </div>
                                    </li>



                                    <li class="nav-item @yield('contact')">
                                        <a class="nav-link" href="/appeal">@lang('main.contact')</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </nav>
                </div>
            </div>
        </header>
            @yield('content')
        <footer>
            <div class="container">
                <div class="logo_wrapper col-lg-12 d-flex  justify-content-between" style="padding-left: 0px;">
                    <div class="h-100 col-lg-8 pl-0">
                        <img src="/public/front/images/{{\App\LocalValue::getValue('log_taj.svg','log_rus.svg','log_eng.svg')}}" alt="">
                    </div>

                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="h-100 d-flex flex-column justify-content-between align-items-between">

                            <div class="social_icons  px-1" style="margin-top: 36px;">
                                <a href="{{$setting->link_instagram}}">
                                    <svg width="37" height="36" viewBox="0 0 37 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M27.75 4.5H9.25C6.62917 4.5 4.625 6.45 4.625 9V27C4.625 29.55 6.62917 31.5 9.25 31.5H27.75C30.3708 31.5 32.375 29.55 32.375 27V9C32.375 6.45 30.3708 4.5 27.75 4.5ZM18.5 13.5C21.1208 13.5 23.125 15.45 23.125 18C23.125 20.55 21.1208 22.5 18.5 22.5C15.8792 22.5 13.875 20.55 13.875 18C13.875 15.45 15.8792 13.5 18.5 13.5ZM24.3583 10.5C24.3583 9.45 25.2833 8.7 26.2083 8.7C27.1333 8.7 28.0583 9.6 28.0583 10.5C28.0583 11.4 27.2875 12.3 26.2083 12.3C25.1292 12.3 24.3583 11.55 24.3583 10.5ZM27.75 28.5H9.25C8.325 28.5 7.70833 27.9 7.70833 27V18H10.7917C10.7917 22.2 14.1833 25.5 18.5 25.5C22.8167 25.5 26.2083 22.2 26.2083 18H29.2917V27C29.2917 27.9 28.675 28.5 27.75 28.5Z" fill="#FEFEFE" />
                                    </svg>
                                </a>
                                <a href="{{$setting->link_facebook}}">
                                    <svg width="37" height="36" viewBox="0 0 37 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.551 32.7999H20.9715V19.6599H25.504L26.1885 14.5479H20.9715V11.2719C20.9715 9.79594 21.397 8.78794 23.58 8.78794H26.3735V4.19794C25.8925 4.14394 24.246 3.99994 22.322 3.99994C18.289 3.99994 15.551 6.39394 15.551 10.7679V14.5479H11V19.6599H15.551V32.7999Z" fill="#FEFEFE" />
                                    </svg>
                                </a>
                                <a href="{{$setting->link_telegram}}">
                                    <svg width="37" height="36" viewBox="0 0 37 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.0777 27.9752L15.5094 21.6302L27.3494 11.2502C27.8736 10.7852 27.2415 10.5602 26.5477 10.9652L11.9327 19.9502L5.6119 18.0002C4.25524 17.6252 4.23982 16.7102 5.92024 16.0502L30.5407 6.8102C31.6661 6.3152 32.7452 7.0802 32.3136 8.7602L28.1202 27.9752C27.8273 29.3402 26.9794 29.6702 25.8077 29.0402L19.4252 24.4502L16.3573 27.3452C16.0027 27.6902 15.7098 27.9752 15.0777 27.9752Z" fill="#FEFEFE" />
                                    </svg>
                                </a>
                                <a href="{{$setting->link_youtube}}">
                                    <svg width="37" height="36" viewBox="0 0 37 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.7271 4.5H15.1662L14.1256 8.38125L13.085 4.5H11.3506C11.6975 5.5125 12.0443 6.35625 12.3912 7.36875C12.9115 8.71875 13.2584 9.9 13.2584 10.575V14.625H14.8193V10.575L16.7271 4.5ZM20.8896 12.0938V9.5625C20.8896 8.71875 20.7162 8.2125 20.3693 7.70625C20.0225 7.2 19.5021 7.03125 18.8084 7.03125C18.1146 7.03125 17.5943 7.36875 17.2475 7.875C16.9006 8.2125 16.7271 8.71875 16.7271 9.5625V12.2625C16.7271 13.1062 16.9006 13.6125 17.2475 13.95C17.5943 14.4563 18.1146 14.625 18.8084 14.625C19.5021 14.625 20.0225 14.2875 20.3693 13.7812C20.7162 13.6125 20.8896 12.9375 20.8896 12.0938ZM19.5021 12.4312C19.5021 13.1062 19.3287 13.4438 18.8084 13.4438C18.2881 13.4438 18.1146 13.1062 18.1146 12.4312V9.225C18.1146 8.55 18.2881 8.2125 18.8084 8.2125C19.3287 8.2125 19.5021 8.55 19.5021 9.225V12.4312ZM26.0928 14.625V7.03125H24.7053V12.7688C24.3584 13.275 24.185 13.4438 23.8381 13.4438C23.6646 13.4438 23.4912 13.275 23.4912 13.1062V7.03125H22.1037V12.9375C22.1037 13.4438 22.1037 13.7812 22.2772 14.1187C22.2772 14.4562 22.624 14.625 23.1443 14.625C23.6647 14.625 24.185 14.2875 24.7053 13.7812V14.625H26.0928Z" fill="#FEFEFE" />
                                        <path d="M26.7865 22.2188C26.2662 22.2188 26.0928 22.5563 26.0928 23.2313V23.9062H27.4803V23.2313C27.4803 22.5563 27.3068 22.2188 26.7865 22.2188Z" fill="#FEFEFE" />
                                        <path d="M21.7562 22.2188C21.5828 22.2188 21.2359 22.3875 21.0625 22.5562V27.1125C21.2359 27.2812 21.5828 27.45 21.7562 27.45C22.1031 27.45 22.2766 27.1125 22.2766 26.4375V23.2313C22.2766 22.5563 22.1031 22.2188 21.7562 22.2188Z" fill="#FEFEFE" />
                                        <path d="M30.2554 18.5062C29.9085 17.3249 28.8679 16.3124 27.8272 16.3124C25.0522 15.9749 22.1038 15.9749 19.1554 15.9749C16.2069 15.9749 13.4319 15.9749 10.4835 16.3124C9.44287 16.3124 8.40225 17.3249 8.05537 18.5062C7.7085 20.1937 7.7085 22.0499 7.7085 23.7374C7.7085 25.4249 7.7085 27.2812 8.05537 28.9687C8.40225 30.1499 9.26943 30.9937 10.4835 31.1624C13.4319 31.4999 16.2069 31.4999 19.1554 31.4999C22.1038 31.4999 24.8788 31.4999 27.8272 31.1624C29.0413 30.9937 30.0819 30.1499 30.2554 28.9687C30.6022 27.2812 30.6022 25.4249 30.6022 23.7374C30.6022 22.0499 30.6022 20.1937 30.2554 18.5062ZM14.2991 20.0249H12.5647V28.6312H11.0038V20.0249H9.44287V18.5062H14.2991V20.0249ZM18.4616 28.6312H17.0741V27.7874C16.5538 28.4624 16.0335 28.6312 15.5132 28.6312C14.9929 28.6312 14.8194 28.4624 14.646 28.1249C14.646 27.9562 14.4726 27.6187 14.4726 26.9437V21.0374H15.8601V26.9437C15.8601 27.1124 16.0335 27.2812 16.2069 27.2812C16.5538 27.2812 16.7272 27.1124 17.0741 26.6062V21.0374H18.4616V28.6312ZM23.6647 26.2687C23.6647 26.9437 23.6647 27.4499 23.4913 27.7874C23.3179 28.2937 22.971 28.6312 22.4507 28.6312C21.9304 28.6312 21.4101 28.2937 21.0632 27.7874V28.4624H19.6757V18.5062H21.0632V21.7124C21.5835 21.2062 21.9304 20.8687 22.4507 20.8687C22.971 20.8687 23.3179 21.2062 23.4913 21.7124C23.6647 22.0499 23.6647 22.5562 23.6647 23.2312V26.2687ZM28.8679 25.0874H26.0929V26.4374C26.0929 27.1124 26.2663 27.4499 26.7866 27.4499C27.1335 27.4499 27.3069 27.2812 27.4804 26.9437V26.0999H28.8679V27.1124C28.8679 27.4499 28.6944 27.6187 28.521 27.9562C28.1741 28.4624 27.6538 28.7999 26.7866 28.7999C26.0929 28.7999 25.5726 28.4624 25.0522 27.9562C24.7054 27.6187 24.5319 26.9437 24.5319 26.2687V23.7374C24.5319 22.8937 24.7054 22.3874 24.8788 22.0499C25.2257 21.5437 25.746 21.2062 26.6132 21.2062C27.3069 21.2062 27.8272 21.5437 28.1741 22.0499C28.521 22.3874 28.521 23.0624 28.521 23.7374V25.0874H28.8679Z" fill="#FEFEFE" />
                                    </svg>
                                </a>
                            </div>
                            <h6 class="development  d-lg-block ml-2" style="font-size: 14px;">@lang('main.gravity_studio')<a style="font-size: 13px;" href="gravity.studio">Gravity Studio</a></h6>
                            <a  href="/card" class="development mb-3 d-lg-block ml-2" style="line-height:20px;">@lang('main.card') </a>

                        </div>

                    </div>
                </div>
                <div class="row ">
                    <div class="col-lg-7 col-sm-6 col-12">
                        <div class="h-100 d-flex flex-column justify-content-between">
                            <ul class="">
                                <li> </li>
                            @php
                                $title_ru = 'Воспроизведение или распространение указанных материалов в любой форме может производиться только с письменного разрешения правообладателя. При использовании ссылка на правообладателя и источник заимствования обязательна';
                                $title_tj = 'Нашри дубора ё паҳн кардани ин мавод дар ҳама гуна шакл танҳо бо иҷозати хаттии дорандаи ҳуқуқи муаллиф мумкин аст. Ҳангоми истифодаи истинод ба дорандаи ҳуқуқи муаллиф ва манбаи қарз талаб карда мешавад.';
                                $title_en = 'Reproduction or distribution of these materials in any form may be made only with the written permission of the copyright holder. When using a link to the copyright holder and the source of borrowing is required.'
                                @endphp
                                <li><p>{{\App\LocalValue::getValue($title_tj,$title_ru,$title_en)}}</p></li>

                            </ul>
                            <h6 class="development mb-3 d-lg-block">{{\App\LocalValue::getValue('Ҳамаи ҳуқуқҳо ҳифз шудаанд © 2021.','Все права защищены © 2021.','All rights reserved © 2021.')}}</h6>

                        </div>

                    </div>

                </div>
            </div>
        </footer>
    </div>
    <script src="/public/front/js/jquary.js"></script>
    <script src="/public/front/js/popper.min.js"></script>
    <script src="/public/front/js/bootstrap.min.js"></script>
    <script src="/public/front/js/wow.min.js"></script>

    <script src="/public/front/js/app.js"></script>
    @yield('scripts')
</body>

</html>
