<div id="error"> </div>

    <div class="form-group">
        <label for="productname">Заголовок* (RU)</label>
        <input id="title_ru" name="title_ru" type="text" class="form-control" value="{{$category->title_ru}}">
    </div>
    <div class="form-group">
        <label for="productname">Слаг*</label>
        <input  id="slug" name="slug" type="text" class="form-control" value="{{$category->slug}}" readonly>
    </div>
    <div class="form-group">
        <label for="productname">Заголовок (TJ)</label>
        <input id="title_tj" name="title_tj" type="text" class="form-control" value="{{$category->title_tj}}">
    </div>
    <div class="form-group">
        <label for="productname">Заголовок (EN)</label>
        <input id="title_en" name="title_en" type="text" class="form-control" value="{{$category->title_en}}">
    </div>
    <div class="product-upload-gallery  flex-wrap mt-5">
        <div><h4 class="card-title">Аватар</h4></div>
            <p class="card-title-desc">
            Аватар должно (40х40) px.
            </p>
<div class="col-12 mb-30 col-lg-12" >

<input class="dropify" type="file" id="image" name="image" accept="image/x-png,image/gif,image/jpeg" data-default-file="/public/uploads/category/{{$category->image}}">

</div>
</div>
        <div class="text-center mt-4">
        <button data-id="{{$category->id}}" id="update_category" class="btn btn-primary waves-effect waves-light"
            style="float:right;">Сохранить</button>
    </div>
    <script src="/public/assets/js/dropify/dropify.min.js"></script>
    <script src="/public/assets/js/dropify/dropify.active.js"></script>
