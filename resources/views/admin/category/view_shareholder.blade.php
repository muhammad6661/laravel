@extends('layouts.admin')

@section('title',$shareholder->fio_ru)

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
                    <h4 class="mb-0">{{$shareholder->fio_ru}}</h4>
                    <div class="" style="margin-top:10px; float:right;padding-right:20px;">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/admin/category">Категория</a></li>
                            <li class="breadcrumb-item"><a href="/admin/category/{{$category->slug}}/organizations">{{$category->title_ru}}</a></li>
                            <li class="breadcrumb-item active"><a href="/admin/category/{{$category->slug}}/organization/{{$organization->id}}/shareholders">{{$organization->title_ru}}</a></li>
                            <li class="breadcrumb-item active">{{$shareholder->fio_ru}}</li>
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
                        <form method="Get" action="/admin/category/{{$category->slug}}/organization/{{$organization->id}}/shareholders" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group ">
                                <label for="productname">ФИО* (RU)</label>
                                <input name="fio_ru" type="text" class="form-control" value="{{$shareholder->fio_ru}}">
                            </div>
                            <div class="form-group">
                                <label for="productname">ФИО* (TJ)</label>
                                <input id="" name="fio_tj" type="text" class="form-control" value="{{$shareholder->fio_tj}}">
                            </div>
                            <div class="form-group">
                                <label for="productname">ФИО* (EN)</label>
                                <input id="" name="fio_en" type="text" class="form-control" value="{{$shareholder->fio_en}}">
                            </div>

                <div class="d-flex col-lg-12">
                            <div class="form-group col-lg-6">
                                <label for="productname">Страна*</label>
                                <input id="" name="fio_en" type="text" class="form-control" value="{{isset($shareholder->country) ? $shareholder->country->name_ru : '-'}}">

                            </div>
                            <div class="form-group col-lg-6">
                                <label for="productname">Место проживаиня</label>
                                <input id="" name="fio_en" type="text" class="form-control" value="{{isset($shareholder->live) ? $shareholder->live->name_ru : '-'}}">

                            </div>
                </div>
                <div class="d-flex col-lg-12">
                         <div class="form-group col-lg-4">
                                <label for="productname">Дата рождения*</label>
                                <input id="productname" name="birthday" type="date" class="form-control " value="{{$shareholder->birthday}}">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="productname">Долия (%)*</label>
                                <input id="productname" name="stock" type="number" min="1" step="any" class="form-control" value="{{$shareholder->stock}}">
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="productname">ПЗЛ* (Полтически значимое лицо)</label>

                                <select class="form-control " id="plz" name="plz">

                                    <option {{$shareholder->plz==0 ?'selected': ''}} value="0">Нет</option>
                                    <option {{$shareholder->plz==1 ?'selected' : '' }} value="1">Да</option>
                                </select>
                            </div>
                     </div>

                            <div class="form-group col-lg-12">
                                <label for="productname">Биржа ссылка</label>
                                <input id="productname" name="birja_link" type="text" class="form-control col-lg-12" value="{{$shareholder->birja_link}}">
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="productname">Организация</label>
                                <input id="" name="fio_en" type="text" class="form-control" value="{{$organization->title_ru }}">

                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary waves-effect waves-light" style="float:right;">Назад</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- container-fluid -->
</div>
<!-- end main content-->
@endsection

@section('scripts')
<script src="/public/assets/js/custom.js"> </script>
<script>
    $(document).ready(function() {
     $('#menu_category').addClass('mm-active');
     $('#menu_pod_category').addClass('mm-show');
     $('#menu_pod_category #{{$category->slug}}').addClass('mm-active');
     $('#{{$category->slug}} a').addClass('mm-active');
    });
</script>
@endsection
