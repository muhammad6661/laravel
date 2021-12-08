
@extends('layouts.admin')

@section('title','Категория')

@section('styles')
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="/public/assets/css/plugins/plugins.css">

<link href="/public/assets/css/custom.css" rel="stylesheet">
@endsection

@section('content')


<div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Категория</h4>
                                    <div class="page-title-right">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#add_modal_ministry" style="float:right;cursor: pointer;">Добавить</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @include('includes.alert')
                        <!-- <p class="card-title-desc">Add <code>.table-bordered</code> for borders on all sides of the table and cells.</p> -->

                        <div class="table-responsive">
                            @if(count($categories)>0)
                            <table class="table table-bordered mb-0">

                                <thead>
                                    <tr class="thead-light">
                                        <th style="width: 20px;">#</th>
                                        <th style="width: 20px;"></th>

                                        <th style="width: 150px;">Заголовок</th>
                                        <th style="width: 50px;text-align:center">Активность</th>
                                        <th style="width: 50px;text-align:center">Действие</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $k=0; @endphp
                                    @foreach($categories as $item)
                                    <tr>
                                        @php $k++; @endphp
                                        <th style="width:20px;vertical-align: middle;">{{$k}}</th>
                                        <th scope="row">@if($item->image!="")<img  width="100px" height="100px" src="/public/uploads/category/{{$item->image}}" style="position:relative;"> @else Нет фото @endif</th>

                                        <td style="width:150px;vertical-align: middle;">{{$item->title_ru}}</td>
                                        <td style="width:50px; vertical-align: middle;">
                                            <div style="display:flex;justify-content:center;">
                                                <label class="adomx-switch  align-center" id="active_category_{{$item->id}}" data-id="{{$item->id}}" style="padding-left:50px;cursor:pointer;"><input data-class="category" data-id="{{$item->id}}" id="change_checkbox" type="checkbox" {{$item->is_active==1? 'checked' : ''}}> <i class="lever"></i> <span class="text">{{$item->is_active==1? 'Да' : 'Нет'}}</span></label>
                                            </div>
                                        </td>
                                        <td class="text-center" style="width:50px;vertical-align: middle;">
                                            <a  id="edit_category" data-id="{{$item->id}}" data-toggle="tooltip" href="javascript:void(0)" class="editableIcons mr-3" title="Редактировать"><i class=" fas fa-edit" style="font-size: 16px;"></i></a>
                                            <a  onclick="return confirm('Вы уверень?');" data-toggle="tooltip" href="/admin/category/{{$item->id}}/destroy" class="editableIcons" title="Удалить"><i class=" fas fa-trash" style="font-size: 16px;"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <h4 class="text-center">Нет данных</h4>
                            @endif
                        </div>
                        {{$categories->links()}}
                    </div>
                </div>
            </div>


        </div>
        <!-- end row -->


    <script>
        document.cookie="pageurl=" + encodeURIComponent(window.location['search']);
    </script>

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
<!-- end main content-->
  <!--Edit  Modal content for the above example -->
  <div id="modal_ministry" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Добавить категория </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                   </div>

                        </div>
                    </div> <!-- end col -->
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

  <!-- ADD  Modal content for the above example -->
  <div id="add_modal_ministry" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Добавить категория </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
    <div id="error"> </div>

<div class="form-group">
    <label for="productname">Заголовок* (RU)</label>
    <input id="title_ru" name="title_ru" type="text" class="form-control">
</div>
<div class="form-group">
    <label for="productname">Слаг*</label>
    <input id="slug" name="slug" type="text" class="form-control" readonly>
</div>
<div class="form-group">
    <label for="productname">Заголовок (TJ)</label>
    <input id="title_tj" name="title_tj" type="text" class="form-control">
</div>
<div class="form-group">
    <label for="productname">Заголовок (EN)</label>
    <input id="title_en" name="title_en" type="text" class="form-control">
</div>
<div class="product-upload-gallery  flex-wrap mt-5">
    <div><h4 class="card-title">Аватар</h4></div>
        <p class="card-title-desc">
        Аватар должно (40х40) px.
        </p>
<div class="col-12 mb-30 col-lg-12" >

<input class="dropify" type="file" id="image" name="image" accept="image/x-png,image/gif,image/jpeg" >

</div>
</div>
    <div class="text-center mt-4">
    <button id="submit_category" class="btn btn-primary waves-effect waves-light"
        style="float:right;">Добавить</button>
</div>
                            </div>

                        </div>
                    </div> <!-- end col -->
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->





@endsection

@section('scripts')
<script src="/public/assets/js/dropify/dropify.min.js"></script>
<script src="/public/assets/js/dropify/dropify.active.js"></script>
<script src="/public/assets/js/custom.js"></script>

@endsection
