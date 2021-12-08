@extends('layouts.admin')

@section('title','Добавить документ')

@section('styles')
<!-- Plugins CSS -->
<link rel="stylesheet" href="/public/assets/css/plugins/plugins.css">
<!-- Summernote css -->
<link href="/public/assets/libs/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')


<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Добавить документ</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/admin/pages">Страницы</a></li>
                            <li class="breadcrumb-item"><a href="/admin/page/normativnye-dokumenty/sections">НПА РТ</a></li>
                            <li class="breadcrumb-item"><a href="/admin/page/normativnye-dokumenty/section/{{$section->slug}}">{{$section->title_ru}}</a></li>


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
                        <form method="POST" action="/admin/page/normativnye-dokumenty/section/{{$section->id}}/store-document" enctype="multipart/form-data">
                            @csrf

                            @include('includes.errors')
                            <div class="form-group">
                                <label for="productname">Cортировка</label>
                                <input id="sort" name="sort" type="number" min="1" class="form-control col-lg-1" value="{{$sort}}" >
                            </div>
                           <div class="form-group">
                                <label for="productname">Заголовок (RU)</label>
                                <input id="title_ru" name="title_ru" type="text" class="form-control" value="{{old('title_ru')}}" >
                            </div>
                            <div class="form-group">
                                <label for="productname">Заголовок* (TJ)</label>
                                <input id="productname" name="title_tj" type="text" class="form-control" value="{{old('title_tj')}}" >
                            </div>
                            <div class="form-group">
                                <label for="productname">Заголовок*(EN)</label>
                                <input id="productname" name="title_en" type="text" class="form-control" value="{{old('title_en')}}" >
                            </div>


                            <div class="form-group d-flex">

                                                    <div class="custom-control custom-radio custom-control-right mr-3">
                                                        <input type="radio" id="customRadio1" name="type_link" class="custom-control-input" value="1"  {{old("type_link")==1 ? 'checked' :  ''}}>
                                                        <label class="custom-control-label" for="customRadio1">Файл</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-right">
                                                        <input type="radio" id="customRadio2" name="type_link" class="custom-control-input" value="0" {{old("type_link")==0 ? 'checked' :  ''}}>
                                                        <label class="custom-control-label" for="customRadio2">Ссылка</label>
                                                    </div>

                            </div>
                            <div id="form_link" class="{{old('type_link')==1 ? 'd-none' : '' }}">
                            <div class="form-group" >
                                <label for="productname">Ссылка (RU)</label>
                                <input id="link_ru" type="text" name="link_ru" class="form-control" value="{{old('link_ru')}}" >
                            </div>
                             <div class="form-group" >
                                <label for="productname">Ссылка (TJ)</label>
                                <input id="link_tj" type="text" name="link_tj" class="form-control" value="{{old('link_tj')}}" >
                            </div>
                           <div class="form-group" >
                                <label for="productname">Ссылка (EN) </label>
                                <input id="link_en" name="link_en" type="text" class="form-control" value="{{old('link_en')}}" >
                            </div>
                            </div>
                          <div id="form_file" class="{{old('type_link')==0 ? 'd-none' : '' }}">
                            <div class="product-upload-gallery  flex-wrap mt-5" id="">
                                       <div><h4 class="card-title">Файл (RU) </h4></div>
                                        <p class="card-title-desc">
                                        Загрузите файл (pdf,doc,docx,txt,xls,xlsx,csv,ppt,zip).
                                        </p>
                                        <div class="col-12 mb-30 col-lg-12">
                                         <input class="dropify" type="file" id="profile_pic_ru" name="file_ru" accept=".pdf,.doc,.docx,.txt,.xls,.xlsx,.csv,.ppt,.zip" value="{{old('file_ru')}}">
                                   </div>
                               </div>
                                <div class="product-upload-gallery  flex-wrap mt-5" id="">
                                       <div><h4 class="card-title">Файл (TJ) </h4></div>
                                        <p class="card-title-desc">
                                        Загрузите файл (pdf,doc,docx,txt,xls,xlsx,csv,ppt,zip).
                                        </p>
                                        <div class="col-12 mb-30 col-lg-12">
                                         <input class="dropify" type="file" id="profile_pic_tj" name="file_tj" accept=".pdf,.doc,.docx,.txt,.xls,.xlsx,.csv,.ppt,.zip" value="{{old('file_tj')}}">
                                   </div>
                               </div>
                            <div class="product-upload-gallery  flex-wrap mt-5" id="">
                                       <div><h4 class="card-title">Файл (EN) </h4></div>
                                        <p class="card-title-desc">
                                        Загрузите файл (pdf,doc,docx,txt,xls,xlsx,csv,ppt,zip).
                                        </p>
                                        <div class="col-12 mb-30 col-lg-12">
                                         <input class="dropify" type="file" id="profile_pic_en" name="file_en" accept=".pdf,.doc,.docx,.txt,.xls,.xlsx,.csv,.ppt,.zip" value="{{old('file_en')}}">
                                   </div>
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
<!-- End Page-content -->









<!-- end main content-->

@endsection

@section('scripts')
<script src="/public/assets/js/dropify/dropify.min.js"></script>
<script src="/public/assets/js/dropify/dropify.active.js"></script>


<!-- init js -->

<!--tinymce js-->
<script src="/public/assets/libs/tinymce/tinymce.min.js"></script>
<script src="/public/assets/js/pages/form-editor.init.js"></script>
<script src="/public/assets/libs/summernote/summernote-bs4.min.js"></script>
<script>
    $(document).on('change','#customRadio1',function(){
       $('#form_file').removeClass('d-none');
       $('#form_link').addClass('d-none');
    });
      $(document).on('change','#customRadio2',function(){
        $('#form_link').removeClass('d-none');
       $('#form_file').addClass('d-none');
    });
</script>
<script>
    $(document).ready(function() {
     $('#page').addClass('mm-active');
     $('#menu_pod_page').addClass('mm-show');
     $('#menu_pod_page #normativnye-dokumenty').addClass('mm-active');
     $('#normativnye-dokumenty a').addClass('mm-active');
    });
</script>
@endsection
