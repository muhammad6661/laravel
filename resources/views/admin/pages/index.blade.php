@extends('layouts.admin')

@section('title','Страницы')

@section('styles')
@endsection

@section('content')


<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Страницы</h4>


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
                            <table class="table table-bordered mb-0">

                                <thead>
                                    <tr class="thead-light">
                                        <th style="width: 20px;">#</th>
                                        <th style="width: 50px;">Анонса</th>
                                        <th style="width: 250px;">Заголовок</th>
                                        <th style="width: 50px;text-align:center">Действие</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $t=0;
                                    @endphp
                                    @foreach($pages as $item)
                                    <tr >
                                        @php
                                         $t++;
                                        @endphp
                                        <th style="width:20px;">{{$t}}</th>
                                        <th scope="row" style="background: #6f6767ed;"><img  width="100px" src="/public/uploads/banners/{{$item->image}}" style="position:relative;"></th>
                                        <td style="width:250px;">{{$item->title}}</td>
                                        <td class="text-center" style="width:50px;">
                                         <a data-toggle="tooltip"  href="/admin/page/{{($item->slug=='voprosy-i-otvety'||$item->slug=='normativnye-dokumenty'||$item->slug=='otchyetii-ipdo-tadzheekeestana') ? 'edit/' : ''}}{{$item->slug}}" class="editableIcons mr-3" title="Редактировать"><i class=" fas fa-pencil-alt" style="font-size: 16px;"></i></a>
                                         @if($item->id==1||$item->id==2||$item->id==9)
                                         <a data-toggle="tooltip"    href="/admin/page/{{$item->slug}}/{{$item->id==1? 'sections':($item->id==2 ?'faqs' : 'documents')}}"  class="editableIcons" title="Ещё"><i class=" fas fa-list" style="font-size: 16px;"></i></a>
                                        @endif

                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

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
<script src="/public/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="/public/assets/libs/node-waves/waves.min.js"></script>
@endsection
