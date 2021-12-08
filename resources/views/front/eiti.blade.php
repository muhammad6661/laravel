@extends('layouts.front')
@section('title',Lang::get('main.eiti'))
@section('content')
@section('eiti','active')
@section('about','active')

<div id="ban">
    <div class="image_wrapper">
        <div class="container h-100 d-flex align-items-center">
            <div class="">
                <img src="/public/uploads/banners/{{$eiti->image}}" width="64px" height="64px">
            </div>
            <h1> @lang('main.eiti') </h1>
        </div>
    </div>
</div>
<main>
    <div class="container mt-5 ipdo">
        <div class="text_wrapper">
        <p>{!! \App\LocalValue::getValue($eiti->description_tj,$eiti->description_ru,$eiti->description_en)!!}</p>
        </div>
    </div>
</main>
@endsection
