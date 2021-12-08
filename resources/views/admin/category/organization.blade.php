
@extends('layouts.admin')

@section('title','Организация')

@section('styles')
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="/public/assets/css/plugins/plugins.css">

<link href="/public/assets/css/custom.css" rel="stylesheet">
   <!-- DataTables -->
   {{-- <link href="/public/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
   <link href="/public/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
   <link href="/public/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" /> --}}

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
                                    <div><h4 class="mb-0">{{$category->title_ru}}  </h4>
                                </div>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="/admin/category">Категория</a></li>
                                        <li class="breadcrumb-item active">Организация</li>
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

                                       <div  class="d-flex col-lg-12" style="padding-right: 0px;padding-left:0px;justify-content:space-between;">

                                          @php
                                              $ministry=0;
                                              if(isset($_COOKIE['ministry'])){
                                                  $ministry=$_COOKIE['ministry'];
                                              }
                                          @endphp

                                        <div class="d-flex col-lg-6" style="padding-left: 0xp;padding-right:0px;justify-content: flex-start;">
                                        <label for="productname" style="margin-top: 10px;">Выберите министерство: &nbsp;</label>
                                        <select class="form-control col-lg-8" id="filter_ministry">
                                            <option   value="0">Все</option>
                                            @foreach ($ministries as $item )
                                            <option  {{$ministry==$item->id ? 'selected' : ''}} value="{{$item->id}}"><a href="/admin/organization/filter/category/{{$item->id}}">{{$item->title_ru}}</a></option>
                                            @endforeach

                                            </select>
                                        </div>
                                        <div class="page-title-right">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#add_modal_ministry" style="float:right;cursor: pointer;">Добавить</button>
                                        </div>
                                    </div>
                                    <h5 class="card-title col-lg-12">Всего: {{count($organizations)}}</h5>
                                        <p class="card-title-desc">
                                        @include('includes.alert')
                                        </p>

                                        <table id="key-datatable" class="table table-bordered mb-0">

                                          @if(count($organizations)>0)
                                          <thead>
                                                <tr>
                                                    <th>№</th>
                                                    <th>Заголовок</th>
                                                    <th style="text-align: center">Активность</th>
                                                    <th style="text-align: center">Кол( Акционеров)</th>
                                                    <th class="text-center">Действие</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $k=0;
                                                @endphp
                                                @foreach ($organizations as $item)
                                                @php
                                                $k++;
                                            @endphp
                                                <tr>
                                                    <td>{{$k}}</td>
                                                    <td>{{$item->title_ru}}</td>
                                                    <td >   <div style="">
                                                        <label class="adomx-switch" id="active_category_{{$item->id}}" data-id="{{$item->id}}" style="padding-left:50px;cursor:pointer;"><input data-class="category" data-id="{{$item->id}}" id="change_checkbox" type="checkbox" {{$item->is_active==1? 'checked' : ''}}> <i class="lever"></i> <span class="text">{{$item->is_active==1? 'Да' : 'Нет'}}</span></label>
                                                    </div>
                                                    </td>

                                                    <td style="text-align: center">{{count($item->shareholders)}}</td>
                                                    <td class="text-center d-flex" style="vertical-align: middle;justify-content: space-around;">
                                                        <a  data-toggle="tooltip" data-original-title="Редактировать" href="/admin/category/{{$category->slug}}/organization/{{$item->id}}/edit" class="editableIcons " ><i class=" fas fa-edit" style="font-size: 16px;"></i></a>
                                                         <a data-toggle="tooltip" href="/admin/category/{{$category->slug}}/organization/{{$item->id}}/shareholders" class="editableIcons" title="" data-original-title="Ещё"><i class=" fas fa-list" style="font-size: 16px;"></i></a>
                                                        <a  onclick="return confirm('Вы уверень?');" data-toggle="tooltip" title="Удалить" href="/admin/organization/{{$item->id}}/destroy" class="editableIcons " ><i class=" fas fa-trash" style="font-size: 16px;"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                            @else
                                            <h4 class="text-center">Нет даных</h4>
                                            @endif
                                        </table>
                                        {{$organizations->links('pagination')}}
                                    </div> <!-- end card body-->

                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
                        <!-- end row-->




    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
<!-- end main content-->

@endsection

@section('scripts')
   <script src="/public/assets/js/custom.js"></script>
   <!-- Required datatable js -->
   {{-- <script src="/public/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
   <script src="/public/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
   <!-- Buttons examples -->
   <script src="/public/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
   <script src="/public/assets/js/pages/datatables.init.js"></script>
 --}}

@endsection
