@extends('layouts.admin')

@section('title','Добавить владелец')

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
                    <h4 class="mb-0">Добавить владелец</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                @foreach ($shares as $item)

                            <div class="form-group">
                                <label for="productname">ФИО*</label>
                                <input  data-id="{{$item->id}}" id="FIO_regex" name="fio" type="text" class="form-control" value="{{$item->title}}" >
                            </div>
                            @endforeach

                            <div class="text-center mt-4">
                                <button id="submit_rejex" class="btn btn-primary waves-effect waves-light" style="float:right;">Сохранить</buttonid=class=>
                            </div>
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
@endsection
