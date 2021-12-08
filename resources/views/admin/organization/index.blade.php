@extends('layouts.admin')

@section('title', 'Организация')

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
                        <div>
                            <h4 class="mb-0">Организация </h4>
                        </div>
                            <div class="page-title-right col-lg-6">
                                <button class="btn btn-primary waves-effect waves-light"
                                    style="float:right;cursor: pointer; ">
                                    <a href="/admin/organization/create" style="color: #ffff">Добавить</a> </button>
                            </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row pr-3"
                                style="justify-content:space-between;">
                                @php
                                    $category = 0;
                                    if (isset($_COOKIE['category'])) {
                                        $category = $_COOKIE['category'];
                                    }
                                    $ministry=0;
                                    if (isset($_COOKIE['ministry'])) {
                                        $ministry = $_COOKIE['ministry'];
                                    }
                                @endphp
                                @if(Auth::user()->role_id==2)
                                <h3 class="card-title"> {{ $ministry }}</h3>
                                @endif
                                @if(Auth::user()->role_id==1)
                                <div class="d-flex col-lg-6"
                                style="padding-left: 0xp;padding-right:0px;justify-content: flex-start;">
                                <label for="productname" style="margin-top: 10px;">Выберите министерство: &nbsp;</label>
                                <select class="form-control col-lg-8" id="filter_ministry">
                                    <option value="0">Все</option>
                                    @foreach ($ministries as $item)
                                        <option {{ $ministry == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}"><a
                                                href="/admin/organization/filter/category/{{ $item->id }}">{{ $item->title_ru }}</a>
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                                @endif
                                <div class="d-flex col-lg-6"
                                    style="padding-left: 0xp;padding-right:0px;justify-content: flex-end;">
                                    <label for="productname" style="margin-top: 10px;">Выберите категория: &nbsp;</label>
                                    <select class="form-control col-lg-6" id="filter_category">
                                        <option value="0">Все</option>
                                        @foreach ($categories as $item)
                                            <option {{ $category == $item->id ? 'selected' : '' }}
                                                value="{{ $item->id }}"><a
                                                    href="/admin/organization/filter/category/{{ $item->id }}">{{ $item->title_ru }}</a>
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <h5 class="card-title">Всего: {{ $qnt }}</h5>
                            <p class="card-title-desc">
                                @include('includes.alert')
                            </p>
                            <table id="key-datatable" class="table table-bordered mb-0">
                                @if (count($organizations) > 0)
                                    <thead>
                                        <tr>
                                            <th>№</th>
                                            <th style="width:50%;">Заголовок</th>
                                            <th style="text-align: center">Активность</th>
                                            <th style="text-align: center">Кол(Акционеры)</th>
                                            <th style="text-align: center">Действие</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $k = 0;
                                        @endphp
                                        @foreach ($organizations as $item)
                                            @php
                                                $k++;
                                            @endphp
                                            <tr>
                                                <td>{{ $k }}</td>
                                                <td style="vertical-align: middle;">{{ $item->title_ru }}</td>
                                                <td style="width:50px; vertical-align: middle;">
                                                    <div style="display:flex;justify-content:center;">
                                                        <label class="adomx-switch"
                                                            id="active_organization_{{ $item->id }}"
                                                            data-id="{{ $item->id }}"
                                                            style="padding-left:25px;cursor:pointer;"><input
                                                                data-class="organization" data-id="{{ $item->id }}"
                                                                id="change_checkbox" type="checkbox"
                                                                {{ $item->is_active == 1 ? 'checked' : '' }}> <i
                                                                class="lever"></i> <span
                                                                class="text">{{ $item->is_active == 1 ? 'Да' : 'Нет' }}</span></label>
                                                    </div>
                                                </td>
                                                <td style="text-align: center;vertical-align: middle;">{{ count($item->shareholders) }}</td>
                                                <td class="text-center" style="text-align: center;vertical-align: middle;"  >
                                                    <a data-toggle="tooltip" data-original-title="Редактировать"
                                                        href="/admin/organization/edit/{{ $item->id }}"
                                                        class="editableIcons mr-3"><i class=" fas fa-edit"
                                                            style="font-size: 16px;"></i></a>
                                                    <a onclick="return confirm('Вы уверень?');" data-toggle="tooltip"
                                                        title="Удалить"
                                                        href="/admin/organization/{{ $item->id }}/destroy"
                                                        class=""><i class=" fas fa-trash"
                                                            style="font-size: 16px;"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                @else
                                    <h4 class="text-center">Нет даных</h4>
                                @endif
                            </table>
                            {{ $organizations->links('pagination') }}
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
    <script src="/public/assets/js/organization.js"></script>

@endsection
