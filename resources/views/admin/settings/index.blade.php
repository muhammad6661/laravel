@extends('layouts.admin')

@section('title','Конфигурация')
@section('styles')
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="/public/assets/css/plugins/plugins.css">
@endsection
@section('content')
<div class="page-content">

   <!-- start page title -->
   <div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Конфигурации сайта</h4>
        </div>
    </div>
</div>

    {{-- <div class="form-group">
        <label for="adress_tj">Address_Tj</label>
        <input id="adress_tj" name="adress_tj"  value="{{isset($setting->address_tj)? $setting->address_tj : ""}}" type="text" class="form-control">
    </div> --}}

    <div class="row">
        <div class="col-12">
    <div class="card">
        <div class="card-body">
            @include('includes.alert')
            @include('includes.errors')
            <form method="post" action="/admin/setting/update" enctype="multipart/form-data">
                @csrf
            {{-- Title --}}
            <div class="row">

                <div class="col-lg-4">

                    <div class="form-group">
                        <label for="title_tj">Заголовок (Tj)</label>
                        <input id="title_tj" name="title_tj"  value="{{isset($setting->title_tj)? $setting->title_tj : ""}}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-lg-4">

                    <div class="form-group">
                        <label for="title_ru">Заголовок (Ru)</label>
                        <input id="title_ru" name="title_ru"  value="{{isset($setting->title_ru)? $setting->title_ru : ""}}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="title_en">Заголовок (En)</label>
                        <input id="title_en" name="title_en" value="{{isset($setting->title_en)? $setting->title_en : ""}}" type="text" class="form-control">
                    </div>
                </div>
            </div>
            {{-- decription --}}
            <div class="row">
                <div class="col-lg-4">

                    <div class="form-group">
                        <label for="home_description_tj">Описание (Tj)</label>
                        <textarea rows="6" id="home_description_tj" name="home_description_tj"   type="text" class="form-control"> {{isset($setting->home_description_tj)? $setting->home_description_tj : ""}} </textarea>
                    </div>
                </div>

                <div class="col-lg-4">

                    <div class="form-group">
                        <label for="home_description_ru">Описание (Ru)</label>
                        <textarea rows="6" id="home_description_ru" name="home_description_ru"   type="text" class="form-control"> {{isset($setting->home_description_ru)? $setting->home_description_ru : ""}} </textarea>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="home_description_en">Описание (En)</label>
                        <textarea rows="6" id="home_description_en" name="home_description_en"   type="text" class="form-control"> {{isset($setting->home_description_en)? $setting->home_description_en : ""}} </textarea>
                    </div>
                </div>

            </div>



            {{-- Address --}}
            <div class="row">

                <div class="col-lg-4">

                    <div class="form-group">
                        <label for="adress_tj">Адрес (Tj)</label>
                        <input id="adress_tj" name="address_tj"  value="{{isset($setting->address_tj)? $setting->address_tj : ""}}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-lg-4">

                    <div class="form-group">
                        <label for="adress_ru">Адрес (Ru)</label>
                        <input id="adress_ru" name="address_ru"  value="{{isset($setting->address_ru)? $setting->address_ru : ""}}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="adress_en">Адрес (En)</label>
                        <input id="adress_en" name="address_en" value="{{isset($setting->address_en)? $setting->address_en : ""}}" type="text" class="form-control">
                    </div>
                </div>
            </div>




             {{-- Email phone Instagram --}}
            <div class="row">

                <div class="col-lg-4">

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" name="email"  value="{{isset($setting->email)? $setting->email : ""}}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="phone">Телефон</label>
                        <input id="phone" name="phone" value="{{isset($setting->phone)? $setting->phone : ""}}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-lg-4">

                    <div class="form-group">
                        <label for="link_instagram">Ссылка (instagram)</label>
                        <input id="link_instagram" name="link_instagram"  value="{{isset($setting->link_instagram)? $setting->link_instagram : ""}}" type="text" class="form-control">
                    </div>
                </div>

            </div>


             {{-- Telegram, facebook, youtube --}}
             <div class="row">
                <div class="col-lg-4">

                    <div class="form-group">
                        <label for="link_facebook">Ссылка (facebook)</label>
                        <input id="link_facebook" name="link_facebook"  value="{{isset($setting->link_facebook)? $setting->link_facebook : ""}}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-lg-4">

                    <div class="form-group">
                        <label for="link_telegram">Ссылка (telegram)</label>
                        <input id="link_telegram" name="link_telegram"  value="{{isset($setting->link_telegram)? $setting->link_telegram : ""}}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="link_youtube">Ссылка (youtube)</label>
                        <input id="link_youtube" name="link_youtube" value="{{isset($setting->link_youtube)? $setting->link_youtube : ""}}" type="text" class="form-control">
                    </div>
                </div>

            </div>

             {{-- Title logo --}}
             <div class="row">

                <div class="col-lg-4">

                    <div class="form-group">
                        <label for="adress_tj">Загаловок логотипа (Tj)</label>
                        <input id="adress_tj" name="title_logo_tj"  value="{{isset($setting->title_logo_tj)? $setting->title_logo_tj : ""}}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-lg-4">

                    <div class="form-group">
                        <label for="adress_ru">Загаловок логотипа (Ru)</label>
                        <input id="adress_ru" name="title_logo_ru"  value="{{isset($setting->title_logo_ru)? $setting->title_logo_ru : ""}}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="adress_en">Загаловок логотипа (En)</label>
                        <input id="adress_en" name="title_logo_en" value="{{isset($setting->title_logo_en)? $setting->title_logo_en : ""}}" type="text" class="form-control">
                    </div>
                </div>
            </div>

          {{-- <div class="row" >
            <div class="product-upload-gallery  flex-wrap col-lg-4">
                <div class="col-12 mb-30 form-group" >
                    <label for="link_youtube">Логотип (Tj) (180x60) px</label>
                    <input class="dropify" type="file" id="profile_pic" name="logo_tj" accept="image/*" data-default-file="/public/uploads/settings/{{$setting->logo_tj}}" >
                </div>
            </div>
            <div class="product-upload-gallery  flex-wrap col-lg-4">
                <div class="col-12 mb-30 form-group">
                    <label for="link_youtube">Логотип (Ru) (180x60) px</label>
                    <input class="dropify" type="file" id="profile_pic" name="logo_ru" accept="image/*" data-default-file="/public/uploads/settings/{{$setting->logo_ru}}" >
                </div>
            </div>
            <div class="product-upload-gallery  flex-wrap col-lg-4">
                <div class="col-12 mb-30 form-group">
                    <label for="link_youtube">Логотип (En) (180x60) px</label>
                    <input class="dropify" type="file" id="profile_pic" name="logo_en" accept="image/*" data-default-file="/public/uploads/settings/{{$setting->logo_en}}" >
                </div>
            </div>


        </div> --}}

        <div class="row mt-30">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="adress_en">Ссылка видео на (Youtube) (Ru).  </label>
                    <input id="adress_en" name="link_video_ru" value="{{isset($setting->link_video_ru)? $setting->link_video_ru : ""}}" type="text" class="form-control">
                </div>
            </div>
        </div>
         <div class="row mt-30">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="adress_en">Ссылка видео на (Youtube) (Tj).  </label>
                    <input id="adress_en" name="link_video_tj" value="{{isset($setting->link_video_tj)? $setting->link_video_tj : ""}}" type="text" class="form-control">
                </div>
            </div>
        </div>
          <div class="row mt-30">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="adress_en">Ссылка видео на (Youtube) (En).  </label>
                    <input id="adress_en" name="link_video_en" value="{{isset($setting->link_video_en)? $setting->link_video_en : ""}}" type="text" class="form-control">
                </div>
            </div>
        </div>
      <div class="row mt-30">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="adress_en">Email для обратная связь.  </label>
                    <input id="adress_en" name="appeal_email" value="{{isset($setting->appeal_email) ? $setting->appeal_email : ""}}" type="text" class="form-control">
                </div>
            </div>
        </div>

   <div class="row">
    <div class="product-upload-gallery  flex-wrap col-lg-12">
        <div class="col-12 mb-30 form-group">
            <label for="link_youtube">Обложка видео (535x300) px</label>
            <input class="dropify" type="file" id="profile_pic" name="videoimage" accept="image/*" data-default-file="/public/uploads/settings/{{$setting->videoimage}}" >
        </div>
    </div>

   </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary waves-effect waves-light" style="float:right;">Обновить</button>
            </div>
        </form>
    </div>

</div>
</div> <!-- end col -->
</div> <!-- end row -->
</div> <!-- container-fluid -->
</div>
<!-- End Page-content -->



</div>
@endsection

@section('scripts')
<script src="/public/assets/js/dropify/dropify.min.js"></script>
<script src="/public/assets/js/dropify/dropify.active.js"></script>
@endsection
