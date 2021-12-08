@extends('layouts.admin')

@section('title', 'Редактировать  организацсия')

@section('styles')
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="/public/assets/css/plugins/plugins.css">
    <!-- select2 css -->
    <!-- App favicon -->
    <!-- twitter-bootstrap-wizard css -->
    <link rel="stylesheet" href="/public/assets/libs/twitter-bootstrap-wizard/prettify.css">
    <link rel="stylesheet" href="/public/assets/css/jnoty.min.css">

    {{-- <link rel="stylesheet" type="text/css" href="/public/assets/libs/toastr/build/toastr.min.css"> --}}

@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Редактировать</h4>
                        <button type="submit" class="btn btn-primary waves-effect waves-light" style="float:right;cursor: pointer; ">
                            <a style="color:cornsilk" href="/admin/organizations">Назад</a></button>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="addproduct-nav-pills-wizard" class="twitter-bs-wizard">
                                <ul class="twitter-bs-wizard-nav">
                                    <li class="nav-item">
                                        <a  id="cliked_1" href="#basic-info" class="nav-link" data-toggle="tab">
                                            <span  class="step-number">01</span>
                                            <span class="step-title">ОРГАНИЗАЦИЯ</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="cliked_2" href="#metadata" class="nav-link" data-toggle="tab">
                                            <span  class="step-number">02</span>
                                            <span class="step-title">АКЦИОНЕРЫ</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content twitter-bs-wizard-tab-content">
                                    <div class="tab-pane" id="basic-info">
                                        <h4 class="card-title">Основная информация</h4>
                                        <p class="card-title-desc">Заполните информацию ниже</p>

 <form id="form_organization">
     <div id="errors"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="manufacturername">Заголовок* (RU)</label>
                <input id="manufacturername" name="title_ru" type="text" class="form-control" value="{{$organization->title_ru}}">
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label for="manufacturerbrand">Заголовок* (TJ)</label>
                <input id="manufacturerbrand" name="title_tj" type="text" class="form-control" value="{{$organization->title_tj}}">
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label for="price">Заголовок* (EN)</label>
                <input id="price" name="title_en" type="text" class="form-control" value="{{$organization->title_en}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label for="manufacturername">ФИО директора (RU)</label>
                <input id="manufacturername" name="name_head_ru" type="text" class="form-control" value="{{$organization->name_head_ru}}">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="manufacturerbrand">ФИО директора (TJ)</label>
                <input id="manufacturerbrand" name="name_head_tj" type="text" class="form-control" value="{{$organization->name_head_tj}}">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="price">ФИО директора (EN)</label>
                <input id="price" name="name_head_en" type="text" class="form-control" value="{{$organization->name_head_en}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Категория*</label>
                <select class="form-control" name="category_id">
                    <option value="">===============-- Выберите --=============
                    </option>
                    @foreach ($categories as $item)
                        <option {{$organization->category_id==$item->id ? 'selected' : ''}} value="{{ $item->id }}">{{ $item->title_ru }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">ИНН</label>
                <input id="price" name="inn" type="text" class="form-control" value="{{$organization->inn}}">
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">Адрес (RU)</label>
                <input id="address" name="address_ru" type="text" class="form-control" value="{{$organization->address_ru}}">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">Адрес (TJ)</label>
                <input id="address" name="address_tj" type="text" class="form-control" value="{{$organization->address_tj}}">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">Адрес (EN)</label>
                <input id="address" name="address_en" type="text" class="form-control" value="{{$organization->address_en}}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Контакты</label>
                <textarea class="form-control" id="contacts" name="contacts" rows="5">{{$organization->contacts}}</textarea>
            </div>
        </div>
        @if (Auth::user()->role_id==1)
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Министерство</label>
                <select class="form-control" name="user_id">

                    <option value="">===============-- Выберите --=============</option>
                    @foreach ($ministries as $item)
                    @php
                        $user_id=(new \App\Models\User())->getUserByMinistryId($item->id);
                    @endphp
                        <option {{$organization->user_id==$user_id  ? 'selected' : ''}} value="{{ $user_id }}">{{ $item->title_ru }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        @endif
    </div>
</form>
                                    </div>
                                    <div class="tab-pane text-center" id="metadata">
                                        <h4 class="card-title">Акционеры</h4>
                                        <p class="card-title-desc">кликните добвить</p>
                                        <form id="form_shareholders" action="javascript:void(0)">
                                            @foreach ($organization->shareholders as $item )
                                            <div class="row justify-content-center" id="form_{{$item->id}}">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <button
                                                        onclick="editShareholder({{$item->id}},'db')" class="form-control btn btn-primary mr-2 waves-effect waves-light">{{$item->fio_ru}}</button>
                                                    </div>
                                                </div>
                                                <div style="margin-top:10px;">
                                                    <a onclick="editShareholder({{$item->id}},'db')"
                                                        href="javascript:void(0)" class="editableIcons mr-3"><i
                                                            class=" fas fa-pencil-alt" style="font-size: 16px;"></i></a>
                                                    <a onclick="deleteShareholder({{$item->id}},'db')"  href="javascript:void(0)"
                                                        class="editableIcons"><i
                                                            class=" fas fa-trash" style="font-size: 16px;"></i></a>
                                                </div>
                                            </div>
                                            @endforeach
                                        </form>
                                        <div class="text-center mt-2">
                                            <button id="add_shareholder" data-type="db" class="btn btn-primary mr-2 waves-effect waves-light">Добавить</button>
                                        </div>
                                    </div>
                                </div>
                                <ul class="pager wizard twitter-bs-wizard-pager-link">
                                    <li id="update_form" data-id="{{$organization->id}}"  style="float:right;"><a href="javascript:void(0)">Сохранить</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>
    <!-- end main content-->
    <!--  Modal content for the above example -->
    <div id="modal_form" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('scripts')
    <!-- twitter-bootstrap-wizard js -->
    <script src="/public/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
    <script src="/public/assets/libs/twitter-bootstrap-wizard/prettify.js"></script>
    <!-- init js -->
    <script src="/public/assets/js/pages/ecommerce-add-product.init.js"></script>
     <script src="/public/assets/js/jnoty.min.js"></script>

    <script src="/public/assets/js/organization.js"></script>

<script>
      $('a[href="#metadata"]').on('click',function(){
       $('#update_form').addClass('d-none');
    });
    $('a[href="#basic-info"]').on('click',function(){
       $('#update_form').removeClass('d-none');
    });
    $('#organization').addClass('mm-active');
    $('#organization > a').addClass('active');
</script>

@endsection
