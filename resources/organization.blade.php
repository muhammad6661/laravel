@extends('layouts.front')
@section('title',\App\LocalValue::getValue($organization->title_tj,$organization->title_ru,$organization->title_en))
@section('content')


<main>
    <div class="container mt-5 detiled_info_company">
        <h1>{{\App\LocalValue::getValue($organization->title_tj,$organization->title_ru,$organization->title_en)}}</h1>
        <div>
            <div class="d-flex">
            <h4 style="">@lang('main.direcoty') :</h4>&nbsp;&nbsp;<p class="mt-1">{{\App\LocalValue::getValue($organization->name_head_tj,$organization->name_head_ru,$organization->name_head_en)}}</p>
            </div>
            <div class="d-flex">
            <h4>@lang('main.inn') :</h4>&nbsp;&nbsp;<p class="mt-1">{{$organization->inn}}</p>
            </div>
            <div class="d-flex" style="margin-bottom: 30px;">
            <h4>@lang('main.address') :</h4>&nbsp;&nbsp; <p class="mt-1">{{\App\LocalValue::getValue($organization->address_tj,$organization->address_ru,$organization->address_en)}}</p>
            </div>
        </div>
        <div class="table">
            @if(count($shares)>0)
            <table class=" m-auto mt-5" style="width: 99%">
                <thead>
                    <tr>
                        <th scope="col">
                            <p>@lang('main.beneficial')</p>
                        </th>
                        <th scope="col">
                            <p>@lang('main.citizenship') </p>
                        </th>
                        <th class="center" scope="col">
                            <p>% @lang('main.share')</p>
                        </th>
                        <th class="center" scope="col">
                            <p>@lang('main.pzl') *</p>
                        </th>
                        <th scope="col">
                            <p>@lang('main.stock')</p>
                        </th>
                        <th scope="col">
                            <p>@lang('main.owner')</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shares as $item )
                    <tr>
                        <td>
                            <p>{{\App\LocalValue::getValue($item->fio_tj,$item->fio_ru,$item->fio_en)}}</p>
                        </td>
                        <td>
                            <p><span>{{ isset($item->country) ? \App\LocalValue::getValue($item->country->name_tj,$item->country->name_ru,$item->country->name_en) : '—'}}</span></p>
                        </td>
                        <td class="center">
                            <p><span>{{$item->stock}} %</span></p>
                        </td>
                        <td class="center">
                            @if($item->plz==0)
                            —
                            @else
                            <p>@lang('main.yes')</p>
                            @endif
                        </td>
                        <td>
                            <p><span>{{\App\LocalValue::getValue($item->birja_tj,$item->birja_ru,$item->birja_en)??  '—'}}</span></p>
                        </td>
                        <td>
                            <p>
                                <a href="javascript:void(0)" id="view_shareholder"  data-id="{{$item->id}}">@lang('main.look')</a>
                            </p>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            <small>@lang('main.pzl*')</small>
          @else
          <h4>@lang('main.nodata')</h4>
          @endif
        </div>
        <div class="mt-5 pt-5 chart">
            <canvas id="myChart"></canvas>
            <span>@lang('main.beneficial')</span>
        </div>
        <div class="search_wrapper_back">
    <a href="{{isset($_COOKIE['pathname'])? $_COOKIE['pathname'] : ''}}{{isset($_COOKIE['pageurl']) ?($_COOKIE['pageurl']) : ''}}">
                <span>
                    <svg width="19" height="8" viewBox="0 0 19 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.646447 3.64645C0.451184 3.84171 0.451184 4.15829 0.646447 4.35355L3.82843 7.53553C4.02369 7.7308 4.34027 7.7308 4.53553 7.53553C4.7308 7.34027 4.7308 7.02369 4.53553 6.82843L1.70711 4L4.53553 1.17157C4.7308 0.976311 4.7308 0.659728 4.53553 0.464466C4.34027 0.269204 4.02369 0.269204 3.82843 0.464466L0.646447 3.64645ZM1 4.5H19V3.5H1V4.5Z" fill="#0063A5"/>
                    </svg>
                </span>
                <span>@lang('main.another_company')</span>
            </a>
        </div>
    </div>
</main>
<div class="modal fade" id="modal_shareholder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="/public/front/js/charts.min.js"></script>
<script>
  let ctx = document.getElementById('myChart').getContext('2d')
    const labels = [
        @foreach ($shares as $item)
          '',
         @endforeach
         @if(count($shares)==1)
         '',
         @endif

    ];
    const data = {
        labels: labels,
        datasets: [
            @php
                $k=0;
                $percent=Lang::get('main.percentage_ownership')
            @endphp
            @foreach ($shares as $item)
            {
                label: '{!! \App\LocalValue::getValue($item->fio_tj,$item->fio_ru,$item->fio_en) !!}',
                backgroundColor: ['rgb({{random_int(1,255)}}, {{random_int(1,255)}}, {{random_int(1,255)}})'],
                borderColor: '',
                data: [@for ($i=0;$i<$k;$i++)
                      {{0}},
                @endfor{{$item->stock}}],
            },
            @php
                $k++;
            @endphp
         @endforeach

         @if(count($shares)==1)
         @for ($j=0; $j<1;$j++)
            {
                label: '',
                backgroundColor: '#ffffff',
                borderColor: '',
                data: [@for ($i=0;$i<$k;$i++)
                      {{0}},
                @endfor{{'0'}}],
            },
            @php
                $k++;
            @endphp
         @endfor
         @endif


        ]
    };
    const config = {
        type: 'bar',
        data,
        options: {
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: '{{$percent}}'
                }
            }
        },

    };

    let myChart = new Chart(ctx, config);

    </script>
<script src="/public/front/js/custom.js"></script>
@endsection
