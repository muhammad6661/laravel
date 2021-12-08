<div id="error"> </div>
       <div class="form-group">
           <label for="productname">Заголовок* (RU)</label>
           <input id="title_ru" name="title_ru" type="text" class="form-control" value="{{$ministry->title_ru}}">
       </div>
       <div class="form-group">
           <label for="productname">Заголовок (TJ)</label>
           <input id="title_tj" name="title_tj" type="text" class="form-control" value="{{$ministry->title_tj}}">
       </div>
       <div class="form-group">
           <label for="productname">Заголовок (EN)</label>
           <input id="title_en" name="title_en" type="text" class="form-control" value="{{$ministry->title_en}}">
       </div>
           <div class="text-center mt-4">
           <button data-id="{{$ministry->id}}" id="update_ministry" class="btn btn-primary waves-effect waves-light"
               style="float:right;">Обнoвить</button>
       </div>
