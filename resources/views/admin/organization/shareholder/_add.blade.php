 <div class="modal-header">
     <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">Добавить владелец</h5>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
     </button>
 </div>
 <div class="modal-body">
    <form id="form_shareholder">
        <div id="errors"></div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="manufacturername">ФИО* (RU)</label>
                    <input id="manufacturername" name="fio_ru" type="text"
                        class="form-control">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="manufacturerbrand">ФИО * (TJ)</label>
                    <input id="manufacturerbrand" name="fio_tj" type="text"
                        class="form-control">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="price">ФИО *(EN)</label>
                    <input id="price" name="fio_en" type="text" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            {{-- <div class="form-group col-lg-4">
                <label for="productname">Дата рождения*</label>
                <input id="productname" name="birthday" type="date"class="form-control " value="">
            </div> --}}
            <div class="form-group col-lg-6">
                <label for="productname">Долия (%)*</label>
                <input id="productname" name="stock" type="number" min="1" step="any"
                    class="form-control" value="">
            </div>
            <div class="form-group col-lg-6">
                <label for="productname">ПЗЛ* (Полтически значимое лицо)</label>
                <select class="form-control " id="plz" name="plz">
                    <option value="">===============-- Выберите --============= </option>
                    <option value="0">Нет</option>
                    <option value="1">Да</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Страна*</label>
                    <select class="form-control" name="country_id">
                        <option value="">===============-- Выберите --============= </option>
                        @foreach ($countries as $item)
                            <option value="{{ $item->id }}">{{ $item->name_ru }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Государственная / Частная</label>
                    <select class="form-control" name="type">
                        <option value="">===============-- Выберите --=============
                        </option>
                        <option value="1">Государственная</option>
                        <option value="0">Частная</option>
                        <option value="2">Государственная и частная</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="productname">Биржа (RU)</label>
                    <input id="productname" name="birja_ru" type="text"
                        class="form-control col-lg-12" value="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="productname">Биржа (TJ)</label>
                    <input id="productname" name="birja_tj" type="text"
                        class="form-control col-lg-12" value="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="productname">Биржа (EN)</label>
                    <input id="productname" name="birja_en" type="text"
                        class="form-control col-lg-12" value="">
                </div>
            </div>
        </div>
    </form>
 </div>
 <div class="modal-footer">
     <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Закрить</button>
     <button type="button" data-type="{{$section}}" class="btn btn-primary waves-effect waves-light" id="save_shareholder">Добавить</button>
 </div>



