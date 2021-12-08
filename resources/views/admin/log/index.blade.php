@extends('layouts.admin')

@section('title','Полезные ссылки')

@section('styles')
<link href="/public/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="/public/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

@endsection

@section('content')


<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">История событий</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- end row -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Фильтр по дате</h4>
                        <div class="d-flex col-lg-8">
                        <div class="form-group col-lg-12 d-flex">
                            <label for="productname col-lg-4" style="margin-right:10px;margin-top:10px;">От</label>
                            <input id="date_from" name="" type="date" class="form-control col-lg-3"
                                value="{{isset($_COOKIE['date_from'])? $_COOKIE['date_from']: ''}}">

                            <label for="productname col-lg-2" style="margin:10px 10px 0 10px;">До</label>
                            <input id="date_to" name="" type="date" class="form-control col-lg-3"
                            value="{{isset($_COOKIE['date_to'])? $_COOKIE['date_to']: ''}}">
                        </div>
                        <div class="page-title-right col-lg-6 d-none">
                            <button  id="delete_logs"  data-toggle="tooltip"   title="Удалить" class="btn btn-primary waves-effect waves-light" style="float:right;cursor: pointer; ">
                            Удалить</button>
                        </div>
                    </div>
                    @include('includes.alert')

                        <table id="key-datatable" class="table dt-responsive nowrap w-100">
                            <thead>

                                <tr>
                                    <th>#</th>
                                    <th><input type="checkbox" id="select_all" style="cursor: pointer"/></th>
                                    <th >Пользователь</th>
                                    <th>Роль</th>
                                    <th>События</th>
                                    <th>Время событий</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $k=0; @endphp
                                @foreach($logs as $item)
                                @php $k++; @endphp
                                <tr >
                                    <td>{{$k}}</td>
                                    <th><input type="checkbox" id="select_one" data-id="{{$item->id}}" style="cursor: pointer"/></th>
                                    <td>{{isset($item->user) ? $item->user->name : '-'}}</td>
                                    <td>{{isset($item->user) ? ($item->user->role_id==1 ? 'Администратор' :'Модератор') : '-'}}</td>
                                    <td>{{$item->text}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td class="text-center" style="width:50px;">
                                    <a  onclick="return confirm('Вы уверень?');" data-toggle="tooltip"    href="/admin/log/{{$item->id}}/destroy"  class="editableIcons" title="Удалить"><i class=" fas fa-trash" ></i></a>
                                       </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->




        <script>
        document.cookie="pageurl=" + encodeURIComponent(window.location['search']);
    </script>



    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
<!-- end main content-->

@endsection

@section('scripts')
@section('scripts')
  <!-- Required datatable js -->
  <script src="/public/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="/public/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <!-- Buttons examples -->
  <script src="/public/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="/public/assets/js/pages/datatables.init.js"></script>
<script src="/public/assets/js/custom.js"></script>
<script>
 $(document).on('click','#select_all',function(){
    if($(this).prop('checked')==true){
        $('.sorting_1 #select_one').each(function(){
           $(this).prop('checked',true);
           $('.page-title-right').removeClass('d-none');
        });
    }
    else{
        $('.sorting_1 #select_one').each(function(){
           $(this).prop('checked',false);
           $('.page-title-right').addClass('d-none');

        });
    }
 });
 $(document).on('click','#key-datatable #select_one',function(){
     k=0;
     $('#key-datatable #select_one').each(function(){
          if( $(this).prop('checked')==true)
           k++;
        });
     console.log(k);

  if(k>0){
    $('.page-title-right').removeClass('d-none');
  }else{
    $('.page-title-right').addClass('d-none');

  }
 });

 $(document).on('click','#delete_logs',function(){
  logs=[];
  $('#key-datatable #select_one').each(function(){
        if( $(this).prop('checked')==true){
            logs.push($(this).attr('data-id'));
        }
        });
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                    }
            });
        form_data=new FormData();
        form_data.append('logs',logs);

            $.ajax({
                    url: '/admin/logs/destroy',
                    data:form_data,
                    type: 'POST',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function( data ) {
                        location.reload();
                    },
                    error: function( data ) {
                        console.log(data);
                    }
                });
 });


 $(document).on('change','#date_from',function(){
     date=$(this).val();
    $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                    }
            });

            $.ajax({
                    url: '/admin/filter/date_from/'+date,
                    data:'',
                    type: 'Get',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function( data ) {
                        location.reload();
                    },
                    error: function( data ) {
                        console.log(data);
                    }
                });
 });

 $(document).on('change','#date_to',function(){
     date=$(this).val();
    $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                    }
            });

            $.ajax({
                    url: '/admin/filter/date_to/'+date,
                    data:'',
                    type: 'Get',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function( data ) {
                        location.reload();
                    },
                    error: function( data ) {
                        console.log(data);
                    }
                });
 });

</script>
@endsection>

@endsection
