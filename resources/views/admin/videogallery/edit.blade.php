@extends('layouts.admin')

@section('title','Редактировать видео галерея')
@section('styles')
<!-- Plugins CSS -->
<link rel="stylesheet" href="/public/assets/css/plugins/plugins.css">
@endsection

@section('content')





<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Редактировать видео галерея</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/admin/videogalleries">Видеогалерея</a></li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <form method="post" action="/admin/videogallery/update/{{$videogallery->id}}" enctype="multipart/form-data">
                            @csrf

                            @include('includes.errors')



                            <div class="form-group">
                                <label for="productname">Ссылка</label>
                                <input id="productname" name="link" type="text" class="form-control" value="{{$videogallery->link}}" required>
                            </div>


                      <div class="product-upload-gallery  flex-wrap mt-5">
                        <div><h4 class="card-title">Картинка для анонса</h4></div>
                         <p class="card-title-desc">
                            Картинка должно (50х50) px.
                        </p>
                   <div class="col-12 mb-30 col-lg-12">

                   <input class="dropify" type="file" id="profile_pic" name="image" accept="image/x-png,image/gif,image/jpeg" data-default-file="/public/uploads/videogalleries/{{$videogallery->image}}" >

                  </div>
            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary waves-effect waves-light" style="float:right;">Сохранить</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- container-fluid -->
</div>

@endsection

@section('scripts')
<script src="/public/assets/js/dropify/dropify.min.js"></script>
<script src="/public/assets/js/dropify/dropify.active.js"></script>
<script>
    $(document).ready(function() {
     $('#menu_videogallery').addClass('mm-active');
     $('#menu_videogallery a').addClass('active');
    });
</script>
@endsection
