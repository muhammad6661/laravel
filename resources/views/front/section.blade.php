@extends('layouts.front')
@section('title',\App\LocalValue::getValue($section->title_tj,$section->title_ru,$section->title_en))
@section('content')
@section('normative','active')
@section($section->slug,'active')
@section('stayles')

@endsection
<div id="ban">
    <div class="image_wrapper">
        <div class="container h-100 d-flex align-items-center">
            <div class="">
                <svg width="64" height="64" viewBox="0 0 144 144" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M140.285 45.317C135.35 40.3822 127.321 40.3824 122.385 45.3181C120.866 46.8377 111.173 56.5388 109.692 58.021V24.5886C109.692 21.2079 108.376 18.0298 105.985 15.6395L94.0532 3.70688C91.6628 1.31625 88.4844 0 85.1038 0H12.6611C5.68248 0 0.00488281 5.67759 0.00488281 12.6562V131.344C0.00488281 138.322 5.68248 144 12.6611 144H97.0361C104.015 144 109.692 138.322 109.692 131.344V93.8337L140.285 63.2157C145.231 58.2697 145.232 50.2636 140.285 45.317ZM84.3802 8.4375C85.1772 8.4375 86.7131 8.29941 88.087 9.67303L100.019 21.6056C101.358 22.9447 101.255 24.4119 101.255 25.3125H84.3802V8.4375ZM101.255 131.344C101.255 133.67 99.3626 135.562 97.0361 135.562H12.6611C10.3349 135.562 8.44238 133.67 8.44238 131.344V12.6562C8.44238 10.33 10.3349 8.4375 12.6611 8.4375H75.9424V29.5312C75.9424 31.8611 77.8313 33.75 80.1611 33.75H101.255V66.4658C101.255 66.4658 88.8084 78.923 88.8079 78.9232L82.8445 84.8869C82.3816 85.3498 82.0323 85.9146 81.8253 86.5359L75.8589 104.435C75.3534 105.951 75.748 107.622 76.8781 108.752C78.0096 109.883 79.6816 110.276 81.1953 109.771L99.094 103.805C99.7153 103.598 100.28 103.249 100.743 102.786L101.255 102.274V131.344ZM91.7936 87.8701L97.7598 93.8363L95.4808 96.1152L86.5317 99.0982L89.5147 90.1488L91.7936 87.8701ZM103.725 87.8687L97.7587 81.9025C100.936 78.723 115.046 64.6009 118.038 61.6058L124.004 67.572L103.725 87.8687ZM134.317 57.2507L129.968 61.6033L124.002 55.6372L128.352 51.2831C129.998 49.6381 132.674 49.6384 134.319 51.2831C135.963 52.9284 135.972 55.5955 134.317 57.2507Z" fill="white"/>
                    <path d="M80.1611 42.1875H21.0986C18.7688 42.1875 16.8799 44.0764 16.8799 46.4062C16.8799 48.7361 18.7688 50.625 21.0986 50.625H80.1611C82.491 50.625 84.3799 48.7361 84.3799 46.4062C84.3799 44.0764 82.491 42.1875 80.1611 42.1875Z" fill="white"/>
                    <path d="M63.2861 59.0625H21.0986C18.7688 59.0625 16.8799 60.9514 16.8799 63.2812C16.8799 65.6111 18.7688 67.5 21.0986 67.5H63.2861C65.616 67.5 67.5049 65.6111 67.5049 63.2812C67.5049 60.9514 65.616 59.0625 63.2861 59.0625Z" fill="white"/>
                    <path d="M63.2861 75.9375H21.0986C18.7688 75.9375 16.8799 77.8264 16.8799 80.1562C16.8799 82.4861 18.7688 84.375 21.0986 84.375H63.2861C65.616 84.375 67.5049 82.4861 67.5049 80.1562C67.5049 77.8264 65.616 75.9375 63.2861 75.9375Z" fill="white"/>
                    <path d="M63.2861 92.8125H21.0986C18.7688 92.8125 16.8799 94.7014 16.8799 97.0312C16.8799 99.3611 18.7688 101.25 21.0986 101.25H63.2861C65.616 101.25 67.5049 99.3611 67.5049 97.0312C67.5049 94.7014 65.616 92.8125 63.2861 92.8125Z" fill="white"/>
                    <path d="M80.1621 118.688H54.8496C52.5197 118.688 50.6309 120.576 50.6309 122.906C50.6309 125.236 52.5197 127.125 54.8496 127.125H80.1621C82.492 127.125 84.3809 125.236 84.3809 122.906C84.3809 120.576 82.492 118.688 80.1621 118.688Z" fill="white"/>
                </svg>
            </div>
            <h1> {{\App\LocalValue::getValue($section->title_tj,$section->title_ru,$section->title_en)}}</h1>
        </div>
    </div>
</div>

<main>
    <div class="container mt-5 doc">
        <div>
                @foreach ($section->documents as $doc)

                @if($doc->type_link==1)
                  @php
                    $file = \App\LocalValue::getValue($doc->file_tj,$doc->file_ru,$doc->doc_en);
                     if ($file == "" ) {
                         continue;
                     }
                      $format=explode('.',$file);
                      $type="doc.svg";
                      switch ($format[1]) {
                          case 'pdf':
                              $type="pdf.svg";
                              break;
                          case 'doc':
                              $type="doc.svg";
                              break;
                          case 'docx':
                              $type="doc.svg";
                              break;
                          case 'xlsx':
                              $type="xls.svg";
                              break;
                          case 'xls':
                              $type="xls.svg";
                              break;
                         case 'csv':
                              $type="xls.svg";
                              break;
                          case 'txt':
                              $type="txt.svg";
                              break;
                          case 'zip':
                              $type="zip.svg";
                              break;
                          case 'ppt':
                              $type="ppt.svg";
                              break;

                          default:
                              $type="doc.svg";
                              break;
                      }
                  @endphp
                    <ul class="doc_wrapper d-flex mr-3">
                        <img src="/public/front/images/{{$type}}" width="36px" height="36px" style="margin-right: 10px;">
                       <li><a style="margin-top:10px" download="{{\App\LocalValue::getValue($doc->title_tj,$doc->title_ru,$doc->title_en)}}" href="/public/uploads/documents/{{\App\LocalValue::getValue($doc->file_tj,$doc->file_ru,$doc->file_en)}}" class="doc_item">{{\App\LocalValue::getValue($doc->title_tj,$doc->title_ru,$doc->title_en)}} </a></li>
                    </ul>
                    @else
                    <ul class="doc_wrapper d-flex mr-3">
                        <img src="/public/front/images/pdf.svg" width="36px" height="36px" style="margin-right: 10px;">
                       <li><a style="margin-top:10px"href="{{\App\LocalValue::getValue($doc->link_tj,$doc->link_ru,$doc->link_en)}}" class="doc_item">{{\App\LocalValue::getValue($doc->title_tj,$doc->title_ru,$doc->title_en)}} </a></li>
                    </ul>
                    @endif
                @endforeach
        </div>
    </div>
</main>



@endsection

