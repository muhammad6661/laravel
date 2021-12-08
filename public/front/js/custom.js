
function ajaxReq(url, method='GET', callback,  data=null, bcallback = null, errorElementID= 'null') {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
        }
    });
    $.ajax({
        url: url,
        data: data,
        type: method,
        contentType: false,
        cache: false,
        processData: false,
        //dataType: 'json',
        beforeSend: function() {
            if(bcallback != null)
                bcallback();
        },
        success: function( data ) {
            callback(data);
        },
        error: function( data ) {
            console.log(data);
            if (errorElementID === 'null') {
                    console.log(data);
            }
            else if (errorElementID === 'window.alert') {
                let a;
                $.each(data.responseJSON.errors, function (key, value) {
                    a += value[0];
                });
                alert(a);
            }
            else {
                    $('#' + errorElementID).removeClass('d-none');
                    $.each(data.responseJSON.errors, function (key, value) {
                        $('#' + errorElementID).append(value[0]+'<br>');
                    });
                }

        }
    });
}
//Slug title

//this function use for slug
function translit(str) {
    var space = '-';
    var link = '';
    var transl = {
        'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'yo', 'ж': 'zh',
        'з': 'z', 'и': 'ee', 'й': 'i', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n',
        'о': 'o', 'п': 'p', 'р': 'r','с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'kh',
        'ц': 'ts', 'ч': 'ch', 'ш': 'sh', 'щ': 'shs','ъ': '-',
        'ы': 'ii', 'ь': '=', 'э': 'e', 'ю': 'yu', 'я': 'ya'
    }
    if (str != '')
        str = str.toLowerCase();
    for (var i = 0; i < str.length; i++){
        if (/[а-яё]/.test(str.charAt(i))){ // заменяем символы на русском
            link += transl[str.charAt(i)];
        } else if (/[a-z0-9]/.test(str.charAt(i))){ // символы на анг. оставляем как есть
            link += str.charAt(i);
        } else {
            if (link.slice(-1) !== space) link += space; // прочие символы заменяем на space
        }
    }
    return link;
};
const preloader = ' <div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div> ';
function FormError( str) {
    return `<div class="alert alert-icon alert-danger alert-dismissible in" role="alert" style="">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <i class="fa fa-exclamation-triangle" style="margin-right:10px;"></i><div>${str}</div> </div>`;
}
$(document).on('keyup','#search_organization',function(e){
    e.preventDefault();
    search=$(this).val();
    href=window.location.pathname;
    route=href.split('/');
    $('#form_search').attr('action','/category1/'+route[2]+'/'+$(this).val());
     if(search.trim()==""){
        $('#content_search').addClass('d-none');

     return;
     }
     lang=$(this).attr('data-lang');
    //  $('#content_search').html('Loading...');
    ajaxReq('/live-search/'+route[2]+"/"+search,'Get',(data)=>{
        if(data.status==1){
            $('#content_search').html(data.html);
            $('#content_search').removeClass('d-none');
        }else{
        $('#content_search').addClass('d-none');
        }
    });
  });
  $(document).mouseup(function (e) {
    var container = $("#content_search");
    if(!container.is(e.target) &&
    container.has(e.target).length === 0) {
        $('#content_search').addClass('d-none');

    }
});
$(document).on('click','#filter_by_letter',function(e){
 e.preventDefault();
slug=$(this).attr('data-slug');
href=window.location.pathname;
route=href.split('/');
console.log(route.length);
ajaxReq('/category/filter/letter/'+slug,'Get',(data)=>{
    if(route.length==3){
     window.location="/category/"+route[2];
    }else{
     window.location="/category1/"+route[2]+"/"+route[3];
    }
});
});
$(document).on('click','#filter_by_paginate',function(e){
 e.preventDefault();
  paginate=$(this).attr('data-paginate');
  $('#data-paginate').html($(this).html());
  ajaxReq('/category/filter/paginate/'+paginate,'Get',(data)=>{
     location.reload();
  });
});

$(document).on('change','#search_org',function(){
   ajaxReq('/change/type-search/1','Get',(data)=>{
       location.reload();
   });
});
$(document).on('change','#search_own',function(){
   ajaxReq('/change/type-search/0','Get',(data)=>{
       location.reload();
   });
});

$(document).on('click','#view_shareholder',function(e){
 e.preventDefault();
 console.log("ok")
  id=$(this).attr('data-id');
  ajaxReq('/view_shareholder/'+id,'Get',(data)=>{
      if(data.err==0){
        $('#modal_shareholder .modal-content').html(data.html);
        $('#modal_shareholder').modal('show');
      }
  });
});

//Send to email
$(document).on('click','#send_to_email', function(){
  $(this).html(preloader);
  $(this).attr('disabled','disabled');
  name = $('#appeal_form #name').val();
  email = $('#appeal_form #email').val();
  message = $('#appeal_form #message').val();
  form_data = new FormData();
  form_data.append('name', name);
  form_data.append('email', email);
  form_data.append('message', message);
  title = $(this).attr('data-title');
  ajaxReq('/sendToEmail', 'Post', (data)=>{
      setTimeout(function(){
        if (data.err == 1) {
            $('#appeal_form #errors').html(FormError(data.msg));
            $('#send_to_email').html(title);
            window.scrollTo({
                top: 100,
                left: 100,
                behavior: "smooth",
            })
            $('#send_to_email').removeAttr('disabled');


        } else {
            $('#success_msg').removeClass('d-none');
            $('#appeal_form').remove();
        }
      } ,1000);

  }, form_data);
});
