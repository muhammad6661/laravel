@extends('layouts.front')
@section('title',Lang::get('main.contact'))

@section('content')
@section('contact','active')
<div id="ban">
    <div class="image_wrapper" >
        <div class="container h-100 d-flex align-items-center">
            <div class="">
                <img src="/public/uploads/banners/{{$page->image}}" width="64px" height="64px">
            </div>
            <h1>@lang('main.contact')</h1>
        </div>
    </div>
</div>
<main>

    <div class="container mt-5 contacts">
        <div class="row">
            <div class="col-md-6">
                <div class="contacts_wrapper">
                    <div class="contact_item">
                            <div>
                                <svg width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="90" height="90" fill="#E8F9FD" />
                                    <path d="M58.5 42C58.5 52.5 45 61.5 45 61.5C45 61.5 31.5 52.5 31.5 42C31.5 38.4196 32.9223 34.9858 35.4541 32.4541C37.9858 29.9223 41.4196 28.5 45 28.5C48.5804 28.5 52.0142 29.9223 54.5459 32.4541C57.0777 34.9858 58.5 38.4196 58.5 42Z" stroke="#0032A4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M45 46.5C47.4853 46.5 49.5 44.4853 49.5 42C49.5 39.5147 47.4853 37.5 45 37.5C42.5147 37.5 40.5 39.5147 40.5 42C40.5 44.4853 42.5147 46.5 45 46.5Z" stroke="#0032A4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="text_wrapper">
                                <h6>@lang('main.address')</h6>
                                <p>{{\App\LocalValue::getValue($setting->address_tj,$setting->address_ru,$setting->address_en)}}</p>
                            </div>
                    </div>
                    <div class="contact_item">
                            <div>
                                <svg width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="90" height="90" fill="#E8F9FD" />
                                    <path d="M61.5 37.5V28.5H52.5" stroke="#0032A4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M51 39L61.5 28.5" stroke="#0032A4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M60.0001 52.38V56.88C60.0018 57.2978 59.9163 57.7113 59.7489 58.094C59.5816 58.4768 59.3361 58.8204 59.0283 59.1028C58.7204 59.3852 58.357 59.6003 57.9613 59.7341C57.5655 59.8679 57.1462 59.9176 56.7301 59.88C52.1144 59.3785 47.6806 57.8012 43.7851 55.275C40.1609 52.972 37.0881 49.8993 34.7851 46.275C32.2501 42.3618 30.6725 37.9065 30.1801 33.27C30.1427 32.8552 30.192 32.4372 30.3249 32.0425C30.4578 31.6478 30.6715 31.2851 30.9523 30.9775C31.2331 30.6699 31.5749 30.4241 31.9558 30.2558C32.3368 30.0875 32.7487 30.0004 33.1651 30H37.6651C38.3931 29.9929 39.0988 30.2506 39.6508 30.7253C40.2027 31.2 40.5633 31.8592 40.6651 32.58C40.8551 34.0201 41.2073 35.4341 41.7151 36.795C41.917 37.3319 41.9606 37.9154 41.841 38.4763C41.7214 39.0373 41.4434 39.5522 41.0401 39.96L39.1351 41.865C41.2705 45.6203 44.3798 48.7297 48.1351 50.865L50.0401 48.96C50.448 48.5567 50.9629 48.2788 51.5238 48.1592C52.0848 48.0395 52.6683 48.0832 53.2051 48.285C54.5661 48.7929 55.98 49.1451 57.4201 49.335C58.1488 49.4378 58.8142 49.8048 59.2899 50.3663C59.7656 50.9277 60.0184 51.6444 60.0001 52.38Z" stroke="#0032A4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="text_wrapper">
                                <h6>@lang('main.phone')</h6>
                                <p>{{$setting->phone}}</p>
                            </div>
                    </div>
                    <div class="contact_item">
                            <div>
                                <svg width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="90" height="90" fill="#E8F9FD" />
                                    <path d="M33 33H57C58.65 33 60 34.35 60 36V54C60 55.65 58.65 57 57 57H33C31.35 57 30 55.65 30 54V36C30 34.35 31.35 33 33 33Z" stroke="#0032A4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M60 36L45 46.5L30 36" stroke="#0032A4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="text_wrapper">
                                <h6>@lang('main.email')</h6>
                                <p>{{$setting->email}}</p>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-md-0 mt-4">
                <div class="map">
                    <div class="icon_map_wrapper">
                        <img src="images/icons/map.svg" alt="">
                    </div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1102.7682269122167!2d68.78916430523529!3d38.57755495084383!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38b5d15e56df5a5d%3A0x249cfddb241d2b3f!2z0YPQuy4g0JHQvtGF0YLQsNGAIDM3LCDQlNGD0YjQsNC90LHQtSwg0KLQsNC00LbQuNC60LjRgdGC0LDQvQ!5e0!3m2!1sru!2s!4v1624442107618!5m2!1sru!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" class="w-100 h-100"></iframe>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
