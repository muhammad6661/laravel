@extends('layouts.admin')

@section('title','Редактировать владелец')

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
                    <h4 class="mb-0">Редактировать владелец</h4>


                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <form method="POST" action="/share/update/{{$shareholder->id}}" enctype="multipart/form-data">
                            @csrf
                            @include('includes.errors')
                            <div class="form-group">
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
                                <select class="form-control col-lg-12" id="country_id" name="country_id">
                                    <option value="">===============-- Выберите --==============</option>
                                    @foreach ($countries as $item)
                                    <option {{$shareholder->country_id==$item->id ? 'selected' : ''}} value="{{$item->id}}">{{$item->name_ru}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="productname">Место проживаиня</label>
                                <select class="form-control col-lg-12" id="country_id" name="place_live">
                                    <option value="">===============-- Выберите --==============</option>
                                    @foreach ($countries as $item)
                                    <option {{$shareholder->place_live==$item->id ? 'selected' : ''}} value="{{$item->id}}">{{$item->name_ru}}</option>
                                    @endforeach
                                </select>
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

                                <select class="form-control "  name="organization_id">
                                    @foreach ($categories as $cat)
                                    <optgroup label="{{$cat->title_ru}}" style="font-weight:700">
                                        @foreach ($cat->organizations as $org)
                                    <option {{$shareholder->organization_id==$org->id ?'selected': ''}} value="{{$org->id}}">{{$org->title_ru}}</option>
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
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
