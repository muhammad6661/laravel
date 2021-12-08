@if(count($errors) > 0)
    <div class="alert alert-icon alert-danger alert-dismissible in" role="alert" style="">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <i class="fa fa-exclamation-triangle" style="margin-right:10px;"></i>
        <div>
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
        </div>
    </div>
@endif
