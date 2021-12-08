@extends('layouts.admin')

@section('title','Фотогалерея')

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
                                    <h4 class="mb-0">Фотогалерея</h4>
                                    <div class="page-title-right">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light" style="float:right;"><a href="/admin/photogallery/create" style="color:cornsilk">Добавить</a></button>
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
                            @if(count($photoes)>0)
                            <table class="table table-bordered mb-0">

                                <thead>
                                    <tr class="thead-light">
                                        <th style="width: 20px;">#</th>
                                        <th style="width: 20px;"></th>
                                        <th style="width: 250px;">Заголовок</th>
                                        <th style="width: 50px;text-align:center">Активность</th>
                                        <th style="width: 50px;text-align:center">Действие</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $k=0; @endphp
                                    @foreach($photoes as $item)
                                    <tr>
                                        @php $k++; @endphp
                                        <th style="width:20px;">{{$k}}</th>
                                        <th scope="row"><img  width="100px" height="100px" src="/public/uploads/galleries/{{$item->image}}" style="position:relative;"></th>
                                        <td style="width:250px;">{{$item->title_tj}}</td>
                                        <td style="width:30px; vertical-align: middle;">
                                            <div style="display:flex;justify-content:center;">
                                                <label class="adomx-switch  align-center" id="active_photo_{{$item->id}}" data-id="{{$item->id}}" style="padding-left:50px;cursor:pointer;"><input data-class="photo" data-id="{{$item->id}}" id="change_checkbox" type="checkbox" {{$item->is_active==1? 'checked' : ''}}> <i class="lever"></i> <span class="text">{{$item->is_active==1? 'Да' : 'Нет'}}</span></label>
                                            </div>
                                        </td>
                                        <td class="text-center" style="width:50px;vertical-align: middle;">
                                            <a data-toggle="tooltip" href="/admin/photogallery/{{$item->id}}/edit" class="editableIcons mr-3 ml-3" title="Редактировать"><i class=" fas fa-pencil-alt" style="font-size: 16px;"></i></a>
                                            <a data-toggle="tooltip" href="/admin/photo/{{$item->id}}/destroy" class="editableIcons" title="Удалить"><i class=" fas fa-trash" style="font-size: 16px;"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <h4 class="text-center">Нет данных</h4>
                            @endif
                        </div>
                        {{$photoes->links()}}
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


@endsection

@section('scripts')
<script src="/public/assets/js/dropify/dropify.min.js"></script>
<script src="/public/assets/js/dropify/dropify.active.js"></script>
@endsection
