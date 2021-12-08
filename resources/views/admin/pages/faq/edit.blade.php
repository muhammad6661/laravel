@extends('layouts.admin')

@section('title','Страницы-'.$page->title)

@section('styles')
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="/public/assets/css/plugins/plugins.css">
@endsection

@section('content')


<div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">{{$page->title}}</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="/admin/pages">Страницы</a></li>
                                            <li class="breadcrumb-item active">{{$page->title}}</li>
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
                                    <form method="POST" action="/admin/page/{{$page->slug}}/update" enctype="multipart/form-data">
                                    @csrf
                                    <h4 class="card-title">Картинка для баннера</h4>
                                        <p class="card-title-desc">
                                        Картинка для баннера должно (64x64) px.
                                        </p>
                                        @include('includes.errors')
                                        <div class="product-upload-gallery row flex-wrap">
                    <div class="col-12 mb-30 col-lg-12">

                        <input class="dropify" type="file" id="profile_pic" name="image" accept="image/x-png,image/gif,image/jpeg" data-default-file="/public/uploads/banners/{{$page->image}}" >

                    </div>
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
                <!-- End Page-content -->









<!-- end main content-->

@endsection

@section('scripts')
<script src="/public/assets/js/dropify/dropify.min.js"></script>
<script src="/public/assets/js/dropify/dropify.active.js"></script>
<script>
    $(document).ready(function() {
     $('#page').addClass('mm-active');
     $('#menu_pod_page').addClass('mm-show');
     $('#menu_pod_page #voprosy-i-otvety').addClass('mm-active');
     $('#voprosy-i-otvety a').addClass('mm-active');
    });
</script>
@endsection
