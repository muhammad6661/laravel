@extends('layouts.admin')

@section('title','Видео галерея')

@section('styles')
<link href="/public/assets/css/custom.css" rel="stylesheet">
@endsection

@section('content')


<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Видеогалерея</h4>

                <div class="page-title-right">
                    <button type="submit" class="btn btn-primary waves-effect waves-light" style="float:right;"><a href="/admin/videogalley/create-videogallery" style="color:cornsilk">Добавить</a></button>
                </div>
            </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- end row -->



        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @include('includes.alert')
                        <!-- <p class="card-title-desc">Add <code>.table-bordered</code> for borders on all sides of the table and cells.</p> -->

                        <div class="table-responsive">
                            @if(count($videogalleries)>=0)
                            <table class="table table-bordered mb-0">

                                <thead>
                                    <tr class="thead-light">
                                        <th style="width: 20px;">№</th>
                                        <th style="width: 50px;">#</th>
                                        <th style="width: 200px;">Ссылка</th>
                                        <th style="width: 30px; text-align:center;">Активность</th>
                                        <th style="width: 50px; text-align:center;">Действия</th>

                                    </tr>
                                </thead>
                                 <tbody>
                                    @php
                                     $k=0;
                                    @endphp
                                    @foreach($videogalleries as $item)
                                    <tr >
                                        @php
                                     $k++;
                                    @endphp
                                        <th style="width:20px;">{{$k}}</th>
                                        <td  scope="row"><img  width="50px" src="/public/uploads/videogalleries/{{$item->image}}" style="position:relative;"></td>

                                         <td style="width:200px;">{{$item->link}}</td>

                                         <td style="width:30px;">
                                            <div style="display:flex;justify-content:center;">
                                                <label class="adomx-switch  align-center" id="active_link_{{$item->id}}" data-id="{{$item->id}}" style="padding-left:50px;cursor:pointer;"><input data-class="link" data-id="{{$item->id}}" id="change_checkbox" type="checkbox" {{$item->is_active==1? 'checked' : ''}}> <i class="lever"></i> <span class="text">{{$item->is_active==1? 'Да' : 'Нет'}}</span></label>
                                            </div>
                                        </td>

                                        <td class="text-center" style="width:50px;">
                                         <a data-toggle="tooltip"  href="/admin/videogallery/edit-videogallery/{{$item->id}}" class="editableIcons mr-3" title="Редактировать"><i class=" fas fa-pencil-alt" style="font-size: 16px;"></i></a>

                                         <a data-toggle="tooltip"    href="/admin/videogallery/delete/{{$item->id}}"  class="editableIcons" title="Удалить"><i class=" fas fa-trash" style="font-size: 16px;"></i></a>

                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            @else
                            <h4 class="text-center">Нет данных</h4>
                            @endif
                        </div>
                        {{$videogalleries->links('pagination')}}
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
<script src="/public/assets/libs/simplebar/simplebar.min.js"></script>
<script src="/public/assets/libs/node-waves/waves.min.js"></script>
<script src="/public/assets/js/custom.js"></script>

@endsection

