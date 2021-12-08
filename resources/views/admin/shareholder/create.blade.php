@extends('layouts.admin')

@section('title','Добавить aкционерa')

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
                    <h4 class="mb-0">Добавить aкционерa</h4>
                    <button type="submit" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#add_modal_ministry" style="float:right;cursor: pointer; ">
                        <a style="color:cornsilk" href="/admin/organization/{{$organization->id}}/shareholders">Назад</a></button>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <form method="POST" action="/admin/organization/{{$organization->id}}/shareholder/store" enctype="multipart/form-data">
                            @csrf

                            @include('includes.errors')

                            <div class="form-group">
                                <label for="productname">ФИО* (RU)</label>
                                <input name="fio_ru" type="text" class="form-control" value="{{old('fio_ru')}}">
                            </div>
                            <div class="form-group">
                                <label for="productname">ФИО* (TJ)</label>
                                <input id="" name="fio_tj" type="text" class="form-control" value="{{old('fio_tj')}}">
                            </div>
                            <div class="form-group">
                                <label for="productname">ФИО* (EN)</label>
                                <input id="" name="fio_en" type="text" class="form-control" value="{{old('fio_en')}}">
                            </div>
                            <div class="row">

                                <div class="form-group col-lg-6">
                                    <label for="productname">Долия (%)*</label>
                                    <input id="productname" name="stock" type="number" min="1" step="any" class="form-control" value="{{old('stock')}}">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="productname">ПЗЛ* (Полтически значимое лицо)</label>
                                    <select class="form-control " id="plz" name="plz">
                                        <option value="0">Нет</option>
                                        <option value="1">Да</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="productname">Страна*</label>
                                    <select class="form-control col-lg-12" id="country_id" name="country_id">
                                        <option value="">===============-- Выберите --==============</option>
                                        @foreach ($countries as $item)
                                        <option value="{{$item->id}}">{{$item->name_ru}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="control-label">Государственная / Частная</label>
                                    <select class="form-control" name="type">
                                        <option value="">===============-- Выберите --=============
                                        </option>
                                        <option value="1">Государственная</option>
                                        <option value="0">Частная</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="productname">Биржа ссылка</label>
                                <input id="productname" name="birja_link" type="text" class="form-control col-lg-12" value="{{old('birja_link')}}">
                            </div>
                            <p style="margin-top:30px;"><span style="font-size: 15px;">*</span> Oбязательно</p>
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
<!-- end main content-->
@endsection

@section('scripts')
<script src="/public/assets/js/custom.js"> </script>
@endsection
