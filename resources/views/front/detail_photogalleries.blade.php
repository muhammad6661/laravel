@extends('layouts.front')
@section('title',\App\LocalValue::getValue($photo->title_tj,$photo->title_ru,$photo->title_en))
@section('photo','active')
@section('gallery','active')
@section('content')
<div id="ban">
    <div class="image_wrapper">
        <div class="container h-100 d-flex align-items-center">
            <div class="">
                <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M50.6667 8H13.3333C10.3878 8 8 10.3878 8 13.3333V50.6667C8 53.6122 10.3878 56 13.3333 56H50.6667C53.6122 56 56 53.6122 56 50.6667V13.3333C56 10.3878 53.6122 8 50.6667 8Z" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M22.666 26.6666C24.8752 26.6666 26.666 24.8758 26.666 22.6666C26.666 20.4575 24.8752 18.6666 22.666 18.6666C20.4569 18.6666 18.666 20.4575 18.666 22.6666C18.666 24.8758 20.4569 26.6666 22.666 26.6666Z" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M56.0007 40L42.6673 26.6666L13.334 56" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <h1>@lang('main.photogallery')</h1>
        </div>
    </div>
</div>
<main>
    <div class="container mt-5 fotos_detiled">
        <h2>{{\App\LocalValue::getValue($photo->title_tj,$photo->title_ru,$photo->title_en)}}</h2>
        <small>{{\Carbon\Carbon::parse($photo->date)->isoFormat('D MMMM YYYY')}}</small>
        <p>{{\App\LocalValue::getValue($photo->text_tj,$photo->text_ru,$photo->text_en)}}</p>
         @if(count($photo->galleries)>0)
         <div class="row">
             @foreach ($photo->galleries as $item )
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 mt-4">
                <a href="" class="h-100" data-toggle="modal" data-target="#exampleModal">
                    <img id="myImg" src="/public/uploads/galleries/{{$item->image}}" class="w-100 h-100" alt="">
                </a>
            </div>
            @endforeach

        </div>
        @else
        <h4></h4>
        @endif
    </div>
</main>


@endsection

