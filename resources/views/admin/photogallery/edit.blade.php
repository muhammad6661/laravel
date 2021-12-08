@extends('layouts.admin')

@section('title', 'Редактировать Фотогалерея')

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
                        <h4 class="mb-0">Редактировать фотогалерея</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/admin/photogalleries">Фотогалерея</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0)">{{$photo->title_ru}}</a></li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                       @include('includes.errors')
                        <div class="card-body">
                            <form  action="/admin/photogallery/{{$photo->id}}/update" method="POST" enctype="multipart/form-data" id="form_photo">
                                @csrf

                                <div class="form-group col-lg-4">
                                    <label for="productname" >Дата активность*</label>
                                    <input  name="date" type="date" class="form-control" value="{{$photo->date}}" >
                                </div>
                                <div class="form-group">
                                    <label for="productname">Заголовок* (RU)</label>
                                    <input id="title_ru" name="title_ru" type="text" class="form-control" value="{{$photo->title_ru}}">
                                </div>
                                <div class="form-group">
                                    <label for="productname">Слаг*</label>
                                    <input id="slug" name="slug" type="text" class="form-control" value="{{$photo->slug}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="productname">Заголовок (TJ)</label>
                                    <input id="title_tj" name="title_tj" type="text" class="form-control" value="{{$photo->title_tj}}">
                                </div>
                                <div class="form-group">
                                    <label for="productname">Заголовок (EN)</label>
                                    <input id="title_en" name="title_en" type="text" class="form-control" value="{{$photo->title_en}}">
                                </div>

                                <hr>
                                <div class="product-upload-gallery  flex-wrap mt-5">
                                    <div>
                                        <h4 class="card-title">Картинка для анонса*</h4>
                                    </div>
                                    <p class="card-title-desc">

                                        Картинка должно (1920х400) px.
                                    </p>
                                    <div class="col-12 mb-30 col-lg-12">

                                        <input class="dropify" type="file" id="image" name="image" accept="image/*" data-default-file="/public/uploads/galleries/{{$photo->image}}">
                                    </div>
                                </div>
                              <hr>
                                <div class="col-12 mb-30 col-lg-12 form-group">
                                    <h4 class="card-title">Текст (RU)</h4>
                                    <textarea id="text_ru" name="text_ru"  class="form-control" rows="6" >{{$photo->text_ru}}</textarea>
                                </div>
                                <div class="col-12 mb-30 col-lg-12 form-group">
                                    <h4 class="card-title">Текст (TJ)</h4>
                                    <textarea id="text_tj" name="text_tj"  class="form-control"  rows="6">{{$photo->text_tj}}</textarea>
                                </div>

                                <div class="col-12 mb-30 col-lg-12 form-group">
                                    <h4 class="card-title">Текст (EN)</h4>
                                    <textarea id="text_en" name="text_en"  class="form-control"  rows="6"> {{$photo->text_en}}</textarea>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="product-upload-gallery  flex-wrap mt-5">
                                    <div>
                                        <h4 class="card-title">Галерея</h4>
                                    </div>
                                    <p class="card-title-desc">

                                        Картинка  (1920х400) px.
                                    </p>
                                    <div class="col-12 mb-30 col-lg-12">

                                        <input class="dropify" type="file" id="gallery"   accept="image/*" multiple>
                                    </div>
                                    <div class="mt-2  col-lg-3" style="margin-left:80px;">
                                        <span data-id="{{$photo->id}}" id="upload_update" class="btn btn-primary waves-effect waves-light">Загрузить</span></div>
                                </div>

                                <div class="col-lg-7" style="background: #f3f1f1;">
                                <div class="row" id="form_galleries" style="padding-left:25px;">
                                    @foreach ($photo->galleries as $item )
                                    <div style="margin-right: 5px; margin-top:10px;margin-left:5px;" id="gal_{{$item->id}}">
                                        <img width="100px;" height="100px" src="/public/uploads/galleries/{{$item->image}}" alt="">
                                    <a style="display: block; text-align: center; font-size: 15px;  color: #FF0000; margin-top: 10px;" href="javascript:removeGallery({{$item->id}})"><i class=" fas fa-trash"></i></a></div>
                                    @endforeach
                                  </div>
                                </div>
                                 </div>
                                   <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light"
                                        style="float:right;">Сохранить</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->









    <!-- end main content-->

@endsection

@section('scripts')
    <script src="/public/assets/js/dropify/dropify.min.js"></script>
    <script src="/public/assets/js/dropify/dropify.active.js"></script>
    <!-- init js -->
    <script src="/public/assets/js/custom.js"></script>
    <script>
        $(document).ready(function() {
         $('#menu_photogallery').addClass('mm-active');
         $('#menu_photogallery a').addClass('active');
        });
    </script>
@endsection
