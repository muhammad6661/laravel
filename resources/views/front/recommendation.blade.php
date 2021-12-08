@extends('layouts.front')
@section('title',Lang::get('main.recomend'))
@section('content')
@section('recomend','active')
@section('about','active')

<div id="ban">
    <div class="image_wrapper">
        <div class="container h-100 d-flex align-items-center">
            <div class="">
                <img src="/public/uploads/banners/{{$page->image}}" width="64px" height="64px">
            </div>
            <h1> @lang('main.recomend') </h1>
        </div>
    </div>
</div>
<main>
    <div class="container mt-5 doc">
        <p>{!! \App\LocalValue::getValue($page->description_tj,$page->description_ru,$page->description_en)!!}</p>
    </div>
</main>

@endsection



