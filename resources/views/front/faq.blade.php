@extends('layouts.front')
@section('title',Lang::get('main.faqs'))
@section('content')
@section('faqs','active')
@section('about','active')

<div id="ban">
    <div class="image_wrapper">
        <div class="container h-100 d-flex align-items-center">
            <div class="">
                <img src="/public/uploads/banners/{{$page->image}}" width="64px" height="64px">
            </div>
            <h1> @lang('main.faqs') </h1>
        </div>
    </div>
</div>
<main>
    <div class="container mt-5 questions">
        <div class="questions_wrapper mt-5 pt-5">

            @foreach ($faqs as $faq)
            <div class="question_item">
                <div class="question_header">
                    <h3>{{\App\LocalValue::getValue($faq->question_tj,$faq->question_ru,$faq->question_en)}}</h3>
                    <div class="rotate-0 toggler_ic">
                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 16L18 22L24 16" stroke="#2A9DF4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <circle cx="18" cy="18" r="17" stroke="#2A9DF4" stroke-width="2"/>
                        </svg>
                    </div>
                </div>
                <div class="question_body d-none animate__animated animate__fadeIn">
                    <p>{!!\App\LocalValue::getValue($faq->answer_tj,$faq->answer_ru,$faq->answer_en)!!}</p>
                 </div>
            </div>

            @endforeach
        </div>
    </div>
</main>




@endsection


