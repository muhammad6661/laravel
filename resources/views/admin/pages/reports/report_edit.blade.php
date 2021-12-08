@extends('layouts.admin')

@section('title','Редаетировать документ')

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
                    <h4 class="mb-0">Редаетировать документ</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/admin/pages">Страницы</a></li>
                            <li class="breadcrumb-item"><a href="/admin/page/otchyetii-ipdo-tadzheekeestana">Отчеты ИПДО Таджикистана</a></li>
                            <li class="breadcrumb-item"><a href="/admin/page/otchyetii-ipdo-tadzheekeestana/documents">Документы</a></li>


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
                        <form method="POST" action="/admin/page/otchyetii-ipdo-tadzheekeestana/update/{{$report->id}}" enctype="multipart/form-data">
                            @csrf

                            @include('includes.errors')
                            <div class="form-group">
                                <label for="productname">Cортировка</label>
                                <input id="sort" name="sort" type="number" min="1" class="form-control col-lg-1" value="{{$report->sort}}" >
                            </div>
                           <div class="form-group">
                                <label for="productname">Заголовок (RU)</label>
                                <input id="title_ru" name="title_ru" type="text" class="form-control" value="{{$report->title_ru}}" >
                            </div>
                            <div class="form-group">
                                <label for="productname">Заголовок* (TJ)</label>
                                <input id="productname" name="title_tj" type="text" class="form-control" value="{{$report->title_tj}}">
                            </div>
                            <div class="form-group">
                                <label for="productname">Заголовок*(EN)</label>
                                <input id="productname" name="title_en" type="text" class="form-control" value="{{$report->title_en}}" >
                            </div>

                            <div class="product-upload-gallery  flex-wrap mt-5" id="form_file">
                                       <div><h4 class="card-title">Файл* (RU)</h4></div>
                                        <p class="card-title-desc">
                                        Загрузите файл (pdf,doc,docx,txt,xls,xlsx,csv,ppt,zip).
                                        </p>
                                        <div class="col-12 mb-30 col-lg-12">
                                         <input class="dropify" type="file" id="profile_pic" name="file_ru" accept=".pdf,.doc,.docx,.txt,.xls,.xlsx,.csv,.ppt,.zip" data-default-file="/public/uploads/reports/{{$report->file_ru}}">
                                   </div>
                               </div>
                                <div class="product-upload-gallery  flex-wrap mt-5" id="form_file">
                                       <div><h4 class="card-title">Файл* (TJ)</h4></div>
                                        <p class="card-title-desc">
                                        Загрузите файл (pdf,doc,docx,txt,xls,xlsx,csv,ppt,zip).
                                        </p>
                                        <div class="col-12 mb-30 col-lg-12">
                                         <input class="dropify" type="file" id="profile_pic" name="file_tj" accept=".pdf,.doc,.docx,.txt,.xls,.xlsx,.csv,.ppt,.zip" data-default-file="/public/uploads/reports/{{$report->file_tj}}">
                                   </div>
                               </div>
                               <div class="product-upload-gallery  flex-wrap mt-5" id="form_file">
                                <div><h4 class="card-title">Файл* (EN)</h4></div>
                                 <p class="card-title-desc">
                                 Загрузите файл (pdf,doc,docx,txt,xls,xlsx,csv,ppt,zip).
                                 </p>
                                 <div class="col-12 mb-30 col-lg-12">
                                  <input class="dropify" type="file" id="profile_pic" name="file_en" accept=".pdf,.doc,.docx,.txt,.xls,.xlsx,.csv,.ppt,.zip" data-default-file="/public/uploads/reports/{{$report->file_en}}">
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
    $(document).ready(function() {
     $('#page').addClass('mm-active');
     $('#menu_pod_page').addClass('mm-show');
     $('#menu_pod_page #otchyetii-ipdo-tadzheekeestana').addClass('mm-active');
     $('#otchyetii-ipdo-tadzheekeestana a').addClass('mm-active');
    });
</script>
@endsection
