
@extends('layouts.admin')

@section('title','Редактировать пользователи')

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
                    <h4 class="mb-0">Редактировать пользователи</h4>
                    {{-- <div class="page-title-right">
                        <button type="submit" class="btn btn-primary waves-effect waves-light" style="float:right;"><a href="/admin/usefull_links/create-link" style="color:cornsilk">Добавить</a></button>
                    </div> --}}

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <form method="POST" action="/admin/user/update/{{$user->id}}" enctype="multipart/form-data">
                            @csrf

                            @include('includes.errors')
                            @include('includes.alert')

                            <div class="product-upload-gallery  flex-wrap mt-5">
                                <div><h4 class="card-title">Аватар</h4></div>

                               <div class="col-12 mb-30 col-lg-2">
                                    <input class="dropify" type="file" id="profile_pic" name="avatar" accept="image/x-png,image/gif,image/jpeg" data-default-file="/public/uploads/users/{{$user->avatar}}" >
                               </div>
                               <p class="card-title-desc">
                                Аватар должен (50х50) px.
                              </p>
                            </div>

                            <div class="form-group">
                                <label for="productname">ФИО</label>
                                <input id="productname" name="name" type="text" class="form-control" value="{{$user->name}}" required>
                            </div>
                            <div class="form-group">
                                <label for="productname">Роль</label>
                                @if($user->role_id==1&&$user->id!=Auth::user()->id)
                               <select id="select_role" name="role_id" style="margin:0px" class="form-control col-lg-4">
                                <option {{$user->role_id==1 ? 'selected' :''}} value="1">Администратор</option>
                                <option {{$user->role_id==2? 'selected' : ''}} value="2">Модератор</option>
                              </select>
                              @else
                              <input  type="text" class="form-control" value="{{Auth::user()->role_id==1 ? 'Администратор' : 'Модератор'}}" readonly>
                              @endif

                            </div>


                            <div class="form-group">
                                <label for="productname">Email</label>
                                <input id="productname" name="email" type="text" class="form-control" value="{{$user->email}}" required>
                            </div>

                            @if($user->role_id==1 && $user->id!=Auth::user()->id)
                            <div class="form-group" id="ministry_form">
                                <label for="productname">Министерство</label>
                                <select id="select_ministry" name="ministry_id" style="margin:0px" class="form-control col-lg-4">
                                    @foreach($ministries as $item)

                                       <option {{$user->ministry_id==$item->id ? 'selected' : ''}} value="{{$item->id}}">{{$item->title_ru}}</option>

                                    @endforeach
                        </select>
                            </div>
                            @endif


                            <div class="form-group">
                                <label for="productname">Пароль</label>
                                <input id="password"  name="password" type="text" class="form-control col-lg-4" value="{{$user->password}}" required>
                            </div>

                            <div class="form-group">
                                <label for="productname">Подтверждение пароль</label>
                                <input id="password_confirmation"  name="password_confirmation" type="text" class="form-control col-lg-4" value="{{$user->password}}" required>

                            </div>


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
<script src="/public/assets/js/dropify/dropify.min.js"></script>
    <script src="/public/assets/js/dropify/dropify.active.js"></script>
<script>
 $(document).on('click','#select_role',function(){
      role=$(this).val();
       if(role==2){
        $('#select_ministry').attr('name','ministry_id');
        $('#ministry_form').removeClass('d-none');
       }else{
        $('#select_ministry').removeAttr('name');
        $('#ministry_form').addClass('d-none');
       }
 });
</script>

@endsection
