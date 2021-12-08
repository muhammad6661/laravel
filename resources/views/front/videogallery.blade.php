@extends('layouts.front')
@section('title',Lang::get('main.videogallery'))
@section('stayles')
<style>
    .modal-backdrop.show {
        opacity: 0.8;
    }
</style>
@endsection
@section('video','active')
@section('content')
<div id="ban">
    <div class="image_wrapper">
        <div class="container h-100 d-flex align-items-center">
            <div class="">
                <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M61.3346 18.6666L42.668 32L61.3346 45.3333V18.6666Z" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M37.3346 13.3334H8.0013C5.05578 13.3334 2.66797 15.7212 2.66797 18.6667V45.3334C2.66797 48.2789 5.05578 50.6667 8.0013 50.6667H37.3346C40.2802 50.6667 42.668 48.2789 42.668 45.3334V18.6667C42.668 15.7212 40.2802 13.3334 37.3346 13.3334Z" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
            <h1> @lang('main.videogallery') </h1>
        </div>
    </div>
</div>
<main>
    <div class="container mt-5 ">
        <div class="row">
            @foreach ($videos as $item)

            <div class="col-lg-3 col-md-4 col-sm-6 col-12 mt-4">
                <a id="Video_link" href="javascript:void(0)" class="h-100 det_fotos_item" data-src="{{$item->link}}">
                    <div class="youtube_ic">
                        <svg width="52" height="36" viewBox="0 0 52 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M50.0692 5.615C49.7756 4.52971 49.2027 3.54029 48.4077 2.74526C47.6127 1.95022 46.6233 1.37732 45.538 1.0836C41.5648 0 25.574 0 25.574 0C25.574 0 9.58244 0.0327999 5.60924 1.1164C4.52394 1.41014 3.53453 1.98307 2.73953 2.77814C1.94453 3.57321 1.37168 4.56267 1.07804 5.648C-0.123762 12.7076 -0.589962 23.4648 1.11104 30.242C1.40471 31.3273 1.97757 32.3167 2.77257 33.1117C3.56757 33.9068 4.55696 34.4797 5.64224 34.7734C9.61544 35.857 25.6066 35.857 25.6066 35.857C25.6066 35.857 41.5976 35.857 45.5706 34.7734C46.656 34.4797 47.6454 33.9068 48.4404 33.1118C49.2355 32.3167 49.8084 31.3273 50.102 30.242C51.3696 23.1724 51.7602 12.422 50.0692 5.6152V5.615Z" fill="black" fill-opacity="0.5"/>
                            <path d="M20.4844 25.612L33.7502 17.9284L20.4846 10.2448L20.4844 25.612Z" fill="white"/>
                        </svg>
                    </div>
                    <img data-link="{{$item->link}}"  src="/public/uploads/videogalleries/{{$item->image}}" class="w-100 h-100" alt="">
                </a>
            </div>
            @endforeach
        </div>
            {{$videos->links('pagination')}}
    </div>
</main>
<div class="modal fade det_fotos_modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z" />
                    </svg>
                </span>
            </button>
            <div class="image-wrapper">
                <iframe id="img" class="img" width="683" height="384" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
  $(document).on('click','#Video_link',function(e){
      e.preventDefault();
      src=$(this).attr('data-src');
      $('#exampleModal #img').attr('src',src);
    $('#exampleModal').modal('show');
  })
    $('#exampleModal').on('hidden.bs.modal', function (e) {
        $('#exampleModal #img').attr('src','');
    })
</script>
@endsection

