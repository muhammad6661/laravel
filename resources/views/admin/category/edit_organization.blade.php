@extends('layouts.admin')

@section('title',$organization->title_ru)

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
                    <h4 class="mb-0">{{$organization->title_ru}}</h4>
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
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <form method="Post" action="/admin/category/{{$category->slug}}/organization/{{$organization->id}}/update"  enctype="multipart/form-data">
                            @csrf

                            @include('includes.errors')
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
       <div class="col-md-6">
           <div class="form-group">
               <label class="control-label">ИНН</label>
               <input id="price" name="inn" type="text" class="form-control" value="{{$organization->inn}}">
           </div>
       </div>
   </div>
   <div class="row">

       <div class="col-md-6">
           <div class="form-group">
               <label class="control-label">Контакты</label>
               <textarea class="form-control" id="contacts" name="contacts" rows="5">{{$organization->contacts}}</textarea>
           </div>
       </div>

   </div>

               <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary waves-effect waves-light" style="float:right;">Cохранить</button>
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
<script src="/public/assets/js/custom.js"> </script>
<script>
    $(document).ready(function() {
     $('#menu_category').addClass('mm-active');
     $('#menu_pod_category').addClass('mm-show');
     $('#menu_pod_category #{{$category->slug}}').addClass('mm-active');
     $('#{{$category->slug}} a').addClass('mm-active');
    });
</script>
@endsection
