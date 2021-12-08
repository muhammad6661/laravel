
@extends('layouts.admin')

@section('title','Бенефициарный владелец')

@section('styles')
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="/public/assets/css/plugins/plugins.css">

<link href="/public/assets/css/custom.css" rel="stylesheet">
   <!-- DataTables -->
   <link href="/public/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
   <link href="/public/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
   {{-- <link href="/public/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" /> --}}

<!-- Responsive datatable examples -->
{{-- <link href="/public/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" /> --}}
@endsection
@section('content')


<div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <div><h4 class="mb-0">Добавить организация  </h4>

                                </div>
                                @if(Auth::user()->role_id==2)
                                    <div class="page-title-right col-lg-6">
                                        <button  class="btn btn-primary waves-effect waves-light" style="float:right;cursor: pointer; ">
                                           <a href="/admin/organization/create" style="color: #ffff">Добавить</a>  </button>
                                    </div>
                                @endif

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                       <div  class="d-flex col-lg-12" style="padding-right: 0px;padding-left:0px;justify-content:space-between;">

                                          @php
                                              $category=0;
                                              if(isset($_COOKIE['category'])){
                                                  $category=$_COOKIE['category'];
                                              }
                                          @endphp
                                        <h3 class="card-title"> {{$ministry}}</h3>
                                        <div class="d-flex col-lg-6" style="padding-left: 0xp;padding-right:0px;justify-content: flex-end;">
                                        <label for="productname" style="margin-top: 10px;">Выберите категория: &nbsp;</label>
                                        <select class="form-control col-lg-6" id="filter_category">
                                            <option   value="0">Все</option>
                                            @foreach ($categories as $item )
                                            <option  {{$category==$item->id ? 'selected' : ''}} value="{{$item->id}}">{{$item->title_ru}}</option>
                                            @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <h5 class="card-title">Всего: {{count($shareholders)}}</h5>
                                        <p class="card-title-desc">
                                        @include('includes.alert')
                                        </p>

                                        <table id="key-datatable" class="table dt-responsive nowrap w-100">

                                          @if(count($shareholders)>0)
                                          <thead>
                                                <tr>
                                                    <th>№</th>
                                                    <th>ФИО</th>
                                                    <th>Страна</th>
                                                    <th> % Холдинг</th>
                                                    <th>ПЛЗ</th>
                                                    <th>Компания</th>
                                                    <th>Действие</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                                @php
                                                    $k=0;
                                                @endphp
                                                @foreach ($shareholders as $item)
                                                @php
                                                $k++;
                                            @endphp
                                                <tr>
                                                    <td>{{$k}}</td>
                                                    <td>{{$item->fio}}</td>
                                                    <td>{{isset($item->country->name_en) ? $item->country->name_en : '-'}}</td>
                                                    <td>{{$item->stock}}</td>
                                                    <td>{{$item->plz==0 ? 'Нет' : 'Да'}}</td>
                                                    <td>{{$item->organization->title}}</td>

                                                    <td class="text-center" style="width:50px;vertical-align: middle;">
                                                        <a  data-toggle="tooltip" data-original-title="Редактировать" href="/admin/shareholder/add_edit/{{$item->id}}" class="editableIcons mr-3 ml-3 " ><i class=" fas fa-pencil-alt" style="font-size: 16px;"></i></a>
                                                           <a  onclick="return confirm('Вы уверень?');" data-toggle="tooltip" title="Удалить" href="/admin/shareholder/{{$item->id}}/destroy" class="editableIcons" ><i class=" fas fa-trash" style="font-size: 16px;"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                            @else
                                            <h4>Нет даных</h4>
                                            @endif
                                        </table>

                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
                        <!-- end row-->




    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
<!-- end main content-->
    <!-- ADD  Modal content for the above example -->
    <div id="add_modal_ministry" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Добавить oраганизация </h5>
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
        <input id="user_id" name="user_id" type="hidden" class="form-control" value="{{Auth::user()->id}}">
    <div class="form-group">
        <label for="productname">Заголовок*</label>
        <input id="title" name="title" type="text" class="form-control">
    </div>
        <div class="text-center mt-4">
        <button id="submit_organization" class="btn btn-primary waves-effect waves-light"
            style="float:right;">Добавить </button>
    </div>
                                </div>

                            </div>
                        </div> <!-- end col -->
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


<!--  Edit Modal content for the above example -->
<div id="modal_ministry" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Добавить oраганизация </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body"></div>
                </div>

                        </div>
                    </div> <!-- end col -->
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
@endsection

@section('scripts')
<script src="/public/assets/js/custom.js"></script>

   <!-- Required datatable js -->
   <script src="/public/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
   <script src="/public/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
   <!-- Buttons examples -->
   <script src="/public/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
   <script src="/public/assets/js/pages/datatables.init.js"></script>
@endsection
