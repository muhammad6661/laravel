
@extends('layouts.admin')

@section('title','Бенефициарный владелец')

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
                                    <div><h4 class="mb-0">{{$organization->category->title_ru}}</h4>

                                </div>
                                    <div class="page-title-right col-lg-8">
                                          <div class="" style="margin-top:10px; float:right;padding-right:20px;">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="/admin/category">Категория</a></li>
                                                <li class="breadcrumb-item"><a href="/admin/category/{{$category->slug}}/organizations">{{$category->title_ru}}</a></li>
                                                <li class="breadcrumb-item active">{{$organization->title_ru}}</li>
                                            </ol>
                                        </div>
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
                            @if(count($shares)>0)
                            <table class="table table-bordered mb-0">

                                <thead>
                                    <tr class="thead-light">
                                        <th style="width: 20px;">#</th>
                                        <th style="width: 150px;">Заголовок</th>
                                        <th style="width: 50px; text-align:center;">Страна</th>
                                        <th style="width: 50px; text-align:center;">ПЛЗ</th>
                                        <th style="width: 50px;text-align:center">Активность</th>
                                        <th style="width: 50px;text-align:center">Действие</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <? $k = 0; ?>
                                    @foreach($shares as $item)
                                    <tr>
                                        <? $k++; ?>
                                        <th style="width:20px;vertical-align: middle;">{{$k}}</th>

                                        <td style="width:150px;vertical-align: middle;">{{$item->fio_ru}}</td>
                                        <td style="width:50px;vertical-align: middle; text-align:center;">{{$item->country->name_ru}}</td>
                                        <td style="width:50px;vertical-align: middle; text-align:center;">{{$item->plz==1 ? 'Да' : 'Нет'}}</td>
                                        <td style="width:50px; vertical-align: middle;">
                                            <div style="display:flex;justify-content:center;">
                                                <label class="adomx-switch  align-center" id="active_shareholder_{{$item->id}}" data-id="{{$item->id}}" style="padding-left:50px;cursor:pointer;"><input data-class="shareholder" data-id="{{$item->id}}" id="change_checkbox" type="checkbox" {{$item->is_active==1? 'checked' : ''}}> <i class="lever"></i> <span class="text">{{$item->is_active==1? 'Да' : 'Нет'}}</span></label>
                                            </div>
                                        </td>
                                        <td class="text-center" style="width:50px;vertical-align: middle;">
                                            <a  data-toggle="tooltip" href="/admin/category/{{$category->slug}}/organization/{{$organization->id}}/shareholders/{{$item->id}}/view" class="editableIcons mr-3 ml-3" data-original-title="Редактировать"><i class=" fas fa-eye" style="font-size: 16px;"></i></a>
                                               <a  onclick="return confirm('Вы уверень?');" data-toggle="tooltip" href="/admin/shareholder/{{$item->id}}/destroy" class="editableIcons" title="Удалить"><i class=" fas fa-trash" style="font-size: 16px;"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <h4 class="text-center">Нет данных</h4>
                            @endif
                        </div>
                        {{$shares->links()}}
                    </div>
                </div>
            </div>


        </div>
        <!-- end row -->

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
<!-- end main content-->

@endsection
@section('scripts')
<script>
    $(document).ready(function() {
     $('#menu_category').addClass('mm-active');
     $('#menu_pod_category').addClass('mm-show');
     $('#menu_pod_category #{{$category->slug}}').addClass('mm-active');
     $('#{{$category->slug}} a').addClass('mm-active');
    });
</script>
@endsection
