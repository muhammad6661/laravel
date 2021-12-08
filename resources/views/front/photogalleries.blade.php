@extends('layouts.front')
@section('title', \App\LocalValue::getValue($photo->title_tj, $photo->title_ru, $photo->title_en))
@section('stayles')
<style>
    .modal-backdrop.show {
        opacity: 0.8;
    }

</style>
<style>
    .ekko-lightbox {
        display: -ms-flexbox !important;
        display: flex !important;
        -ms-flex-align: center;
        align-items: center;
        -ms-flex-pack: center;
        justify-content: center;
        padding-right: 0 !important
    }

    .ekko-lightbox-container {
        position: relative
    }

    .ekko-lightbox-container>div.ekko-lightbox-item {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        width: 100%
    }

    .ekko-lightbox iframe {
        width: 100%;
        height: 100%
    }

    .ekko-lightbox-nav-overlay {
        z-index: 1;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: -ms-flexbox;
        display: flex
    }

    .ekko-lightbox-nav-overlay a {
        -ms-flex: 1;
        flex: 1;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        opacity: 0;
        transition: opacity .5s;
        color: #fff;
        font-size: 30px;
        z-index: 1
    }

    .ekko-lightbox-nav-overlay a>* {
        -ms-flex-positive: 1;
        flex-grow: 1
    }

    .ekko-lightbox-nav-overlay a>:focus {
        outline: none
    }

    .ekko-lightbox-nav-overlay a span {
        padding: 0 30px
    }

    .ekko-lightbox-nav-overlay a:last-child span {
        text-align: right
    }

    .ekko-lightbox-nav-overlay a:hover {
        text-decoration: none
    }

    .ekko-lightbox-nav-overlay a:focus {
        outline: none
    }

    .ekko-lightbox-nav-overlay a.disabled {
        cursor: default;
        visibility: hidden
    }

    .ekko-lightbox a:hover {
        opacity: 1;
        text-decoration: none
    }

    .ekko-lightbox .modal-dialog {
        display: none
    }

    .ekko-lightbox .modal-footer {
        text-align: left
    }

    .ekko-lightbox-loader {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        width: 100%;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        -ms-flex-pack: center;
        justify-content: center;
        -ms-flex-align: center;
        align-items: center
    }

    .ekko-lightbox-loader>div {
        width: 40px;
        height: 40px;
        position: relative;
        text-align: center
    }

    .ekko-lightbox-loader>div>div {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background-color: #fff;
        opacity: .6;
        position: absolute;
        top: 0;
        left: 0;
        animation: a 2s infinite ease-in-out
    }

    .ekko-lightbox-loader>div>div:last-child {
        animation-delay: -1s
    }

    .modal-dialog .ekko-lightbox-loader>div>div {
        background-color: #333
    }

    @keyframes a {

        0%,
        to {
            transform: scale(0);
            -webkit-transform: scale(0)
        }

        50% {
            transform: scale(1);
            -webkit-transform: scale(1)
        }
    }

    .ekko-lightbox-container>div.ekko-lightbox-item img {}

    .ekko-lightbox-container .modal-dialog {
        width: 100%
    }

    .ekko-lightbox .modal-body {
        width: 100%;
    }

</style>
@endsection
@section('photo', 'active')
@section('gallery', 'active')
@section('content')
<!-- Modal -->
<div class="modal fade det_fotos_modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-xl modal-dialog-centered">
<div class="modal-content">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                class="bi bi-x-lg" viewBox="0 0 16 16">
                <path
                    d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z" />
            </svg>
        </span>
    </button>
    <div class="image-wrapper">
        <img src="images/fotos/foto_1.png" class="img" alt="">
    </div>
</div>
</div>
</div>
<div id="ban">
<div class="image_wrapper">
<div class="container h-100 d-flex align-items-center">
    <div class="">
        <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M50.6667 8H13.3333C10.3878 8 8 10.3878 8 13.3333V50.6667C8 53.6122 10.3878 56 13.3333 56H50.6667C53.6122 56 56 53.6122 56 50.6667V13.3333C56 10.3878 53.6122 8 50.6667 8Z"
                stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
            <path
                d="M22.666 26.6666C24.8752 26.6666 26.666 24.8758 26.666 22.6666C26.666 20.4575 24.8752 18.6666 22.666 18.6666C20.4569 18.6666 18.666 20.4575 18.666 22.6666C18.666 24.8758 20.4569 26.6666 22.666 26.6666Z"
                stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M56.0007 40L42.6673 26.6666L13.334 56" stroke="white" stroke-width="3"
                stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </div>
    <h1>@lang('main.photogallery')</h1>
</div>
</div>
</div>
<main>
<div class="container mt-5 fotos_detiled">
<h2>{{ \App\LocalValue::getValue($photo->title_tj, $photo->title_ru, $photo->title_en) }}</h2>
<small>{{ \Carbon\Carbon::parse($photo->date)->isoFormat('D MMMM YYYY') }}</small>
<p>{{ \App\LocalValue::getValue($photo->text_tj, $photo->text_ru, $photo->text_en) }}</p>
<div class="row">
    @foreach ($photo->galleries as $item)


        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mt-4">
            {{-- <a href="" class="h-100 det_fotos_item" data-toggle="modal" data-target="#exampleModal">
                <img id="myImg" src="/public/uploads/galleries/{{ $item->image }}" class="w-100 h-100" alt="">
            </a> --}}
            <div class="item">
                <h4>

                    <a href="/public/uploads/galleries/{{ $item->image }}" data-toggle="lightbox"
                        data-gallery="example-gallery">
                        <img src="/public/uploads/galleries/{{ $item->image }}" alt="gallery"
                            class="h-100 img-fluid"> </a>
                </h4>
            </div>
        </div>
    @endforeach

</div>
</div>
</main>


@endsection
@section('scripts')
<script src="/public/front/js/ekko-lightbox.min.js"></script>
<script>
    const detFotosItem = document.querySelectorAll('.det_fotos_item');
    const popupImage = document.querySelector('.det_fotos_modal .image-wrapper img');
    detFotosItem.forEach(item => {
        item.addEventListener('click', e => {
            popupImage.src = item.querySelector('img').src;
            console.log(popupImage.src);
        })
    })
</script>
<script>
              $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                  event.preventDefault();
                  $(this).ekkoLightbox();
              });
  </script>


@endsection
