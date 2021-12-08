@extends('layouts.admin')

@section('title','Добавить вопрос')

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
                    <h4 class="mb-0">Добавить вопрос и ответь</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/admin/pages">Страницы</a></li>
                            <li class="breadcrumb-item active">Вопросы и ответы</li>
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
                        <form method="POST" action="/admin/page/voprosy-i-otvety/faq/store" enctype="multipart/form-data">
                            @csrf

                            @include('includes.errors')

                            <div class="form-group">
                                <label for="productname">Вопрос* (TJ)</label>
                                <input id="productname" name="question_tj" type="text" class="form-control" value="{{old('question_tj')}}" required>
                            </div>
                            <div class="col-12 mb-30 col-lg-12 form-group">
                                <h4 class="card-title">Ответь (TJ)</h4>
                                <textarea id="elm1_tj" name="answer_tj" >{{old('answer_tj')}}</textarea>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="productname">Вопрос (RU)</label>
                                <input id="productname" name="question_ru" type="text" class="form-control" value="{{old('question_ru')}}" >
                            </div>
                            <div class="col-12 mb-30 col-lg-12 form-group">
                                <h4 class="card-title">Ответь (RU)</h4>
                                <textarea id="elm1_ru" name="answer_ru" >{{old('answer_ru')}}</textarea>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="productname">Вопрос (EN)</label>
                                <input id="productname" name="question_en" type="text" class="form-control"  value="{{old('question_en')}}">
                            </div>
                            <div class="col-12 mb-30 col-lg-12 form-group">
                                <h4 class="card-title">Ответь (EN)</h4>
                                <textarea id="elm1_en" name="answer_en"  >{{old('answer_en')}}</textarea>
                            </div>
                            <hr>



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
     $('#menu_pod_page #voprosy-i-otvety').addClass('mm-active');
     $('#voprosy-i-otvety a').addClass('mm-active');
    });
</script>
@endsection
