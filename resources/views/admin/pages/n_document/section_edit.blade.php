@extends('layouts.admin')

@section('title', 'Редактировать тип документ')

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
                    <h4 class="mb-0">Редактировать</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/admin/pages">Страницы</a></li>
                            <li class="breadcrumb-item active"><a
                                    href="/admin/page/normativnye-dokumenty/sections/{{ isset($_COOKIE['pageurl']) ? $_COOKIE['pageurl'] : '' }}">Нормативные
                                    документы</a></li>
                            <li class="breadcrumb-item active">{{ $section->title_tj }}</li>
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
                        <form method="POST"
                            action="/admin/page/normativnye-dokumenty/update-section/{{ $section->id }}"
                            enctype="multipart/form-data">
                            @csrf

                            @include('includes.errors')

                            <div class="form-group">
                                <label for="productname">Заголовок* (RU)</label>
                                <input id="title_ru" name="title_ru" type="text" class="form-control"
                                    value="{{ $section->title_ru }}">
                            </div>
                            <div class="form-group">
                                <label for="productname">Слаг*</label>
                                <input id="slug" name="slug" type="text" class="form-control"
                                    value="{{$section->slug }}" readonly>
                            </div>


                            <div class="form-group">
                                <label for="productname">Заголовок* (TJ)</label>
                                <input id="productname" name="title_tj" type="text" class="form-control"
                                    value="{{ $section->title_tj }}" required>
                            </div>
                            <div class="form-group">
                                <label for="productname">Заголовок* (EN)</label>
                                <input id="productname" name="title_en" type="text" class="form-control"
                                    value="{{ $section->title_en }}">
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

<!--tinymce js-->
<script src="/public/assets/libs/tinymce/tinymce.min.js"></script>
<script src="/public/assets/js/pages/form-editor.init.js"></script>
<script src="/public/assets/libs/summernote/summernote-bs4.min.js"></script>
<script src="/public/assets/js/custom.js"></script>
<script>
    $(document).ready(function() {
     $('#page').addClass('mm-active');
     $('#menu_pod_page').addClass('mm-show');
     $('#menu_pod_page #normativnye-dokumenty').addClass('mm-active');
     $('#normativnye-dokumenty a').addClass('mm-active');
    });
</script>
@endsection
