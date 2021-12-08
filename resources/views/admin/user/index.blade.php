
@extends('layouts.admin')

@section('title','Полезные ссылки')

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
                    <h4 class="mb-0">Пользователи</h4>
                    <div class="page-title-right">
                        <button type="submit" class="btn btn-primary waves-effect waves-light" style="float:right;"><a href="/admin/user/create" style="color:cornsilk">Добавить</a></button>
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
                            @if(count($users)>0)
                            <table class="table table-bordered mb-0">

                                <thead>
                                    <tr class="thead-light">
                                        <th style="width: 20px;">#</th>
                                        <th style="width: 50px;">Аватар</th>
                                        <th style="width: 50px;">ФИО</th>
                                        <th style="width: 230px;">Роль</th>
                                        <th style="width: 230px;">Email</th>
                                        <th style="width: 350px;">Министерство</th>

                                        <th style="width: 100px;text-align:center">Действие</th>
                                    </tr>
                                </thead>
                                 <tbody>
                                    @php
									 $t=0;
									 @endphp
                                    @foreach($users as $item)
                                    <tr >
                                       @php
									 $t++;
									 @endphp
                                        <th style="width:20px;">{{$t}}</th>
                                        <td  scope="row"><img  width="50px"  src="/public/uploads/users/{{$item->avatar ? $item->avatar : 'default-avatar.jpg'}}" alt="Header Avatar" style="position:relative; border-radius: 50%;"></td>

                                        <td style="width:250px;">{{$item->name}}</td>
                                        <td style="width:250px;"> {{$item->role_id==1? 'Администратор' : 'Модератор'}}</td>
                                        <td style="width:250px;">{{$item->email}}</td>

                                        <td style="width:350px;">{{$item->role_id==2 ? $item->ministry->title_ru : 'Все'}}</td>

                                        <td class="text-center" style="width:50px;">
                                         <a data-toggle="tooltip"  href="/admin/user/edit/{{$item->id}}" class="editableIcons mr-3" title="Редактировать"><i class=" fas fa-pencil-alt" style="font-size: 16px;"></i></a>

                                         <a data-toggle="tooltip"    href="/admin/user/delete/{{$item->id}}"  class="editableIcons" title="Удалить"><i class=" fas fa-trash" style="font-size: 16px;"></i></a>

                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            @else
                            <h4 class="text-center">Нет данных</h4>
                            @endif
                        </div>
                        {{-- {{$usefull_link->links()}} --}}
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
