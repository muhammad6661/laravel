<div class="modal-header border-bottom-0">
    <h5 class="modal-title mt-0" id="myLargeModalLabel">{{\App\LocalValue::getValue($shareholder->fio_tj,$shareholder->fio_ru,$shareholder->fio_en)}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
            <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
        </svg>
    </button>
</div>
<hr>
<div class="modal-body">
    <div class="form-group d-flex">
        <span for="productname"><b>@lang('main.fio'): &nbsp;</b></span>
        <p>{{\App\LocalValue::getValue($shareholder->fio_tj,$shareholder->fio_ru,$shareholder->fio_en)}}</p>
    </div>
    <div class="form-group d-flex">
        <span for="productname"><b>@lang('main.citizenship'): &nbsp;</b></span>
        <p>
        {{isset($shareholder->country) ? \App\LocalValue::getValue($shareholder->country->name_tj,$shareholder->country->name_ru,$shareholder->country->name_en) : '—'}}</p>
    </div>
    <div class="form-group d-flex">
        <span for="productname"><b>@lang('main.share'): &nbsp;</b></span>
        <p>{{$shareholder->stock}} %</p>
    </div>
    <div class="form-group d-flex">
        <span for="productname"><b>@lang('main.pzl'):&nbsp;</b></span>
        <p>{{$shareholder->plz==0? 'Нет': 'Да'}}</p>
    </div>
    <div class="form-group d-flex">
        <span for="productname"><b>@lang('main.country'): &nbsp;</b></span>
        <p>

            @if ($shareholder->type==1)
            {{\App\LocalValue::getValue('Давлатӣ','Государственная','State')}}
            @elseif($shareholder->type==0)
            {{\App\LocalValue::getValue('Хусусӣ','Частная','Private')}}
            @elseif($shareholder->type==2)
            {{\App\LocalValue::getValue('Давлатӣ ва Хусусӣ','Государственная и Частная','State and Private')}}
            @else
            —
            @endif
        </p>
    </div>
    <div class="form-group d-flex">
        <span for="productname"><b>@lang('main.stock'): &nbsp;</b></span>
        @php
            $title=\App\LocalValue::getValue($shareholder->birja_tj,$shareholder->birja_ru,$shareholder->birja_en);
        @endphp
        <p>{{$title??'—'}}</p>

    </div>
</div>
